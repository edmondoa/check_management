<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Core;
use App\Models\Account;
use Validator;
use Response;
use Auth;
class AccountsController extends Controller
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
    	return view('accounts.index');
    }

    public function accountList(Request $req)
    {
    	Core::setConnection();
      	$start = $req->offset;
      	$limit = $req->limit;
      	$search = @$req->searchStr;
      	$sql =  Account::whereRaw("account_no LIKE ('%".$search."%') OR bank_code LIKE ('%".$search."%')");
      	$total = $sql->count();
      	$list = $sql->skip($start)->orderBy('bank_code','asc')->take($limit)->get();
       
        $rows = array_map(function($row){
        $action = "<div class='text-center'><a data-id='".$row['account_id']."' href='javascript:void(0)' title='Edit Account' class='branch-edit'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></i></a>";
        $action .= "</div>";
        return [
            'action' => $action, 
            'bank_code' =>  strtoupper($row['bank_code']),
            'account_code' =>  strtoupper($row['bank_code']).substr($row['account_no'], -3),
            'account_no'  =>  $row['account_no'],
            'status'   =>  ($row['is_active'])? "<label class='text-success'>Active</label>":"<label class='text-danger'>In-active</label>",            
            'notes'   =>  $row['notes'],
            'action'   => "<a href='javascript:void(0)' data-id='".$row['account_id']."' title='Edit Account' class='account'  ><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>" 
          ];
      },$list->toArray());
      return response()->json(['total'=>$total,'rows'=>$rows]);
    }


    public function store(Request $req)
    {

    	Core::setConnection();
        $inputs = $req->all();
        $inputs['created_on'] = date("Y-m-d H:i:s");
        $inputs['created_user_id'] = Auth::user()->user_id;
    	$validate = Validator::make($inputs, Account::$rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }

        $account = Account::create($inputs);
        if($account)
        	return Response::json(['status'=>true,'message' => "Successfully created!"]);

        return Response::json(['status'=>false,'message' => "Error occured please report to your administrator!"]);
    }

    public function show($id)
    {
        Core::setConnection();
        return Account::find($id);
    }

    public function update(Request $req,$id)
    {
        Core::setConnection();
        $inputs = $req->all(); 
        $rules = Account::$rules;
        $rules['account_no'] = $rules['account_no'] . ',' . $id.',account_id';
       
        $validate = Validator::make($inputs, $rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }

        $account = Account::find($id);
        $account->bank_code = $req->bank_code;
        $account->account_no = $req->account_no;
        $account->is_active = $req->is_active;
        $account->notes = $req->notes;
        if($account->save())
            return Response::json(['status'=>true,'message' => "Successfully updated!"]);

        return Response::json(['status'=>false,'message' => "Error occured please report to your administrator!"]);
    }
}
