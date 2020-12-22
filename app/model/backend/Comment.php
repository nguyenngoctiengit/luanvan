<?php

namespace App\model\backend;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
   public $timestamps = false; //set time to false
    protected $fillable = [
    	'email', 'name','rate','content','news_id','user_id'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'comment';
}
