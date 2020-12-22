<?php

namespace App\model\backend;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
   public $timestamps = false; //set time to false
    protected $fillable = [
    	'name', 'email','phone','address'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'brand_product';
}
