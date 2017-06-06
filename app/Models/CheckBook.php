<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckBook extends Model
{
    protected $table = 'checkbooks';
    public $timestamps = false;

    protected $primaryKey = 'checkbook_id';
    
    protected $fillable =['account_id','check_number_start_no','check_number_end_no',
    			'created_on','created_user_id'];

    public static $rules =[    				
    				'account_id' => 'required',
    				'check_number_start_no' => 'required|numeric',
    				'check_number_end_no' => 'required | numeric']	;

    public function availableIssuance()
    {
    	return $this->hasMany('App\Models\Check','checkbook_id')->where('checks.check_status_id',1);
    }				
}
