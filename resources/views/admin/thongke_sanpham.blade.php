@extends('admin.admin_layout')
@section('admin_content')
<style type="text/css">
  .container-fluid{
    width: 100%;
    padding-right: 7.5px;
    padding-left: 7.5px;
    margin-right: auto;
    margin-left: auto;
  }
  .bg-info, .bg-info>a {
    color: #fff!important;
}
.bg-info {
    background-color: #17a2b8!important;
}
.small-box>.inner {
    padding: 10px;
}
.small-box h3, .small-box p {
    z-index: 5;
}
.small-box p {
   font-size: 20px;
    text-align: center;
}
.small-box .icon {
    color: rgba(0,0,0,.15);
    z-index: 0;
}
.small-box>.small-box-footer {
    background: rgba(0,0,0,.1);
    color: rgba(255,255,255,.8);
    display: block;
    padding: 3px 0;
    position: relative;
    text-align: center;
    text-decoration: none;
    z-index: 10;
}
.bg-success, .bg-success>a {
    color: #fff!important;
}

.bg-success {
    background-color: #28a745!important;
}
.small-box {
    border-radius: .25rem;
    box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
    display: block;
    margin-bottom: 20px;
    position: relative;
}
.small-box>.inner {
    padding: 10px;
}
.bg-warning, .bg-warning>a {
    color: #ffffff!important;
}
.bg-warning {
    background-color: #ffc107!important;
}
.bg-danger, .bg-danger>a {
    color: #fff!important;
}

.bg-danger {
    background-color: #dc3545!important;
}

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
  .button{
    display: inline-block;
    text-align: center;
    cursor: pointer;
    text-decoration: none;
}
a, a:visited, a:active{
    text-decoration:none;
}

/*------------------------------------End----------------------------------------*/
</style>
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
     Thống kê sản phẩm
    </div>
    <div class="row w3-res-tb"> 
       <div style="margin-bottom: 20px;text-align: center;" class="col-sm-12 m-b-xs"> 
        @php
        $date_current=date('yy').'-'.date('m');
        // $$date_current==date('m');
        @endphp
        <input id="select_date_spbanchay" type="month" value="{{$date_current}}" name="select_date">    
      </div>
      <div style="clear: both;"></div>
        <div class="table-responsive">
       <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
               <h3 style="text-align: center;">{{$count_product}}</h3>
              <div class="inner">
                <p>Tổng số sản phẩm</p>
              </div>

              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a id="thong-ke-sp-danh-gia" class="button small-box-footer">Load đánh giá</a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
               <h3 style="text-align: center;">{{$product_ban_1st->totalSLBan}}</h3>
              <div class="inner">
                <p>Số lượng bán cao nhất</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
               <a id="thong-ke-sp-ban-chay" class="button small-box-footer">Load số lượng bán</a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <h3 style="text-align: center;">{{$product_km->discount}} %</h3>
              <div class="inner">
                <p>Khuyến mãi nhiều nhất</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a id="thong-ke-sp-khuyen-mai" class="button small-box-footer">Load khuyến mãi</a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <h3 style="text-align: center;">{{$count_product_het}}</h3>
              <div class="inner">
                <p>SL sản phẩm hết hàng</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
             <a id="thong-ke-sp-ton-kho" class="button small-box-footer">Load tồn kho</a>
            </div>
          </div>
    </div>
  </div>

<table style="vertical-align: center" id="dtVerticalScrollExample-spdanhgia" class="table table-striped table-bordered table-sm" cellspacing="0"></table>
  <table style="vertical-align: center" id="dtVerticalScrollExample-spbanchay" class="table table-striped table-bordered table-sm" cellspacing="0"></table>
   <table style="vertical-align: center" id="dtVerticalScrollExample-spkhuyenmai" class="table table-striped table-bordered table-sm" cellspacing="0"></table> 
   <table style="vertical-align: center" id="dtVerticalScrollExample-sptonkho" class="table table-striped table-bordered table-sm" cellspacing="0"></table> 

</section>
</div>
</div>

@endsection