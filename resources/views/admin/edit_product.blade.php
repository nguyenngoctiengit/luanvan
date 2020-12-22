@extends('admin.admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật sản phẩm
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
                                @foreach($edit_product as $key => $pro)
                                <form role="form" action="{{URL::to('/update-product/'.$pro->id)}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="{{$pro->name}}">
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="slug" class="form-control" id="exampleInputEmail1" value="{{$pro->slug}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="mota" id="exampleInputPassword1">{{$pro->mota}}</textarea>
                                </div>
                                     <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" value="{{$pro->price}}" name="price" class="form-control" id="exampleInputEmail1" >
                                </div>
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input type="file" name="image" class="form-control" id="exampleInputEmail1">
                                    <img src="{{URL::to('/uploads/product/'.$pro->image)}}" height="100" width="100">
                                </div>
                                
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng</label>
                                    <input type="text" name="count" value="{{$pro->count}}" class="form-control" id="exampleInputEmail1" placeholder="Số lượng sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Màu balo</label>
                                    <input type="text" name="color" value="{{$pro->color}}" class="form-control" id="exampleInputEmail1" placeholder="Số lượng sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chất liệu</label>
                                    <input type="text" name="chatlieu" value="{{$pro->chatlieu}}" class="form-control" id="exampleInputEmail1" placeholder="Số lượng sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngăn đựng</label>
                                    <input type="text" name="ngandung" value="{{$pro->ngandung}}" class="form-control" id="exampleInputEmail1" placeholder="Số lượng sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">size</label>
                                    <input type="text" name="size" value="{{$pro->size}}" class="form-control" id="exampleInputEmail1" placeholder="Số lượng sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Bảo hành</label>
                                    <input type="text" name="baohanh" value="{{$pro->baohanh}}" class="form-control" id="exampleInputEmail1" placeholder="Số lượng sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">weight</label>
                                    <input type="text" name="weight" value="{{$pro->weight}}" class="form-control" id="exampleInputEmail1" placeholder="Số lượng sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tải trọng</label>
                                    <input type="text" name="taitrong" value="{{$pro->taitrong}}" class="form-control" id="exampleInputEmail1" placeholder="Số lượng sản phẩm">
                                </div>

                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                      <select name="product_cate" class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key => $cate)
                                            @if($cate->id==$pro->category_id)
                                            <option selected value="{{$cate->id}}">{{$cate->name}}</option>
                                            @else
                                            <option value="{{$cate->id}}">{{$cate->name}}</option>
                                            @endif
                                        @endforeach
                                            
                                    </select>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Thương hiệu</label>
                                      <select name="product_brand" class="form-control input-sm m-bot15">
                                        @foreach($brand_product as $key => $brand)
                                             @if($brand->id==$pro->brand_id)
                                            <option selected value="{{$brand->id}}">{{$brand->name}}</option>
                                             @else
                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                             @endif
                                        @endforeach
                                            
                                    </select>
                                </div>  
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                      <select name="product_status" class="form-control input-sm m-bot15">
                                            @if($pro->status==1)
                                             <option selected value="1">Hiển thị</option>
                                            <option value="0">Ẩn</option>
                                           @else
                                           <option value="1">Hiển thị</option>
                                            <option selected value="0">Ẩn</option>
                                            @endif
                                    </select>
                                </div>                            
                               
                                <button type="submit" name="add_product" class="btn btn-info">Cập nhật sản phẩm</button>
                                </form>
                                @endforeach
                            </div>

                        </div>
                    </section>

            </div>
@endsection