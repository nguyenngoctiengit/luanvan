<?php

namespace App\model\frontend;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    public $timestamps = false; //set time to false
    protected $primaryKey = 'id';
 	protected $table = 'shipping';


}
