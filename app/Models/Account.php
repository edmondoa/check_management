<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
	protected $table = 'accounts';
    public $timestamps = false;

    protected $primaryKey = 'account_id';
    
    protected $fillable =['bank_code','account_no','is_active',
    			'notes','created_on','created_user_id'];

    public static $rules =[    				
    				'account_no' => 'required|numeric|unique:accounts,account_no',
    				'bank_code' => 'required |max:3|min:3']	;

    public function checkbooks()
    {
    	return $this->hasMany('App\Models\CheckBook','account_id');
    }				
}
