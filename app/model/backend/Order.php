<?php

namespace App\model\backend;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public static function getListDayInMonth($year,$month){
		$arrayDay=[];
		//Lấy tất cả ngày trong tháng
		for ($day=1; $day <=31 ; $day++) { 
			$time=mktime(12,0,0,$month,$day,$year);
			if(date('m',$time)==$month){
				$arrayDay[]=date('Y-m-d',$time);
			}
		}
		return $arrayDay;
	} 
}
