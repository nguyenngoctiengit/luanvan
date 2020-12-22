<?php

namespace App\model\frontend;

use Illuminate\Database\Eloquent\Model;

class news extends Model
{
    public $timestamps = false; //set time to false
    protected $primaryKey = 'id';
 	protected $table = 'news';
}
