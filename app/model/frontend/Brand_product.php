<?php

namespace App\model\frontend;

use Illuminate\Database\Eloquent\Model;

class Brand_product extends Model
{
     public $timestamps = false; //set time to false
    protected $primaryKey = 'brand_id';
 	protected $table = 'brand_product';
}
