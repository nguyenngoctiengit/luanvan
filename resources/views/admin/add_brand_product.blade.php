@extends('admin.admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm thương hiệu sản phẩm
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
                                <form role="form" action="{{URL::to('/save-brand-product')}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thương hiệu</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                    <p style="color: red">{!! $errors->first('name') !!}</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">email thương hiệu</label>
                                    <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                    <p style="color: red">{!! $errors->first('email') !!}</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại của thương hiệu</label>
                                    <input type="text" name="phone" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                    <p style="color: red">{!! $errors->first('phone') !!}</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ thương hiệu</label>
                                    <input type="text" name="address" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                    <p style="color: red">{!! $errors->first('address') !!}</p>
                                </div>                                 
                                <button type="submit" name="add_category_product" class="btn btn-info">Thêm thương hiệu</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection