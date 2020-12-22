<?php

namespace App\model\backend;

use Illuminate\Database\Eloquent\Model;

class Chitiet_khuyenmai extends Model
{
   public $timestamps = false; //set time to false
    protected $fillable = [
    	'khuyenmai_id', 'product_id','discount'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'chitiet_khuyenmai';
}
