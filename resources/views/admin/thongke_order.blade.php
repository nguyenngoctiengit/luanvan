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
    font-size: 1rem;
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
</style>
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
     Thống kê đơn hàng
    </div>
    <div class="row w3-res-tb"> 
       <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$all_count_order}}</h3>

                <p>Tổng đơn hàng trong tháng</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a class="small-box-footer">!</a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{number_format($total_doanhthu->totalMoney).' VND'}}</h3>

                <p>Doanh thu trong tháng</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a class="small-box-footer">!</a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$all_count_order_status_3}}</h3>

                <p>Số đơn hàng thành công</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a class="small-box-footer">!</a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$all_kh}}</h3>

                <p>Số khách hàng đã đặt hàng</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">!</a>
            </div>
          </div>
    </div>
  </div>
</div>
 <div class="col-sm-5 m-b-xs">
      <form>
        <input type="month" value="{{$request->select_date}}" name="select_date">
        <button type="submit"  class="btn btn-sm btn-default">Apply</button>   
      </form>             
      </div>
<div class="row">
  <div class="col-sm-8">
    <figure class="highcharts-figure">
      <div id="container2" data-list-day="{{$listDay}}" data-money="{{$arrdoanhthuMonth}}" data-money-default="{{$arrdoanhthuMonthDefault}}"></div>
    </figure>
  </div>
  <div class="col-sm-4">
     <figure class="highcharts-figure">
      <div id="container3" data-json="{{$status_thongke}}"></div>
    </figure>
  </div>
</div>
<link rel="stylesheet" type="text/css" href="https://code.highcharts.com/css/highcharts.css">
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script type="text/javascript">
  
  let listDay=$('#container2').attr("data-list-day");
  listDay=JSON.parse(listDay);
  let listMoneyMonth=$('#container2').attr('data-money');
  listMoneyMonth=JSON.parse(listMoneyMonth);
  let listMoneyMonthDefault=$('#container2').attr('data-money-default');
  listMoneyMonthDefault=JSON.parse(listMoneyMonthDefault);

  let dataTransation=$('#container3').attr('data-json');
  dataTransation=JSON.parse(dataTransation);
  Highcharts.chart('container3',{
    chart:{
      styledMode:true
    },
    title:{
      text:"Thống kê trạng thái đơn hàng của toàn bộ hệ thống",
    },
     tooltip: {
      pointFormat: '{series.name}: <br>{point.percentage:.1f} %<br>value: {point.y}'},
       plotOptions: {
      pie: {
        dataLabels: {
          enabled: true,
          format: '<b>{point.name}</b>:<br>{point.percentage:.1f} %<br>Số lượng: {point.y}',
        }
      }
    },
    series:[{
      type:'pie',
      allowPointSelect:true,
      keys:['name','y','selected','sliced'],
      data:dataTransation,
      showInLegend:true
    }]
  });
  Highcharts.chart('container2',{
    char:{
      type:'spline'
    },
    title:{
      text:"Biểu đồ doanh thu các ngày trong tháng"
    },
    subtitle:{
      text:'SterbenShop'
    },
     xAxis:{
      categories:listDay
    },
    yAxis:{
      title:{
        text:'Temperature'
      },
      labels:{
        formatter:function(){
          return this.value+'*';
        }
      }
    },
    tooltip:{
      crosshairs:true,
      shared:true
    },
    plotOptions:{
      spline:{
        marker:{
          radius:4,
          lineColor:'#666666',
          lineWidth:1
        }
      }
    },
    series:[
    {
      name:'Đơn hàng đã hoàn thành',
      marker:{
        symbol:'square'
      },
      data:listMoneyMonth
    },
    {
      name:'Đơn hàng đã tiếp nhận',
      marker:{
        symbol:'square'
      },
      data:listMoneyMonthDefault
    }
      //  data:[7.0,6.9,9.5,14.5,18.2,21.5,25.2,3232,54,53,6,4,5,2,4,3,5,4,52,8,5,{
      //   y:26.5,
      //   marker:{
      //     symbol:'url(https://www.highcharts.com/samples/graphics/sun.png)'
      //   }
      // },23.3,18.3,13.9,9.6,7,4,2,6,7]
    ],

  });
</script>
@endsection