<?php

namespace App\model\backend;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'email', 'password', 'name','phone'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'admin';
}
