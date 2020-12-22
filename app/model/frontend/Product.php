<?php

namespace App\model\frontend;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false; //set time to false
    protected $primaryKey = 'product_id';
 	protected $table = 'product';


 	public function image(){
 		return $this->hasOne('App\model\frontend\Image');
 	}
}
