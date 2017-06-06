<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Core;
use App\Models\Account;
use App\Models\CheckBook;
use App\Models\Payee;
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
        $checbook = CheckBook::with('availableIssuance')->find($id);
        if(@$checbook->availableIssuance)
            return $checbook->availableIssuance;
        else
            return [];
    }

}
