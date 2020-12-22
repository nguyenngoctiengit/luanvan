<?php

namespace App\model\frontend;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false; //set time to false
    protected $primaryKey = 'category_id';
 	protected $table = 'category_product';
}
