<?php

namespace App\model\backend;

use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'name', 'slug', 'mota','price','image','count','status','color','chatlieu','ngandung','size','baohanh','weight','taitrong'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'Product';
}
