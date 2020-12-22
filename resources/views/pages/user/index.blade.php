@extends('pages.user.layout')
@section('content1')
<style type="text/css">
  .circle {
    width: 200px;
    height: 200px;
    border-radius: 100%;
    font-size: 15px;
    color: #000000;
    line-height: 200px;
    text-align: center;
    background: #EEE5DE
  }
  /*#loadQLDH{
    background-color: red!important;
  }*/
</style>
<div class="col-9" style="padding-left: 30px">
 <h3 style="margin-top:20px">Thống kê đơn hàng của bạn</h3>
 <div class="row">
  <div class="col-3">
    <div class="circle">Số đơn hàng: {{$totalDonHang}}</div>
  </div>
  <div class="col-3">
    <div class="circle">Chưa xử lý: {{$chuaxuly}} </div>
  </div>
  <div class="col-3">
    <div class="circle">Đã xử lý: {{$daxuly}}</div>
  </div>
  <div class="col-3">
    <div class="circle">Đã giao dịch thành công: {{$thanhcong}}</div>
  </div>
</div>
<h3 style="margin-top:20px">Danh sách đơn hàng của bạn</h3>
<div class="row font-weight-bold">
    <div class="col-md-1">
       STT
    </div>
    <div class="col-md-2">
       Mã đơn hàng
    </div>
    <div class="col-md-2">
       Ngày đặt hàng
    </div>
    <div class="col-md-2">
      Tổng tiền
    </div>
    <div class="col-md-2">
      Trạng thái
    </div>
     <div class="col-md-3">
     Xem chi tiết/Hủy đơn hàng
    </div>
</div>
  <?php $stt=0; ?>
  @foreach($dsDonhang as $order)
   <?php $stt++; ?>
    <div class="form-group" >
      <div class="row" style="border: 1px solid:#000000" >
        <div class="col-md-1">
          {{$stt}}
        </div>
        <div class="col-md-2">
          {{$order->id}}
        </div>
         <div class="col-md-2">
          @php
          $new_date = date_format(date_create($order->created_at), 'Y-m-d');
          @endphp
          {{$new_date}}
        </div>
         <div class="col-md-2">
          {{number_format($order->total).' VND'}}
        </div>
         <div class="col-md-2 status_{{$order->id}}">
         @php
         $status="";
         if($order->status==1)
          $status="Chưa xử lý";
         elseif($order->status==2)
          $status="Đã xử lý";
        elseif($order->status==3)
          $status="Giao dịch thành công";
        elseif($order->status==0)
          $status="Đơn hàng đã hủy";
         @endphp
          {{$status}}
        </div>
         <div class="col-md-3">
         <input class="ctdh" style="height: 30px;width: 100px" type="button" id="{{$order->id}}" value="Xem chi tiết">
         <button class="huydonhang" data-id="{{$order->id}}" style="margin-left: 20px"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div id="{{$order->id}}">
      </div>
    </div>
  @endforeach
   {{$dsDonhang->links()}}    
</div>
</div>
@endsection