<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Core;
use App\Models\Account;
use Validator;
use Auth;
use Response;
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
}
