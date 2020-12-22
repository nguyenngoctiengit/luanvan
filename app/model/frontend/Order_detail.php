<?php

namespace App\model\frontend;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
   public $timestamps = false; //set time to false
    protected $primaryKey = 'id';
 	protected $table = 'order_detail';
}
