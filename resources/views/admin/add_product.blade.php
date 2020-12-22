@extends('admin.admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm sản phẩm
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
                                <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                    <p style="color: red">{!! $errors->first('name') !!}</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="slug" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                    <p style="color: red">{!! $errors->first('slug') !!}</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="mota" id="exampleInputPassword1" placeholder="Mô tả sản phẩm"></textarea>
                                    <p style="color: red">{!! $errors->first('mota') !!}</p>
                                </div>
                                     <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" name="price" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                    <p style="color: red">{!! $errors->first('price') !!}</p>
                                </div>
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input type="file" name="image" class="form-control" id="exampleInputEmail1">
                                    <p style="color: red">{!! $errors->first('image') !!}</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng</label>
                                    <input type="text" name="count" class="form-control" id="exampleInputEmail1" placeholder="Số lượng sản phẩm">
                                    <p style="color: red">{!! $errors->first('count(var)') !!}</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Màu balo</label>
                                    <input type="text" name="color" class="form-control" id="exampleInputEmail1" placeholder="Số lượng sản phẩm">
                                    <p style="color: red">{!! $errors->first('color') !!}</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chất liệu</label>
                                    <input type="text" name="chatlieu" class="form-control" id="exampleInputEmail1" placeholder="Số lượng sản phẩm">
                                    <p style="color: red">{!! $errors->first('chatlieu') !!}</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngăn đựng</label>
                                    <input type="text" name="ngandung" class="form-control" id="exampleInputEmail1" placeholder="Số lượng sản phẩm">
                                    <p style="color: red">{!! $errors->first('ngandung') !!}</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">size</label>
                                    <input type="text" name="size" class="form-control" id="exampleInputEmail1" placeholder="Số lượng sản phẩm">
                                    <p style="color: red">{!! $errors->first('size') !!}</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Bảo hành</label>
                                    <input type="text" name="baohanh" class="form-control" id="exampleInputEmail1" placeholder="Số lượng sản phẩm">
                                    <p style="color: red">{!! $errors->first('baohanh') !!}</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">weight</label>
                                    <input type="text" name="weight" class="form-control" id="exampleInputEmail1" placeholder="Số lượng sản phẩm">
                                    <p style="color: red">{!! $errors->first('weight') !!}</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tải trọng</label>
                                    <input type="text" name="taitrong" class="form-control" id="exampleInputEmail1" placeholder="Số lượng sản phẩm">
                                    <p style="color: red">{!! $errors->first('taitrong') !!}</p>
                                </div>

                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                      <select name="product_cate" class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key => $cate)
                                            <option value="{{$cate->id}}">{{$cate->name}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Thương hiệu</label>
                                      <select name="product_brand" class="form-control input-sm m-bot15">
                                        @foreach($brand_product as $key => $brand)
                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                                 
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                      <select name="status" class="form-control input-sm m-bot15">
                                            <option value="0">Ẩn</option>
                                            <option value="1">Hiển thị</option>
                                            
                                    </select>
                                </div>
                               
                                <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection