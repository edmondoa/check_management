<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckSettle extends Model
{
    protected $table = 'check_clears';

    public $timestamps = false;

    protected $primaryKey = 'check_id';
    protected $fillable = ['clear_date','check_id','clear_amount','created_user_id','created_on']; 
    public static $rules = ['amount' => "required | numeric",
    					'check_no'	 => "required",
    					'payee_id'	=> 'required',
    					'check_date' => 'required',
    					'account_id' => 'required' ];
}
