<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Core;
use App\Models\Account;
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
    	return view('check_issuance.index',compact('accounts'));
    	
    }

}
