@extends('admin.admin_layout')
@section('admin_content')
<style> 
        table.scrolldown { 
            width: 900px; 
              
            /* border-collapse: collapse; */ 
            border-spacing: 0; 
            border: 2px solid black; 
        }
        button{
          height: 25px;
          font-size: 20px;
        }
        /* To display the block as level element */ 
        table.scrolldown tbody, table.scrolldown thead { 
            display: block; 
        }  
          
        thead tr th{ 
            height: 30px;  
            line-height: 30px; 
        } 
        td{
          padding: 5px;
          line-height: 10px;
        }
          
        table.scrolldown tbody { 
              
            /* Set the height of table body */ 
            height: 200px;  
              
            /* Set vertical scroll */ 
            overflow-y: auto; 
              
            /* Hide the horizontal scroll */ 
            overflow-x: hidden;  
        } 
          
        tbody {  
            border-top: 2px solid black; 
        } 
          
        tbody td, thead th { 
            border-right: 2px solid black; 
        } 
        td { 
            text-align:center; 
        } 



        /*phần tử phủ toàn màn hình,không được hiển thị*/
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
a, a:visited, a:active{
    text-decoration:none;
}
.them-ct-phieunhap
{
    background-color:#85B561;
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
 
.them-ct-phieunhap .phieunhap_title
{
    color:white;
    font-size:20px;
    padding:8px 0 5px 8px;
    text-align:left;
}
.sua-ct-phieunhap
{
    background-color:#85B561;
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
.sua-ct-phieunhap .phieunhap_title
{
    color:white;
    font-size:20px;
    padding:8px 0 5px 8px;
    text-align:left;
}
.them-phieunhap
{
    background-color:#85B561;
    height:auto;
    width:600px;
    font-family:Verdana, Arial, Helvetica, sans-serif;
    font-size:15px;
    padding-bottom:5px;
    display:none;
    overflow:hidden;
    position:absolute;
    z-index:99999;
    top:40%;
    left:30%;
}
.sua-phieunhap
{
    background-color:#85B561;
    height:auto;
    width:600px;
    font-family:Verdana, Arial, Helvetica, sans-serif;
    font-size:15px;
    padding-bottom:5px;
    display:none;
    overflow:hidden;
    position:absolute;
    z-index:99999;
    top:40%;
    left:30%;
}
.sua-phieunhap .phieunhap_title
{
    color:white;
    font-size:20px;
    padding:8px 0 5px 8px;
    text-align:left;
}
 
.them-phieunhap .phieunhap_title
{
    color:white;
    font-size:20px;
    padding:8px 0 5px 8px;
    text-align:left;
}
 
.phieunhap-content label {
    display: block;
    padding-bottom: 7px;
}
 
.phieunhap-content span {
    display: block;
}
.phieunhap-content
{
    padding-left:35px;
    background-color:white;
    margin-left:5px;
    margin-right:5px;
    height:auto;
    padding-top:15px;
    overflow:hidden;
}
 
.img-close {
    float: right;
}
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
}
.button:hover{
     border: 1px solid #DCDCDC;
    text-decoration: none;
    -moz-box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    box-shadow: 0 2px 2px rgba(0,0,0,0.1);
}
.phieunhap input
{
    border:1px solid #D5D5D5;
    border-radius:5px;
    box-shadow:1px 1px 5px rgba(0,0,0,.07) inset;
    color:black;
    font:12px/25px "Droid Sans","Helvetica Neue",Helvetica,Arial,sans-serif;
    height:28px;
    padding:0px 8px;
    word-spacing:0.1em;
    width:300px;
}
.them-ptn{
    display: inline-block;
    padding: auto;
    margin: 15px 75px;
    width: 150px;
}
    </style> 
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê phiếu nhập sản phẩm
    </div>
   
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
        <a style="margin:5px 40px;width: 180px;height: 30px" class="them-phieunhap-window button" href="#them-phieunhap-box">Tạo phiếu nhập</a>

      <table style="margin: 0px 50px" class="scrolldown"> 
           <caption style="font-size: 20px;font-weight: 500;" align="top">Danh sách phiếu nhập</caption>
        <!-- Table head content -->
        <thead> 
            <tr> 
                <th style="text-align: center;width: 120px">ID phiếu nhập</th> 
                <th style="text-align: center;width: 450px">Chủ đề</th> 
                <th style="text-align: center;width: 140px" >Ngày nhập</th> 
                 <th style="text-align: center;width: 160px"  >Action</th> 
            </tr> 
        </thead> 
          
        <!-- Table body content -->
        <tbody> 
           @foreach($all_phieunhap as $key => $item)
            <tr class="thaydoimau" id="thaydoimau-{{$item->id}}"> 
                <td style="text-align: center;width: 120px">{{ $item->id }}</td> 
                <td style="text-align: center;width: 450px">{{ $item->title }}</td> 
                <td style="text-align: center;width: 140px">{{ $item->ngaynhap }}</td>
                <td style="text-align: center;width: 167px">
                <button class="chitiet-phieunhap" data-id_phieunhap="{{$item->id}}"><i class="fa fa-eye text-success text-active"></i></button>
               {{--  <button class="them-chitiet-phieunhap" data-id_phieunhap="{{$item->id}}"><i class="fa fa-plus text-success text-active"></i></button> --}}
               <a data-id_phieunhap="{{$item->id}}" class="them-ct-phieunhap-window button" href="#them-ct-phieunhap-box"><i class="fa fa-plus text-success text-active"></i></a>
                <a data-id_phieunhap="{{$item->id}}" class="sua-phieunhap-window button" href="#sua-phieunhap-box"><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                @php
            $count=DB::table('chitiet_phieunhap')->where('phieunhap_id',$item->id)->count();
                @endphp
                @if($count==0)
                 <a data-id_phieunhap="{{$item->id}}" class="xoa-phieunhap-window button" href="#xoa-phieunhap-box"><i class="fa fa-times text-danger text"></i></a>
                 @endif
                </td>  
            </tr>  
            @endforeach            
        </tbody> 
    </table> 
   {{-- Form thêm chi tiết phiếu nhâp --}}
    <div class="them-ct-phieunhap" id="them-ct-phieunhap-box"><span class="phieunhap_title">Thêm chi tiết phiếu nhập</span>
      <a class="close" href="#"><img width="30px" height="25px" class="img-close" title="Close Window" alt="Close" src="{{URL::to('frontend/images/about-us/icon/Close-icon.png')}}" /></a>
     <form class="phieunhap-content" action="{{URL::to('/save-chitiet-phieunhap')}}" method="POST">
      @csrf
      <input type="hidden" class="id_phieunhap" value="">
      <label>
       <span>Số lượng thêm vào</span>
       <input value="1" min="1" type="number" autocomplete="on" class="quantity" placeholder="Số lượng nhập" value="" />
     </label>
     <label>
       <span>Sản phẩm</span>
       <select class="product_phieunhap" style="width: 500px;">
       </select>
     </label>
     <button class="button them-ptn" type="button">Thêm</button>
 </form></div>
{{-- ---------------------Form sửa chi tiết phiếu nhập-------------------------------- --}}
 <div class="sua-ct-phieunhap" id="sua-ct-phieunhap-box"><span class="phieunhap_title">Sửa chi tiết phiếu nhập</span>
      <a class="close" href="#"><img width="30px" height="25px" class="img-close" title="Close Window" alt="Close" src="{{URL::to('frontend/images/about-us/icon/Close-icon.png')}}" /></a>
     <form class="phieunhap-content" action="{{URL::to('/update-chitiet-phieunhap')}}" method="POST">
      @csrf
      <input type="hidden" class="id-ct-phieunhap" value="">
      <label>
       <span>Số lượng đã thêm</span>
       <input value="1" min="1" type="number" autocomplete="on" class="quantity-sua" placeholder="Số lượng nhập" value="" />
     </label>
     <label>
       <span>Sản phẩm</span>
       <select class="id-product" style="width: 500px;">
       </select>
     </label>
     <button class="button them-ptn sua-ct-pn" type="button">Sửa</button>
 </form></div>

{{-- -------------------------------------------------------------------- --}}

{{-- Form thêm phiếu nhập --}}
@php
              $timezone = "Asia/Ho_Chi_Minh";
              date_default_timezone_set($timezone);
              $current = date("Y-m-d");
@endphp
 <div class="them-phieunhap" id="them-phieunhap-box"><span class="phieunhap_title">Thêm phiếu nhập</span>
      <a class="close" href="#"><img width="30px" height="25px" class="img-close" title="Close Window" alt="Close" src="{{URL::to('frontend/images/about-us/icon/Close-icon.png')}}" /></a>
     <form class="phieunhap-content" method="POST" action="{{URL::to('/save-phieunhap-product')}}">
      @csrf
      <label>
       <span>Tiêu đề</span>
      <input type="text" class="title-phieunhap">
     </label>
     <label>
       <span>Ngày tạo</span>
      <input value="{{$current}}" type="date" class="date-phieunhap">
     </label>
     <button class="button them-ptn btn-them-phieunhap" type="button">Thêm</button>
 </form></div>


{{-- -- ------------------------------------------------------------}}

{{-- Form sửa phiếu nhập --}}
@php
              $timezone = "Asia/Ho_Chi_Minh";
              date_default_timezone_set($timezone);
              $current = date("Y-m-d");
@endphp
 <div class="sua-phieunhap" id="sua-phieunhap-box"><span class="phieunhap_title">Sửa phiếu nhập</span>
      <a class="close" href="#"><img width="30px" height="25px" class="img-close" title="Close Window" alt="Close" src="{{URL::to('frontend/images/about-us/icon/Close-icon.png')}}" /></a>
     <form class="phieunhap-content" method="POST" action="{{URL::to('/update-phieunhap-product')}}">
      @csrf
      <input type="hidden" class="id_phieunhap-sua" value="">
      <label>
       <span>Tiêu đề</span>
      <input type="text" class="title-phieunhap-sua">
     </label>
     <label>
       <span>Ngày tạo</span>
      <input value="{{$current}}" type="date" class="date-phieunhap-sua">
     </label>
     <button class="button them-ptn btn-sua-phieunhap" type="button">Cập nhật</button>
 </form></div>


{{-- -- ------------------------------------------------------------}}
    <table style="margin: 0px 50px" id="scrolldown-ct" class="scrolldown"> 
          <caption style="font-size: 20px;font-weight: 500;" align="top">Chi tiết phiếu nhập</caption>
        <!-- Table head content -->
        <thead> 
            <tr width="1000px"> 
                 <th style="text-align: center;" width="98px">ID</th> 
                <th style="text-align: center;"  width="100px">SL nhập</th> 
                <th style="text-align: center;"  width="120px">ID SP</th> 
                 <th style="text-align: center;"  width="367px">Tên sản phẩm</th> 
                 <th style="text-align: center;"  width="100px">Hình ảnh</th> 
                  <th style="text-align: center;"  width="100px">Action</th> 
            </tr> 
        </thead> 
          
        <!-- Table body content -->
        <tbody id="xem-ct-pn"> 
        </tbody> 
    </table> 
    </div>
    
  </div>
</div>
@endsection