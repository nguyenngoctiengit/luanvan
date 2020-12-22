@extends('admin.admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật thương hiệu sản phẩm
                        </header>
                         <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                        <div class="panel-body">
                            @foreach($edit_brand_product as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-brand-product/'.$edit_value->id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" value="{{$edit_value->name}}" name="name" class="form-control" id="exampleInputEmail1" >
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">email</label>
                                    <input type="text" value="{{$edit_value->email}}" name="email" class="form-control" id="exampleInputEmail1" >
                                </div>   
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">phone</label>
                                    <input type="text" value="{{$edit_value->phone}}" name="phone" class="form-control" id="exampleInputEmail1" >
                                </div>   
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">address</label>
                                    <input type="text" value="{{$edit_value->address}}" name="address" class="form-control" id="exampleInputEmail1" >
                                </div>                        
                                <button type="submit" name="update_brand_product" class="btn btn-info">Cập nhật danh mục</button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </section>

            </div>
@endsection