<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckSettle extends Model
{
    protected $table = 'check_clears';

    public $timestamps = false;

    protected $primaryKey = 'check_id';
    protected $fillable = ['clear_date','check_id','clear_amount','check_user_id','created_on']; 
}
