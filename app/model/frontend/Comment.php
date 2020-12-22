<?php

namespace App\model\frontend;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps = false; //set time to false
    protected $primaryKey = 'comment_id';
 	protected $table = 'comment';
}
