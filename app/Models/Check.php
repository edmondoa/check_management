<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
     protected $table = 'checks';
    public $timestamps = false;

    protected $primaryKey = 'check_id';
    
    protected $fillable =['checkbook_id','check_no','check_amount',
    			'notes','check_status_id','created_on','created_user_id'];


}
