<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckCancel extends Model
{
    protected $table = 'check_cancels';
    public $timestamps = false;

    protected $primaryKey = 'check_id';
    
    protected $fillable =['check_id','created_on','created_user_id'];

    public static $rules =[    				
    				'account_id' => 'required',
    				'start_check_no' => 'required | numeric',
    						'end_check_no'=>'required | numeric'];

}
