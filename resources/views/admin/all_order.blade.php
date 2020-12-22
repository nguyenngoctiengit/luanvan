@extends('admin.admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê danh sách đơn hàng
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-3 m-b-xs">
        @php
              $current=now('Asia/Ho_Chi_Minh');
              $timezone = "Asia/Ho_Chi_Minh";
              date_default_timezone_set($timezone);
              $current = date("Y-m-d");
              $select_status=array('-1'=>'All','1'=>'Chưa xử lý','2'=>'Đã xử lý','3'=>'Đã hoàn thành','0'=>'Đã hủy');
              // $current=null;

              if($request_tk==null){
                $id_order="";
                $date_order=$current;
                $phone_order="";
                $name_order="";
              }else{
                $id_order=$request_tk->id_order;
                $date_order=$request_tk->date_order;
                $phone_order=$request_tk->phone_order;;
                $name_order=$request_tk->name_order;;
              }

        @endphp
        <form method="get" action="{{URL::to('/all-order')}}">
        <select name="select_status" class="input-sm form-control w-sm inline v-middle">
         @foreach ($select_status as $key => $value)
         @if($status!=null)
         @if($key==$status)
         <option selected value="{{$key}}">{{$value}}</option>
         @else
         <option value="{{$key}}">{{$value}}</option>
         @endif
         @else
         <option value="{{$key}}">{{$value}}</option>
         @endif
         @endforeach
        </select>
        <button type="submit" class="btn btn-sm btn-default">Apply</button> 
        </form>               
      </div>
     <div style="margin-top: 10px" class="col-sm-12">
      <form method="get" action="{{URL::to('tim-kiem-order')}}">
       <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">ID:</span>
          <input value="{{$id_order}}" style="width: 100px" type="number" name="id_order" ...>
          <span class="input-group-text">Ngày:</span>
          <input style="width: 150px" value="{{$date_order}}" type="date" name="date_order" ...>
          <span class="input-group-text">SDT:</span>
          <input style="width: 150px" value="{{$phone_order}}" name="phone_order" ...>
          <span class="input-group-text">Name:</span>
          <input style="width: 150px" value="{{$name_order}}" name="name_order" ...>
          <span class="input-group-text">Status:</span>
          <select name="select_status">
           @foreach ($select_status as $key => $value)
           @if($status!=null)
           @if($key==$status)
           <option selected value="{{$key}}">{{$value}}</option>
           @else
           <option value="{{$key}}">{{$value}}</option>
           @endif
           @else
           <option value="{{$key}}">{{$value}}</option>
           @endif
           @endforeach
        </select>
        </div>
        <span style="font-size: 14px" class="input-group-btn">
          <input type="submit" value="Tìm">
        </span>
      </div>
    </form>
     </div>
    </div>
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th style="text-align:center" class="order_th">ID</th>
            <th style="text-align:center" class="order_th">Total</th>
            <th style="text-align:center" class="order_th">Trạng thái</th>
            <th style="text-align:center" class="order_th">Ngày đặt</th>  
             <th style="text-align:center" class="order_th">Người duyệt</th> 
             <th class="order_th" style="text-align: center;">Action</th>                  
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_order as $key => $item)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $item->id}}</td>
            <td>{{number_format($item->total)}} VND</td>
            <td>
            	@php
            	$mang_select=array('1'=>'Chưa xử lý','2'=>'Đã xử lý','3'=>'Đã hoàn thành','0'=>'Đã hủy');
            	@endphp
            	@if($item->status==0||$item->status==3)
              @if($item->status==0)
                <select style="width: 117px" disabled="disabled">
                  <option>Đã hủy</option>
                </select>
                @else
                 <select disabled="disabled">
                  <option>Đã hoàn thành</option>
                </select>
                @endif
                 <button disabled="disabled" style="width: 100px;height: 30px">Cập nhật</button>
              @else
            	<select style="width: 117px" class="select_status_{{$item->id}}">
            		@foreach($mang_select as $key=>$item_select)
            		@if($key==$item->status)
            		<option selected value="{{$key}}">{{$item_select}}</option>
            		@else
            		<option value="{{$key}}">{{$item_select}}</option>
            		@endif
            		@endforeach
            	</select>
            	<button id="change_status_{{$item->id}}" class="change_status" data-id_order="{{$item->id}}" style="width: 100px;height: 30px">Cập nhật</button>
              @if($item->status!=2)
              <button id="check_order_{{$item->id}}" class="check_order" data-id_order="{{$item->id}}">Check</button>
              @endif
            	@endif
            </td>
             <td>{{ $item->created_at}}</td>
              <td id="name_duyet_{{$item->id}}">{{ $item->name}}</td>
            <td style="text-align: center;">         
            	<button style="width: 100px!important" class="btn-xem-chitiet" data-id_order="{{$item->id}}">Xem chi tiết</button>
            </td>
          </tr>
          <tr>
          	<td colspan="7" id="{{$item->id}}"></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            {{$all_order->links()}}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection