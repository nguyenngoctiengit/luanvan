<?php

namespace App\model\frontend;

use Illuminate\Database\Eloquent\Model;

class Khuyenmai extends Model
{
    public $timestamps = false; //set time to false
    protected $primaryKey = 'khuyenmai_id';
 	protected $table = 'khuyenmai';
}
