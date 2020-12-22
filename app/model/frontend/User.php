<?php

namespace App\model\frontend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Model
{
   public $timestamps = false; //set time to false
    protected $primaryKey = 'id';
 	protected $table = 'users';
}
