<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Core;
use App\Models\Account;
use App\Models\Check;
use App\Models\CheckBook;
use App\Models\Payee;
use App\Models\CheckIssuance;
use App\Models\CheckWarehouse;
use Validator;
use Response;
use Auth;
class CheckIssuancesController extends Controller
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
    	return view('check_issuance.index',compact('accounts','payees'));
    	
    }

    public function show($id)
    {
        Core::setConnection();
        $account = Account::whereHas('checkbooks',function($qry){
            $qry->with('availableIssuance');
        })->find($id);
        $checkbooks = $account->checkbooks;
        $result = [];
        if(@$checkbooks){    
            foreach ($checkbooks as $checkbook) {                
                if(count(@$checkbook->availableIssuance)>0){
                    foreach (@$checkbook->availableIssuance as $check) {
                       array_push($result, ['check_id'=>$check->check_id,'check_no'=>$check->check_no]);
                    }
                }         
                    
            }
            return $result;    
        }
            return [];
    }

    public function store(Request $req)
    {
        Core::setConnection();  
        $inputs = $req->input();
        $inputs['created_on'] = date('Y-m-d H:i:s');
        $inputs['created_user_id'] = Auth::user()->user_id;
        $validate = Validator::make($inputs, CheckIssuance::$rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }
        
        $check = Check::find($inputs['check_no']);

        $check->check_amount = $inputs['check_amount'];
        $check->notes = $inputs['notes'];
        $check->check_status_id = 3;
        if($check->save()){
            $issuance = new CheckIssuance;
            $issuance->payee_id = $inputs['payee_id'];
            $issuance->check_id = $inputs['check_no'];
            $issuance->check_date = date('Y-m-d',strtotime($inputs['check_date']));
            $issuance->amount = $inputs['check_amount'];
            $issuance->created_user_id = $inputs['created_user_id'];
            $issuance->created_on = $inputs['created_on'];
            if($issuance->save()){
                return Response::json(['status'=>true,'message' => 'Check has been successfuly issued']);
            }else{
                return Response::json(['status'=>false,'message' => "Error in proccessing, Please contact your administrator!"]);
            }

        }else{
            return Response::json(['status'=>false,'message' => "Error in proccessing, Please contact your administrator!"]);
        }

    }

    public function getPayee($check_id)
    {
        Core::setConnection();
        $check = CheckWarehouse::with('payee')->find($check_id);
        return $check->payee;
    }

}
