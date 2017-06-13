<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckIssuance extends Model
{
    protected $table = 'check_issuances';

    public $timestamps = false;

    protected $fillable = ['check_amount','check_id','paye_id','check_date',
    						'checkbook_id','notes','check_status_id','check_user_id','created_on']; 
    public static $rules = ['check_amount' => "required | numeric",
    					'check_no'	 => "required",
    					'payee_id'	=> 'required',
    					'check_date' => 'required'];
}
