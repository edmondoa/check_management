<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckWarehouse extends Model
{
    protected $table = 'check_warehouses';

    public $timestamps = false;

    protected $fillable = ['check_id','payee_id','warehouse_date',
    						'created_user_id','created_on']; 
    public static $rules = ['payee_id'	=> 'required',
    						'start_check_no' => 'required | numeric',
    						'end_check_no'=>'required | numeric'];
}
