<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payee extends Model
{
    protected $table = 'payees';
    public $timestamps = false;

    protected $primaryKey = 'payee_id';
    
    protected $fillable =['payee_name','is_active',
    			'notes','created_on','created_user_id'];

    public static $rules =[    				
    				'payee_name' => 'required|unique:payees,payee_name'];
    				
}
