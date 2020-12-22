@extends('admin.admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê banner
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
            <th>ID</th>
            <th>Image</th>
            <th>Status</th>
            <th>Cập nhật</th>
            <th>Tên admin</th>
            <th>Loại banner(ID-title-loai)</th>          
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_banner as $key => $item)
          <tr>
            <td>{{ $item->id }}</td>
            <td><img width="100px" src="{{ URL::to('/uploads/banner/'.$item->image) }}"></td>  
             <td><span class="text-ellipsis">
              <?php
               if($item->status==1){
                ?>
                <a><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                <?php
                 }else{
                ?>  
                 <a><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                <?php
               }
              ?>
            </span></td>
            <td>{{ $item->created_at }}</td>  
            <td>{{ $item->name_admin }}</td> 
            <td style="width: 30%">
              @php
              if($item->news_id!=null){
                echo $item->news_id.'-'.$item->subject_new.'<span style="color: #00CC00">-banner tin tức</span>';
              }elseif($item->product_id!=null){
                echo $item->product_id.'-'.$item->name.'<span style="color: red">-banner sản phẩm </span>';
              }else{
                echo $item->khuyenmai_id.'-'.$item->subject_km.'<span style="color: #3366FF">-banner khuyến mãi</span>';
              }

              @endphp

            </td>         
            <td>
              <a href="{{URL::to('/edit-banner/'.$item->id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc là muốn xóa banner này ko?')" href="{{URL::to('/delete-banner/'.$item->id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
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
            {{$all_banner->links()}}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection