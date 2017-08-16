<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Core;
use App\Models\Payee;
use Auth;
use Response;
use Validator;
class PayeesController extends Controller
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
    	return view('payees.index');
    }

    public function payeeList(Request $req)
    {
    	Core::setConnection();
      	$start = $req->offset;
      	$limit = $req->limit;
      	$search = @$req->searchStr;
      	$sql =  Payee::whereRaw("payee_name LIKE ('%".$search."%') ");
      	$total = $sql->count();
      	$list = $sql->skip($start)->orderBy('payee_name','asc')->take($limit)->get();
       
        $rows = array_map(function($row){
        $action = "<div class='text-center'><a data-id='".$row['payee_id']."' href='javascript:void(0)' title='Edit Account' class='payee-edit'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></i></a>";
        $action .= "</div>";
        return [
            'action' => $action,
            'payee_name' =>  $row['payee_name'],
            'status'   =>  ($row['is_active'])? "<label class='text-success'>Active</label>":"<label class='text-danger'>In-active</label>",                               
            'notes'   =>  $row['notes']
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
    	$validate = Validator::make($inputs, Payee::$rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }

        $payee = Payee::create($inputs);
        if($payee)
        	return Response::json(['status'=>true,'message' => "Successfully created!"]);

        return Response::json(['status'=>false,'message' => "Error occured please report to your administrator!"]);
    }

    public function show($id)
    {
        Core::setConnection();
        return Payee::find($id);
    }

    public function update(Request $req,$id)
    {
        Core::setConnection();
        $inputs = $req->all();   
        $rules = Payee::$rules;
        $rules['payee_name'] = $rules['payee_name'] . ',' . $id.',payee_id';
            
        $validate = Validator::make($inputs, $rules);
        if($validate->fails())
        {
            return Response::json(['status'=>false,'message' => $validate->messages()]);
        }

        $payee = Payee::find($id);
        $payee->payee_name = $req->payee_name;        
        $payee->is_active = $req->is_active;
        $payee->notes = $req->notes;
        if($payee->save())
            return Response::json(['status'=>true,'message' => "Successfully updated!"]);

        return Response::json(['status'=>false,'message' => "Error occured please report to your administrator!"]);
    }

}
