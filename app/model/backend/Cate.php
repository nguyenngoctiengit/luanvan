<?php

namespace App\model\backend;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
	public $timestamps = false; //set time to false
    protected $fillable = [
    	'name', 'slug'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'category_product';
}
