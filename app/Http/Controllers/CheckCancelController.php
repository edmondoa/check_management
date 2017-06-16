<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\CheckCancel;
use App\Models\CheckWarehouse;
use App\Models\CheckIssuance;
use App\Models\CheckSettle;
use App\Models\Check;
use App\Libraries\Core;
use Auth;
use Response;
use Validator;
class CheckCancelController extends Controller
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
    	return view('cancels.index',compact('accounts'));
    	
    }

    public function setCancel(Request $req)
    {
    	Core::setConnection();  
        $inputs = $req->input();
        $inputs['created_on'] = date('Y-m-d H:i:s');       
        $inputs['created_user_id'] = Auth::user()->user_id;
        $validate = Validator::make($inputs, CheckCancel::$rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }
        $diff = $inputs['end_check_no'] - $inputs['start_check_no'];
        if($diff < 1 ){
        	 return Response::json(['status'=>false,'message' => ["End Check No should be greater than Start Check No"]]);
        }else if($diff >100){
        	return Response::json(['status'=>false,'message' => ["Series should not be greater than 100"]]);
        }
        $list = [];
        for($i = 0; $i<=$diff; $i++){
        	$check_no = $inputs['start_check_no'] + $i;
        	$list [] = $this->cancelProcess($check_no,$inputs);
        }
        return Response::json(['result' => $list,'status'=>true]);

    }

    private function cancelProcess($checkno,$inputs)
    {
    	$check = Check::where('check_no',$checkno)                          					
    					->first();
    	if($check)
    	{
            $onlyNotNew = Check::where('check_no',$checkno)
                        ->where('check_status_id',1)                       
                        ->first();
            if($onlyNotNew){
                return ['check_no' => $checkno, 'response'=>'This is a new check','class'=>'text-info'];
            }            
    		$data = ['check_id' => $check->check_id,    				
    				'created_on' => $inputs['created_on'],                    
    				'created_user_id' => $inputs['created_user_id']];
    		
            if(CheckCancel::create($data)){
                $check->check_status_id = 1;
                $check->save();
                $warehouse = CheckWarehouse::find($check->check_id);
                if($warehouse)
                    $warehouse->delete();

                $issuance = CheckIssuance::find($check->check_id);
                if($issuance)
                    $issuance->delete();

                $settle = CheckSettle::find($check->check_id);
                if($settle)
                    $settle->delete();

    			return ['check_no' => $checkno, 'response'=>'Successfully cancelled!','class'=>'text-success'];
    		}
    		return ['check_no' => $checkno, 'response'=>'Unable to process!', 'class'=>'text-danger'];		
    	}	
    	return ['check_no' => $checkno, 'response'=>'Check are not in the list!','class'=>'text-danger'];			
    }
}
