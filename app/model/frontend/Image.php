<?php

namespace App\model\frontend;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
     public $timestamps = false; //set time to false
    protected $primaryKey = 'image_id';
 	protected $table = 'image_product';
}
