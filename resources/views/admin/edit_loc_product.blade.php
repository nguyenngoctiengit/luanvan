@extends('admin.admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Sửa mức giá sản phẩm
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
                                <form role="form" action="{{URL::to('/update-loc-product')}}" method="post">
                                    {{ csrf_field() }}
                                <input type="hidden" value="{{$price->id}}" name="id">
                                <div class="form-group">
                                <label>Tên hiển thị</label>
                                <input type="text" value="{{$price->name}}" name="name" class="form-control" >
                                <p style="color: red">{!! $errors->first('name') !!}</p>
                                </div>
                                <div class="form-group">
                                    <label>Giá min</label>
                                    <input value="{{$price->price_min}}" min="1000" step="1000" type="number" name="price_min" class="form-control">
                                    <p style="color: red">{!! $errors->first('price_min') !!}</p>
                                </div>
                                <div class="form-group">
                                    <label>Giá max</label>
                                    <input value="{{$price->price_max}}" min="1000" step="1000" type="number" name="price_max" class="form-control">
                                    <p style="color: red">{!! $errors->first('price_max') !!}</p>
                                </div>
                                                               
                                <button type="submit" class="btn btn-info">Sửa mức giá</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection