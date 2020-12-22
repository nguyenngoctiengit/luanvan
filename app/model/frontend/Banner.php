<?php

namespace App\model\frontend;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public $timestamps = false; //set time to false
    protected $primaryKey = 'banner_id';
 	protected $table = 'banner';
}
