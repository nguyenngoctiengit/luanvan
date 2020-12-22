@extends('admin.admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Sửa banner
                        </header>
                         <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                        <div class="panel-body">

                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-banner')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" value="{{$banner->id}}">
                                  <div class="form-group">
                                    <label>Hình banner</label>
                                    <input type="file" name="image" class="form-control">
                                    <img style="margin-top: 10px" width="200px" src="{{URL::to('uploads/banner/'.$banner->image)}}">
                                    <p style="color: red">{!! $errors->first('image') !!}</p>
                                </div>
                                <div class="form-group">
                                <label style="margin-right: 30px">Chọn loại banner</label>
                                @php
                                if($banner->product_id!=null){
                            echo '<input type="radio" checked="true" name="rdo_banner" value="1">';
                                }else{
                            echo '<input type="radio" name="rdo_banner" value="1">';
                                }
                               echo ' <label style="margin-right:10px">Sản phẩm</label>';
                                 if($banner->news_id!=null){
                            echo '<input type="radio" checked="true" name="rdo_banner" value="2">';
                                }else{
                            echo '<input type="radio" name="rdo_banner" value="2">';
                                }
                               echo '<label style="margin-right:10px">Tin tức</label>';
                                 if($banner->khuyenmai_id!=null){
                            echo '<input type="radio" checked="true" name="rdo_banner" value="3">';
                                }else{
                            echo '<input type="radio" name="rdo_banner" value="3">';
                                }
                                 echo '<label>Khuyến mãi</label>';
                                @endphp

                                </div>
                                 <div class="form-group">
                                    <label>Chọn sản phẩm</label>
                                      <select name="product" class="form-control input-sm m-bot15">
                                        @foreach($product as $key => $item)
                                            @if($item->id==$banner->product_id)
                                            <option selected value="{{$item->id}}">{{$item->name}}</option>
                                            @else
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endif
                                        @endforeach
                                            
                                    </select>
                                </div>
                               
                                <div class="form-group">
                                    <label>Chọn tin tức</label>
                                      <select name="new" class="form-control input-sm m-bot15">
                                        @foreach($news as $key => $item)
                                        @if($item->id==$banner->news_id)
                                            <option selected value="{{$item->id}}">{{$item->subject}}</option>
                                        @else
                                        <option value="{{$item->id}}">{{$item->subject}}</option>
                                         @endif
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Chọn khuyến mãi</label>
                                      <select name="khuyenmai" class="form-control input-sm m-bot15">
                                        @foreach($khuyenmai as $key => $item)
                                        @if($item->id==$banner->khuyenmai_id)
                                            <option selected value="{{$item->id}}">{{$item->subject}}</option>
                                        @else
                                        <option value="{{$item->id}}">{{$item->subject}}</option>
                                         @endif
                                        @endforeach  
                                    </select> 
                                </div>
                                   <div class="form-group">
                                    <label>Hiển thị</label>
                                      <select name="status" class="form-control input-sm m-bot15">
                                        @if($banner->status==1)
                                        <option selected value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option> 
                                        @else
                                        <option value="1">Hiển thị</option>
                                        <option selected value="0">Ẩn</option> 
                                        @endif
                                        
                                            
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-info">Sửa banner</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection