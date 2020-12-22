@extends('admin.admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm banner
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
                                <form role="form" action="{{URL::to('/save-banner')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                  <div class="form-group">
                                    <label>Hình banner</label>
                                    <input type="file" name="image" class="form-control">
                                    <p style="color: red">{!! $errors->first('image') !!}</p>
                                </div>
                                <div class="form-group">
                                <label style="margin-right: 30px">Chọn loại banner</label>
                                <input checked="true" type="radio" name="rdo_banner" value="1">
                                <label>Sản phẩm</label>
                                <input type="radio" name="rdo_banner" value="2">
                                <label>Tin tức</label>
                                <input type="radio" name="rdo_banner" value="3">
                                <label>Khuyến mãi</label>
                                </div>
                                 <div class="form-group">
                                    <label>Chọn sản phẩm</label>
                                      <select name="product" class="form-control input-sm m-bot15">
                                        @foreach($product as $key => $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                               
                                <div class="form-group">
                                    <label>Chọn tin tức</label>
                                      <select name="new" class="form-control input-sm m-bot15">
                                        @foreach($news as $key => $item)
                                            <option value="{{$item->id}}">{{$item->subject}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Chọn khuyến mãi</label>
                                      <select name="khuyenmai" class="form-control input-sm m-bot15">
                                        @foreach($khuyenmai as $key => $item)
                                            <option value="{{$item->id}}">{{$item->subject}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Hiển thị</label>
                                      <select name="status" class="form-control input-sm m-bot15">
                                        <option value="1">Hiển thị</option>
                                            <option value="0">Ẩn</option> 
                                    </select>
                                </div>
                               
                                <button type="submit" class="btn btn-info">Thêm banner</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection