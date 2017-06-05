<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Core;
use App\Models\CheckBook;
use App\Models\Account;
use App\Models\Check;
use Validator;
use Response;
use Auth;
class CheckBooksController extends Controller
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
        $accounts = Account::where('is_active',1)->get();  
    	return view('checkbooks.index',compact('accounts'));
    }

    public function store(Request $req)
    {
    	Core::setConnection();
        $inputs = $req->all();
        $inputs['created_on'] = date("Y-m-d H:i:s");
        $inputs['created_user_id'] = Auth::user()->user_id;
    	$validate = Validator::make($inputs, CheckBook::$rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }

        $checkbook = CheckBook::create($inputs);
        if($checkbook){
        	$this->saveCheck($checkbook);
        	return Response::json(['status'=>true,'message' => "Successfully created!"]);
        }

        return Response::json(['status'=>false,'message' => "Error occured please report to your administrator!"]);
    }

    private function difference($checkbook)
    {
    	$dif = $checkbook->check_number_end_no - $checkbook->check_number_start_no;
    	return $dif;
    }

    private function saveCheck($checkbook)
    {
    	$dif = $this->difference($checkbook);    	
    	for($i =0; $i<=$dif; $i++ ){
    		$data = [
    					'checkbook_id' => $checkbook->checkbook_id,
    					'check_no'	=> $checkbook->check_number_start_no + $i,
    					'check_status_id' =>1,
    					'created_on' =>date('Y-m-d H:i:s'),
    					'created_user_id' => Auth::user()->user_id
    			];
    		dump(Check::create($data));	
    	}
    }

    public function checkbookList(Request $req)
    {
    	Core::setConnection();
      	$start = $req->offset;
      	$limit = $req->limit;
      	$search = @$req->searchStr;
      	$sql =  CheckBook::leftJoin('accounts', 'checkbooks.account_id', '=', 'accounts.account_id')
      			->whereRaw("accounts.account_no LIKE ('%".$search."%') ");
      	$total = $sql->count();
      	$list = $sql->skip($start)->take($limit)->get(['accounts.account_no','checkbooks.check_number_start_no',
      												'checkbooks.check_number_end_no','checkbooks.checkbook_id']);
       
        $rows = array_map(function($row){
        $action = "<div class='text-center'><a data-id='".$row['checkbook_id']."' href='javascript:void(0)' title='Edit Account' class='branch-edit'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></i></a>";
        $action .= "</div>";
        return [
            'action' => $action,
            'account_no' =>  $row['account_no'],
            'check_number_start_no'  =>  $row['check_number_start_no'],
            'check_number_end_no'   =>  $row['check_number_end_no']         
            
          ];
      },$list->toArray());
      return response()->json(['total'=>$total,'rows'=>$rows]);
    }
}
