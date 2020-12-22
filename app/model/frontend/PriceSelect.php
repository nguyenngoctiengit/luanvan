<?php

namespace App\model\frontend;

use Illuminate\Database\Eloquent\Model;

class PriceSelect extends Model
{
    public $timestamps = false; //set time to false
    protected $primaryKey = 'id';
 	protected $table = 'price_select';
}
