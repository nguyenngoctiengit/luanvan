@extends('admin.admin_layout')
@section('admin_content')
<style type="text/css">
  .button{
    display: inline-block;
    text-align: center;
    color: #444;
    width: 30px;
    font-size: 20px;
    font-weight: 700;
    height: 25px;
    padding: 0px 8px;
    line-height: 25px;
    border-radius: 4px;
    transition: all 0.218s ease 0s;
    border: 1px solid #DCDCDC;
    background-color: #F5F5F5;
    background-image: -moz-linear-gradient(center top , #F5F5F5, #F1F1F1);
    cursor: pointer;
    text-decoration: none;
}
a, a:visited, a:active{
    text-decoration:none;
}
#over {
    display: none;
    background: #000;
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    opacity: 0.8;
    z-index: 999;
}
.khuyenmai
{
    background-color:#FFFFCC;
    height:auto;
    width:600px;
    font-family:Verdana, Arial, Helvetica, sans-serif;
    font-size:15px;
    padding-bottom:5px;
    display:none;
    overflow:hidden;
    position:absolute;
    z-index:99999;
    top:20%;
    left:30%;
}
.khuyenmai_title
{
    font-weight: bold;
    font-size:20px;
    margin-left: 35%;
    line-height: 40px;
}
.khuyenmai-content{
   padding-left:35px;
    background-color:white;
    margin-left:5px;
    margin-right:5px;
    height:auto;
    padding-top:15px;
    overflow:hidden;
}
.kc-input-khuyenmai{
  margin-bottom: 10px;
}
.button-action{
  width: 150px;
}
/*-----------------------------------------End dialog khuyến mãi---------------------------*/
/*-----------------------Data table chi tiet khuyen mai-----------------*/
table.dataTable thead .sorting:after,
table.dataTable thead .sorting:before,
table.dataTable thead .sorting_asc:after,
table.dataTable thead .sorting_asc:before,
table.dataTable thead .sorting_asc_disabled:after,
table.dataTable thead .sorting_asc_disabled:before,
table.dataTable thead .sorting_desc:after,
table.dataTable thead .sorting_desc:before,
table.dataTable thead .sorting_desc_disabled:after,
table.dataTable thead .sorting_desc_disabled:before {
bottom: .5em;
}
.dtVerticalScrollExample{
  display: none;
}
.dataTables_scrollBody{
  text-align: center;
}
table thead tr th{
  text-align: center;
}

/*------------------------------------End----------------------------------------*/
</style>
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê khuyến mãi
    </div>
    <div style="padding-top: 1em" class="row w3-res-tb">
      <div class="col-sm-3 m-b-xs">
        @php
        $arr=['-1'=>"All",'1'=>"Khuyến mãi có hiệu lực",'0'=>"Khuyến mãi không hiệu lực"]
        @endphp
        <form method="get" action="{{URL::to('/all-khuyenmai')}}" style="font-size: 15px">
        <select class="input-sm form-control w-sm inline v-middle" name="khuyenmai">
            @if(isset($select))
              @foreach($arr as $key=>$value)
                @if($key==$select)
                 <option selected value="{{$key}}">{{$value}}</option>
                 @else
                  <option value="{{$key}}">{{$value}}</option>
                @endif
              @endforeach
              @else
              @foreach($arr as $key=>$value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
            @endif
             
        </select>
        <button type="submit" class="btn btn-sm btn-default">Apply</button>   
        </form>             
      </div>
      <div class="col-sm-3">
             <a style="font-size: 13px;width: 150px;height: 30px" class="them-khuyenmai-window button" href="#them-khuyenmai-box">Tạo khuyến mãi</a>
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
      <div class="container">
      <div style="margin:20px 0px;" class="row">
        <div style="margin-left: -15px" class="col-lg-1"><b>ID</b></div>
        <div class="col-lg-2"><b>Slug thân thiện</b></div>
        <div style="text-align: center;" class="col-lg-2"><b>Chủ đề</b></div>
        <div style="text-align: center;" class="col-lg-1"><b>Hình</b></div>
        <div style="margin-left: 10px" class="col-lg-2"><b>Ngày Start</b></div>
        <div style="margin-left: 10px" class="col-lg-2"><b>Ngày End</b></div>
        <div style="text-align: center;margin-right: -10px" class="col-lg-2"><b>Action</b></div>
      </div>
       @foreach($all_khuyenmai as $key => $kh)
          <div class="row align-items-start">
             <div class="col-sm-1">{{ $kh->id}}</div>
              <div class="col-sm-2">{{ $kh->slug}}</div>
            <div class="col-sm-2">{{ $kh->subject}}</div>
             <div class="col-sm-1"><img width="50px" src="{{URL::to('uploads/khuyenmai/'.$kh->image)}}"></div>
            <div class="col-sm-2">{{ $kh->ngaybatdau}}</div>
            <div class="col-sm-2">{{ $kh->ngayketthuc}}</div>
             <div style="padding-left: 0px;padding-right: 0px" class="col-sm-2">
                <a class="xem-ct-khuyenmai button" data-id_khuyenmai="{{$kh->id}}"><i class="fa fa-eye text-success text-active"></i></a>
               <a data-id_khuyenmai="{{$kh->id}}" class="them-ct-khuyenmai-window button" href="#them-ct-khuyenmai-box"><i class="fa fa-plus text-success text-active"></i></a>
                <a data-id_khuyenmai="{{$kh->id}}" id="sua-khuyenmai_{{$kh->id}}" class="sua-khuyenmai-window button" href="#sua-khuyenmai-box"><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                  @php
            $count=DB::table('chitiet_khuyenmai')->where('khuyenmai_id',$kh->id)->count();
                @endphp
                @if($count==0)
                <a id="xoa-khuyenmai_{{$kh->id}}" data-id_khuyenmai="{{$kh->id}}" class="xoa-khuyenmai-window button" href="#xoa-khuyenmai-box"><i class="fa fa-times text-danger text"></i></a>
                 @endif
                <a id="xoa-xem-ct-khuyenmai_{{$kh->id}}" class="xoa-xem-ct-khuyenmai button" data-id_khuyenmai="{{$kh->id}}"><i class="fa fa-eye-slash text-danger text-active"></i></a>
             </div>
          </div>
          <table style="vertical-align: center" id="dtVerticalScrollExample_{{$kh->id}}" class="table table-striped table-bordered table-sm" cellspacing="0"
          width="100%">
        </table>
          <hr>
          @endforeach
 {{$all_khuyenmai->links()}}
    </div>

    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
{{--------------------------- Form thêm khuyến mãi---------------------------------- --}}
 <div class="khuyenmai" id="them-khuyenmai-box">

  <span class="khuyenmai_title">Thêm khuyến mãi</span>
      <a class="close" href="#"><img width="30px" height="25px" class="img-close" title="Close Window" alt="Close" src="{{URL::to('frontend/images/about-us/icon/Close-icon.png')}}" /></a>
     <form id="form-them-khuyenmai" class="khuyenmai-content" method="POST" enctype="multipart/form-data" action="{{URL::to('/save-khuyenmai')}}">
      @csrf
      <div id="title-them-khuyenmai" class="row">
      <label class="col-sm-3">
       <span>Chủ đề:</span>
     </label>
     <input name="title" type="text" class="col-sm-8 kc-input-khuyenmai">
     </div>
      <div id="slug-them-khuyenmai" class="row">
     <label class="col-sm-3">
       <span>Slug:</span>
     </label>
     <input name="slug" type="text" class="col-sm-8 kc-input-khuyenmai">
     </div>
      <div id="image-them-khuyenmai" class="row"> 
     <label class="col-sm-3">
       <span style="margin: 0;padding: 0">Hình ảnh:</span>
     </label>
      <input name="hinh" style="padding: 0" type="file" class="col-sm-8 kc-input-khuyenmai">
      </div>
       <div id="start-them-khuyenmai" class="row">
      <label class="col-sm-3">
       <span>Ngày start:</span>
     </label>
      <input name="start" type="date" class="col-sm-8 kc-input-khuyenmai">
      </div>
       <div id="end-them-khuyenmai" class="row">
       <label class="col-sm-3">
       <span>Ngày end:</span>
     </label>
     <input name="end" type="date" class="col-sm-8 kc-input-khuyenmai">
     </div>
      <div id="content-them-khuyenmai" class="row">
      <label class="col-sm-3">
       <span>Nội dung:</span>
     </label>
     <textarea name="content" rows="4" cols="50" class="col-sm-8 kc-input-khuyenmai"></textarea>
     </div>
     <input class="button-action" type="submit" value="Thêm">
 </form></div>

{{---------------------------- End ----------------------------------------------------}}
{{--------------------------- Form sửa khuyến mãi---------------------------------- --}}
 <div class="khuyenmai" id="sua-khuyenmai-box">

  <span class="khuyenmai_title">Sửa khuyến mãi</span>
      <a class="close" href="#"><img width="30px" height="25px" class="img-close" title="Close Window" alt="Close" src="{{URL::to('frontend/images/about-us/icon/Close-icon.png')}}" /></a>
     <form id="form-sua-khuyenmai" class="khuyenmai-content" method="POST" enctype="multipart/form-data" action="{{URL::to('/update-khuyenmai')}}">
      @csrf
      <input type="hidden" name="id" id="value-id-sua-khuyenmai">
      <div id="title-sua-khuyenmai" class="row">
      <label class="col-sm-3">
       <span>Chủ đề:</span>
     </label>
     <input name="title" id="value-title-sua-khuyenmai" type="text" class="col-sm-8 kc-input-khuyenmai">
     </div>
      <div id="slug-sua-khuyenmai" class="row">
     <label class="col-sm-3">
       <span>Slug:</span>
     </label>
     <input id="value-slug-sua-khuyenmai" name="slug" type="text" class="col-sm-8 kc-input-khuyenmai">
     </div>
      <div id="image-sua-khuyenmai" class="row"> 
     <label class="col-sm-3">
       <span style="margin: 0;padding: 0">Hình ảnh:</span>
     </label>
      <input name="hinh" style="padding: 0" type="file" class="col-sm-8 kc-input-khuyenmai">
      <div class="col-sm-3"></div>
      <div style="padding-left: 0px" class="col-sm-3" id="value-image-sua-khuyenmai"></div>
      </div>
       <div id="start-sua-khuyenmai" class="row">
      <label class="col-sm-3">
       <span>Ngày start:</span>
     </label>
      <input id="value-start-sua-khuyenmai" name="start" type="date" class="col-sm-8 kc-input-khuyenmai">
      </div>
       <div id="end-sua-khuyenmai" class="row">
       <label class="col-sm-3">
       <span>Ngày end:</span>
     </label>
     <input id="value-end-sua-khuyenmai" name="end" type="date" class="col-sm-8 kc-input-khuyenmai">
     </div>
      <div id="content-sua-khuyenmai" class="row">
      <label class="col-sm-3">
       <span>Nội dung:</span>
     </label>
     <textarea id="value-content-sua-khuyenmai" name="content" rows="4" cols="50" class="col-sm-8 kc-input-khuyenmai"></textarea>
     </div>
     <input class="button-action" type="submit" value="Sửa">
 </form></div>

{{-------------------------------------End ------------------------------------}}
{{-- ------------------------Thêm chi tiết khuyến mãi--------------------- --}}

<div class="khuyenmai" id="them-ct-khuyenmai-box">
  <span class="khuyenmai_title">Thêm sản phẩm khuyến mãi</span>
      <a class="close" href="#"><img width="30px" height="25px" class="img-close" title="Close Window" alt="Close" src="{{URL::to('frontend/images/about-us/icon/Close-icon.png')}}" /></a>
     <form id="form-them-ct-khuyenmai" class="khuyenmai-content" method="POST" action="{{URL::to('/save-chitiet-khuyenmai')}}">
      @csrf
      <input type="hidden" name="id_khuyenmai" id="id-khuyenmai" value="">
      <div id="sp-them-ct-khuyenmai-1" class="row">
      <label class="col-sm-2">
       <span>Chọn sản phẩm 1:</span>
     </label>
     <select id="select-km-product-1" name="id_product_1" class="col-sm-3 kc-input-khuyenmai select-product">
      </select>
      <label style="margin-left: 30px" class="col-sm-1">
       <span>Price:</span>
     </label>
      <input style="width: 195px;margin-left: -30px" readonly="readonly" id="price-product-1" type="text" class="col-sm-2">
       <label style="width: 165px;" class="col-sm-2">
       <span>Nhập Discount:</span>
     </label>
      <input step="any" min="1" max="100" name="discount_product_1" id="discount-product-1" type="number" class="col-sm-1">
      <div style="clear: both;"></div>
      <div class="col-sm-2"> <button type="button" id="btn-tinh-gia-discount-1">Tính giá discount(%):</button></div>
    <input min="1" max="100" id="txt-discount-product-1" type="number" class="col-sm-1">
     <input style="margin-left: 20px;width: 195px" readonly="readonly" id="txt-result-discount-product-1" type="text" class="col-sm-2">
     <div class="col-sm-1"></div>
     <div style="margin-left: -73px;" class="col-sm-2"> <button type="button" id="btn-tinh-phan-tram-1">Tính phần trăm:</button></div>
    <input style="margin-left: -40px;width: 195px;" id="txt-price-product-1" type="text" class="col-sm-1">
     <input style="margin-left: 20px;width: 150px;" readonly="readonly" id="txt-result-price-product-1" type="text" class="col-sm-2">
     </div>  
     <hr>
      <div id="sp-them-ct-khuyenmai-2" class="row">
      <label class="col-sm-2">
       <span>Chọn sản phẩm 2:</span>
     </label>
     <select id="select-km-product-2" name="id_product_2" class="col-sm-3 kc-input-khuyenmai select-product">
      </select>
      <label style="margin-left: 30px" class="col-sm-1">
       <span>Price:</span>
     </label>
      <input style="width: 195px;margin-left: -30px" readonly="readonly" id="price-product-2" type="text" class="col-sm-2">
       <label style="width: 165px;" class="col-sm-2">
       <span>Nhập Discount:</span>
     </label>
      <input step="any" min="1" max="100" name="discount_product_2" id="discount-product-2" type="number" class="col-sm-1">
      <div style="clear: both;"></div>
      <div class="col-sm-2"> <button type="button" id="btn-tinh-gia-discount-2">Tính giá discount(%):</button></div>
    <input min="1" max="100" id="txt-discount-product-2" type="number" class="col-sm-1">
     <input style="margin-left: 20px;width: 195px" readonly="readonly" id="txt-result-discount-product-2" type="text" class="col-sm-1">
     <div class="col-sm-1"></div>
     <div style="margin-left: -73px;" class="col-sm-2"><button type="button" id="btn-tinh-phan-tram-2">Tính phần trăm:</button></div>
    <input style="margin-left: -40px;width: 195px;" id="txt-price-product-2" type="text" class="col-sm-1">
   
     <input style="margin-left: 20px;width: 150px;" readonly="readonly" id="txt-result-price-product-2" type="text" class="col-sm-1">
     </div>
      <hr>
      <div id="sp-them-ct-khuyenmai-3" class="row">
      <label class="col-sm-2">
       <span>Chọn sản phẩm 3:</span>
     </label>
     <select id="select-km-product-3" name="id_product_3" class="col-sm-3 kc-input-khuyenmai select-product">
      </select>
      <label style="margin-left: 30px" class="col-sm-1">
       <span>Price:</span>
     </label>
      <input style="width: 195px;margin-left: -30px" readonly="readonly" id="price-product-3" type="text" class="col-sm-2">
       <label style="width: 165px;" class="col-sm-2">
       <span>Nhập Discount:</span>
     </label>
      <input step="any" min="1" max="100" name="discount_product_3" id="discount-product-3" type="number" class="col-sm-1">
      <div style="clear: both;"></div>
      <div class="col-sm-2"> <button type="button" id="btn-tinh-gia-discount-3">Tính giá discount(%):</button></div>
    <input min="1" max="100" id="txt-discount-product-3" type="number" class="col-sm-1">
   
     <input style="margin-left: 20px;width: 195px" readonly="readonly" id="txt-result-discount-product-3" type="text" class="col-sm-1">
     <div class="col-sm-1"></div>
     <div style="margin-left: -73px;" class="col-sm-2"> <button type="button" id="btn-tinh-phan-tram-3">Tính phần trăm:</button></div>
    <input style="margin-left: -40px;width: 195px;" id="txt-price-product-3" type="text" class="col-sm-1">
     <input style="margin-left: 20px;width: 150px;" readonly="readonly" id="txt-result-price-product-3" type="text" class="col-sm-1">
     </div>
      <hr>
      <div id="sp-them-ct-khuyenmai-4" class="row">
      <label class="col-sm-2">
       <span>Chọn sản phẩm 4:</span>
     </label>
     <select id="select-km-product-4" name="id_product_4" class="col-sm-3 kc-input-khuyenmai select-product">
      </select>
      <label style="margin-left: 30px" class="col-sm-1">
       <span>Price:</span>
     </label>
      <input style="width: 195px;margin-left: -30px" readonly="readonly" id="price-product-4" type="text" class="col-sm-2">
       <label style="width: 165px;" class="col-sm-2">
       <span>Nhập Discount:</span>
     </label>
      <input step="any" min="1" max="100" name="discount_product_4" id="discount-product-4" type="number" class="col-sm-1">
      <div style="clear: both;"></div>
      <div class="col-sm-2"> <button type="button" id="btn-tinh-gia-discount-4">Tính giá discount(%):</button></div>
    <input min="1" max="100" id="txt-discount-product-4" type="number" class="col-sm-1">
     <input style="margin-left: 20px;width: 195px" readonly="readonly" id="txt-result-discount-product-4" type="text" class="col-sm-1">
     <div class="col-sm-1"></div>
     <div style="margin-left: -73px;" class="col-sm-2"><button type="button" id="btn-tinh-phan-tram-4">Tính phần trăm:</button></div>
    <input style="margin-left: -40px;width: 195px;" id="txt-price-product-4" type="text" class="col-sm-1">
     <input style="margin-left: 20px;width: 150px;" readonly="readonly" id="txt-result-price-product-4" type="text" class="col-sm-1">
     </div>
      <hr>
      <div id="sp-them-ct-khuyenmai-5" class="row">
      <label class="col-sm-2">
       <span>Chọn sản phẩm 5:</span>
     </label>
     <select id="select-km-product-5" name="id_product_5" class="col-sm-3 kc-input-khuyenmai select-product">
      </select>
      <label style="margin-left: 30px" class="col-sm-1">
       <span>Price:</span>
     </label>
      <input style="width: 195px;margin-left: -30px" readonly="readonly" id="price-product-5" type="text" class="col-sm-2">
       <label style="width: 165px;" class="col-sm-2">
       <span>Nhập Discount:</span>
     </label>
      <input step="any" min="1" max="100" name="discount_product_5" id="discount-product-5" type="number" class="col-sm-1">
      <div style="clear: both;"></div>
      <div class="col-sm-2"> <button type="button" id="btn-tinh-gia-discount-5">Tính giá discount(%):</button></div>
    <input min="1" max="100" id="txt-discount-product-5" type="number" class="col-sm-1">
     <input style="margin-left: 20px;width: 195px" readonly="readonly" id="txt-result-discount-product-5" type="text" class="col-sm-1">
     <div class="col-sm-1"></div>
     <div style="margin-left: -73px;" class="col-sm-2"> <button type="button" id="btn-tinh-phan-tram-5">Tính phần trăm:</button></div>
    <input style="margin-left: -40px;width: 195px;" id="txt-price-product-5" type="text" class="col-sm-1">
     <input style="margin-left: 20px;width: 150px;" readonly="readonly" id="txt-result-price-product-5" type="text" class="col-sm-1">
     </div>
     <div class="col-sm-4"></div>    
     <input style="margin-top: 30px;margin-left: 50px;width: auto;" class="button button-action" type="submit" value="Thêm khuyến mãi">
 </form></div>
 {{------------------------ End form thêm chi tiết khuyến mãi------------------------- --}}
 {{-- -------------------------Form sửa chi tiết khuyến mãi--------------------------- --}}

<div class="khuyenmai" id="sua-ct-khuyenmai-box">

  <span class="khuyenmai_title">Sửa chi tiết khuyến mãi</span>
      <a class="close" href="#"><img width="30px" height="25px" class="img-close" title="Close Window" alt="Close" src="{{URL::to('frontend/images/about-us/icon/Close-icon.png')}}" /></a>
     <form id="form-ct-sua-khuyenmai" class="khuyenmai-content" method="POST" action="{{URL::to('/update-chitiet-khuyenmai')}}">
      @csrf
      <input type="hidden" name="id" id="id-sua-ct-khuyenmai">
      <input type="hidden" name="id_khuyenmai" id="ct-sua-id-khuyenmai">
      <div class="row">
      <label class="col-sm-3">
       <span>Sản phẩm:</span>
     </label>
     <select id="select-sua-ctkm" name="id_product" class="col-sm-8 kc-input-khuyenmai">
     </select>
     </div>
      <div style="margin-bottom: 30px" class="col-sm-4">
       <img id="img-product-sua-ctkm" width="110px" height="110px" class="img-close" title="Anh san phẩm" alt="Anh product"/>
     </div>
     <label class="col-sm-3">
       <span>Price:</span>
     </label>
     <input style="width: 200px" id="value-price-sua-ctkhuyenmai" readonly="readonly" type="text" class="col-sm-4 kc-input-khuyenmai">
     <div id="error-discount-sua-ctkm">
       <label class="col-sm-3">
       <span>Discount:</span>
     </label>
      <input style="width: 200px" id="value-discount-sua-ctkhuyenmai" name="discount" type="number" step="any" class="col-sm-4 kc-input-khuyenmai">
     </div>
     
       <label class="col-sm-3">
       <span>Price Discount:</span>
     </label>
     <input style="width: 200px" id="value-price-discount-sua-ctkhuyenmai" readonly="readonly" type="text" class="col-sm-4 kc-input-khuyenmai">
     <div style="clear: both;"></div>
       <label style="margin-left: -20px;width: 125px" class="col-sm-3">
       <span>Nhập (%):</span>
     </label>
     <input style="width: 110px" id="discount-input-sua-ct-km" type="number" class="col-sm-2 kc-input-khuyenmai">
     <button id="btn-tinh-gia-sua-ctkm" style="margin-left: 10px;width: 145px;" type="button" class="col-sm-3">
       <span>Tính giá giảm:</span>
    </button>
     <input style="margin-left: 12px;" id="result-tinh-gia-sua-ctkhuyenmai" readonly="readonly" type="text" class="col-sm-3 kc-input-khuyenmai">

      <label style="margin-left: -20px;width: 120px" class="col-sm-3">
       <span>Nhập giá:</span>
     </label>
     <input id="price-input-sua-ct-km" type="number" class="col-sm-3 kc-input-khuyenmai">
     <button id="btn-tinh-discount-sua-ctkm" style="margin-left: 10px;width: 145px;" type="button" class="col-sm-3">
       <span>Tính % giảm:</span>
    </button>
     <input style="margin-left: 10px;width: 120px" id="result-tinh-discount-ctkhuyenmai" readonly="readonly" type="text" class="col-sm-3 kc-input-khuyenmai">

     <input class="button-action" type="submit" value="Cập nhật">
 </form></div>

 {{-- ----------------------------------End---------------------------------------- --}}
{{--  <script language="javascript">
            // Hàm xử lý khi thẻ select thay đổi giá trị được chọn
            // obj là tham số truyền vào và cũng chính là thẻ select
            function genderChanged(obj)
            {
                 
            }
 
        </script> --}}


{{-- --------------------------------End---------------------------------- --}}
@endsection