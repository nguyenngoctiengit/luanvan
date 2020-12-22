<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Mail;
use PDF;
class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gửi mail tự động';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $khuyenmai=DB::select("SELECT id,subject,content,ngaybatdau,ngayketthuc FROM `khuyenmai` WHERE (DATEDIFF(CURDATE(),ngaybatdau))=0");
         if(count($khuyenmai)>0){
         $wishlist=DB::table('wishlist')->join('users','users.id_wishlist','=','wishlist.id')->select('name','email','id_wishlist')->get();
         foreach ($wishlist as $key => $item_wishlist) {
            foreach ($khuyenmai as $key => $item_km) {
                $wish_km=DB::select('SELECT discount,name,price,image FROM `chitiet_khuyenmai` join chitiet_wishlist on chitiet_wishlist.id_product=chitiet_khuyenmai.product_id join product on product.id=chitiet_wishlist.id_product where chitiet_khuyenmai.khuyenmai_id=? and chitiet_wishlist.id_wishlist=?',[$item_km->id,$item_wishlist->id_wishlist]);

                $data=['khuyenmai'=>$item_km,'wishlist'=>$item_wishlist];
                   if(count($wish_km)>0){

                    $html='<!DOCTYPE html>
                    <html>
                    <head>
                    <meta charset="UTF-8">
                    <title></title>
                    <style>
                    body{font-family:DejaVu Sans,sans-serif}
                    </style>
                    </head>
                    <body>
                    <h2 style="text-align:center">THÔNG TIN CHI TIẾT KHUYẾN MÃI</h2>
                    <table style="width:100%"> 
                    <tr>
                    <th style="width:200px">Tên sản phẩm</th>
                    <th>Hình</th>
                    <th>Giá</th>
                    <th>Giá khuyến mãi</th>
                    <th>Discount</th>
                    </tr> 
                    ';

                    $html_km='
                    <table>     
                    <tr>
                    <th style="text-align:left">Chủ đề:</th>
                    <td>:</td>
                    <td>'.$item_km->subject.'</td>
                    </tr>

                    <tr style="text-align:left">
                    <th style="text-align:left">Nội dung</th>
                    <td>:</td>
                    <td>'.$item_km->content.' VND</td>
                    </tr>

                    <tr style="text-align:left">
                    <th style="text-align:left">Ngày bắt đầu</th>
                    <td>:</td>
                    <td>'.$item_km->ngaybatdau.'</td>
                    </tr>

                     <tr style="text-align:left">
                    <th style="text-align:left">Ngày kết thúc</th>
                    <td>:</td>
                    <td>'.$item_km->ngayketthuc.'</td>
                    </tr>

                    </table>
                    <h4 style="text-align:center">THÔNG TIN KHUYẾN MÃI</h4>
                    ';

                     $html_product='';
                    // dd($wish_km);
                    foreach ($wish_km as $key => $item_product_wish) {
                       $url=public_path().'/uploads/product/'.$item_product_wish->image;
                       // dd($url);
                       $html_product.='<tr style="text-align:center">
                       <td>'.$item_product_wish->name.'</td>
                       <td><img width="100px" src="'.$url.'"</td>
                       <td>'.number_format($item_product_wish->price).'VND</td>
                       <td>'.number_format(($item_product_wish->price-($item_product_wish->price*$item_product_wish->discount)/100)).'VND</td>
                       <td>'.$item_product_wish->discount.'%</td>
                        </tr>';
                    }

                    $html.=$html_product.$html_km.'
                    </table>
                    </body>
                    </html>
                    ';
                   $pdf=\App::make('dompdf.wrapper');
                    $pdf=PDF::setOptions ([
             'logOutputFile' => Storage_path ( 'log / log.htm' ),
             'tempDir' => Storage_path ( 'log /' )
        ])->loadHTML($html)->save('wishlist.pdf');
                    $email=$item_wishlist->email;
                   Mail::send('pages.email.wishlist',$data,function($message) use ($email){
                           $message->to($email,'Thông báo khuyến mãi')->subject('Thông báo khuyến mãi');
                           $message->attach("wishlist.pdf");
                       });
                   }
            }
         }
     }  
    }
}
