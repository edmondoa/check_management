<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Core;
use App\Models\Account;
use App\Models\Check;
use App\Models\CheckBook;
use App\Models\Payee;
use App\Models\CheckWarehouse;
use Auth;
Use Validator;
use Response;
class CheckWarehousesController extends Controller
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
        $payees = Payee::where('is_active',1)->get();  
    	return view('warehouses.index',compact('accounts','payees'));
    	
    }

    public function store(Request $req)
    {
    	Core::setConnection();  
        $inputs = $req->input();
        $inputs['created_on'] = date('Y-m-d H:i:s');
        $inputs['warehouse_date'] = date('Y-m-d H:i:s');
        $inputs['created_user_id'] = Auth::user()->user_id;
        $validate = Validator::make($inputs, CheckWarehouse::$rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }
        $diff = $inputs['end_check_no'] - $inputs['start_check_no'];
        if($diff < 1){
        	 return Response::json(['status'=>false,'message' => ["End Check No should be greater than Start Check No"]]);
        }
        $list = [];
        for($i = 0; $i<=$diff; $i++){
        	$check_no = $inputs['start_check_no'] + $i;
        	$list [] = $this->saveWarehouse($check_no,$inputs);
        }
        return Response::json(['result' => $list,'status'=>true]);

    }

    private function saveWarehouse($checkno,$inputs)
    {
    	$check = Check::where('check_no',$checkno)
    					->where('check_status_id',1)
    					->first();
    	if($check)
    	{
    		$data = ['check_id' => $check->check_id,
    				'payee_id' => $inputs['payee_id'],
    				'warehouse_date' => $inputs['warehouse_date'],
    				'created_on' => $inputs['created_on'],
    				'created_user_id' => $inputs['created_user_id']];
    		if(CheckWarehouse::create($data)){
    			return ['check_no' => $checkno, 'response'=>'Check warehouse created!','class'=>'text-success'];
    		}
    		return ['check_no' => $checkno, 'response'=>'Unable to process!', 'class'=>'text-danger'];		
    	}	
    	return ['check_no' => $checkno, 'response'=>'Check are not in the list!','class'=>'text-danger'];			
    }
}
