<?php

namespace App\model\frontend;

use Illuminate\Database\Eloquent\Model;

class Chitiet_khuyenmai extends Model
{
    public $timestamps = false; //set time to false
    protected $primaryKey = 'id';
 	protected $table = 'chitiet_khuyenmai';
}
