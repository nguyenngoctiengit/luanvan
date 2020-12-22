@extends('admin.admin_layout')
@section('admin_content')
<div class="table-agile-info">
  
  <div class="panel panel-default">
    <div class="panel-heading">
     Thông tin chi tiết sản phẩm
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
           
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Màu sắc</th>
            <th>Chất liệu</th>
            <th>Ngăn đựng</th>
            <th>Size</th>
            <th>Bảo hành</th>
            <th>Weight</th>
            <th>Tải trọng</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        
          <tr>
            <td>{{$detail ->name}}</td>
            <td>{{$detail ->count}}</td>
            <td>{{$detail ->color}}</td>
            <td>{{$detail ->chatlieu}}</td>
            <td>{{$detail ->ngandung}}</td>
            <td>{{$detail ->size}}</td>
            <td>{{$detail ->baohanh}}</td>
            <td>{{$detail ->weight}}</td>
            <td>{{$detail ->taitrong}}</td>

          </tr>
     
        </tbody>
      </table>

    </div>
   
  </div>
</div>
</div>
@endsection