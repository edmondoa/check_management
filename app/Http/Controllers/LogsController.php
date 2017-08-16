<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Core;
use App\Models\Check;
use App\Models\CheckWarehouse;
use App\Models\CheckIssuance;
use App\Models\CheckSettle;
class LogsController extends Controller
{
    public function __construct()
    {        
        $this->middleware('web');
    }
    public function index()
    {
        if(!Core::setConnection())
        {
         return redirect()->intended('login');
        }  
    	return view('logs.index');
    }

    public function logs(Request $req)
    {
    	Core::setConnection();
      	$start = $req->offset;
      	$limit = $req->limit;
      	$search = (@$req->type) ? @$req->type :'checks' ;
        $from = (@$req->from) ? $req->from : date('Y-m-d') ;
        $to = (@$req->to) ? $req->to : date('Y-m-d') ;
      	$sql =  $this->getQuery($search,$from,$to);
      	$total = $sql->count();
      	$list = $sql->skip($start)->orderBy($search.'.created_on','asc')->take($limit)->get();
        
        $rows = array_map(function($row){   
          $status ="New";
          if($row['check_status_id'] == 2 )
            $status ="WAREHOUSE";
          if($row['check_status_id'] == 3 )
            $status ="ISSUED";
          if($row['check_status_id'] == 4 )
            $status ="SETTLED";
          
        return [
            'account_code' => $row['bank_code'].substr($row['account_no'], -3),
            'type' => $status,
            'check_no' =>  $row['check_no'],
            'payee'   =>  @$row['payee_name']                             
            
          ];
      },$list->toArray());
      return response()->json(['total'=>$total,'rows'=>$rows]);
    }

    private function getQuery($model,$from,$to)
    {
      if($model =='checks'){
        $sql = Check::whereRaw("date_format(checks.created_on,'%Y-%m-%d') >='".$from."' AND date_format(checks.created_on,'%Y-%m-%d') <='".$to."'")
              ->where('check_status_id',1)
              ->leftJoin('checkbooks','checks.checkbook_id','checkbooks.checkbook_id')
              ->leftJoin('accounts','checkbooks.account_id','accounts.account_id');
      }else if($model == 'check_warehouses'){
        $sql = CheckWarehouse::whereRaw("date_format(check_warehouses.created_on,'%Y-%m-%d') >='".$from."' AND date_format(check_warehouses.created_on,'%Y-%m-%d') <='".$to."'")
              ->leftJoin('checks','check_warehouses.check_id','checks.check_id')
              ->leftJoin('checkbooks','checks.checkbook_id','checkbooks.checkbook_id')
              ->leftJoin('accounts','checkbooks.account_id','accounts.account_id')
              ->leftJoin('payees','check_warehouses.payee_id','payees.payee_id')
              ->where('check_status_id',2);
      }else if($model == 'check_issuances'){ 
        $sql = CheckIssuance::whereRaw("date_format(check_issuances.created_on,'%Y-%m-%d') >='".$from."' AND date_format(check_issuances.created_on,'%Y-%m-%d') <='".$to."'")
            ->leftJoin('checks','check_issuances.check_id','checks.check_id')
            ->leftJoin('checkbooks','checks.checkbook_id','checkbooks.checkbook_id')
            ->leftJoin('accounts','checkbooks.account_id','accounts.account_id')
            ->leftJoin('payees','check_issuances.payee_id','payees.payee_id')
            ->where('check_status_id',3);
      }else if($model == 'check_clears'){ 
        $sql = CheckSettle::whereRaw("date_format(check_clears.created_on,'%Y-%m-%d') >='".$from."' AND date_format(check_clears.created_on,'%Y-%m-%d') <='".$to."'")
            ->leftJoin('checks','check_clears.check_id','checks.check_id')
            ->leftJoin('checkbooks','checks.checkbook_id','checkbooks.checkbook_id')
            ->leftJoin('accounts','checkbooks.account_id','accounts.account_id')
            ->leftJoin('check_issuances','check_clears.check_id','check_issuances.check_id')
            ->leftJoin('payees','check_issuances.payee_id','payees.payee_id')
             ->where('check_status_id',4);
      }   
      return $sql;
    }
}
