<?php

namespace App\model\backend;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
  public $timestamps = false; //set time to false
    protected $fillable = [
    	'image','name','product_id'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'image_product';
}
