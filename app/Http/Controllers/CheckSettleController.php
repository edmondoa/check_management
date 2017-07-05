<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Core;
use App\Models\Account;
use App\Models\Check;
use App\Models\CheckIssuance;
use App\Models\CheckSettle;
use Validator;
use Auth;
use Response;
use Session;
class CheckSettleController extends Controller
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
    	return view('settled.index',compact('accounts'));
    	
    }

    public function findCheck(Request $req)
    {
    	Core::setConnection();
    	$inputs = $req->input();

    	$validate = Validator::make($inputs, $this->findRules());
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }

        $found = Check::leftJoin('checkbooks','checks.checkbook_id','checkbooks.checkbook_id')
        			->leftJoin('accounts','accounts.account_id','checkbooks.account_id')
        			->where('checks.check_no',$inputs['check_no'])
        			->where('accounts.account_id',$inputs['account_id'])        			
        			->first();
        if(!$found){
        	return Response::json(['status'=>false,'message' => ['Check does not exist!']]);
        }else{
        	if(in_array($found->check_status_id, [1,4,2]) ){
        		return Response::json(['status'=>false,'message' => ['Check were not in Issue status']]);
        	}else{
        		$check = CheckIssuance::with('payee')->find($found->check_id);
        		return Response::json(['status'=>true,'data' => $check]);
        	}
        }			
    }

    public function store(Request $req)
    {
    	Core::setConnection();  
        $inputs = $req->input();
        $inputs['created_on'] = date('Y-m-d H:i:s');
        $inputs['created_user_id'] = Auth::user()->user_id;
        $validate = Validator::make($inputs, CheckSettle::$rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }

        $variance = $inputs['check_amount'] - $inputs['amount'];
        if($variance > 0)
        	$inputs['variance'] = "+".$variance;
        else
        	$inputs['variance'] = $variance;
        if(Session::has('settled')){
        	$settled = Session::get('settled');
        	if($this->checkDuplicate($settled,$inputs['check_no']))
				return Response::json(['status'=>false,'message' => ['Check #'.$inputs['check_no'].' is already in the List']]);
        	array_push($settled, $inputs);
        	Session::set('settled',$settled);
        }else{
        	$settled = [];
        	array_push($settled, $inputs);
        	Session::set('settled',$settled);
        }
        return Response::json(['status'=>true,'results' => $settled]);
    }

    public function getSettle()
    {
    	$settled = [];  
    	if(Session::has('settled')){
        	$settled = Session::get('settled');        	
        }
         return Response::json(['status'=>true,'results' => $settled]);
    }

    public function setCommit()
    {
    	Core::setConnection();
    	$settled = [];
        $results = [];  
    	$settled = Session::get('settled');
    	foreach ($settled as $set) {
    		$settle = new CheckSettle;
    		$settle->clear_date = date("Y-m-d",strtotime($set['check_date']));
    		$settle->clear_amount = $set['amount'];
    		$settle->check_id = $set['check_id'];
    		$settle->created_user_id = $set['created_user_id'];
    		$settle->created_on = $set['created_on'];
    		if($settle->save()){
    			$set['status'] = 'success';
    			$check = Check::find($set['check_id']);
    			$check->check_status_id = 4;
    			$check->save(); 
    		}else{
    			$set['status'] = 'fail';
    		}
            array_push($results, $set);
    	}        	
        Session::forget('settled');
        return Response::json(['status'=>true,'results' => $results]);
    }

    private function findRules()
    {
    	return [ 
    			'account_id' => 'required',
    			'check_no' => 'required'];
    }

    private function checkDuplicate($settled,$check_no)
    {
    	foreach ($settled as $settle) {
        	if($settle['check_no'] == $check_no){
        		return true;
        	}
        }
        return false;
    }
}
