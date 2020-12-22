@extends('admin.admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm hình ảnh chi tiết sản phẩm
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
                                <form role="form" action="{{URL::to('/save-image')}}" enctype="multipart/form-data" method="post">
                                    {{ csrf_field() }}
                                    {{-- @for ($i = 1;$i <=5;$i++) --}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh {{-- {!! $i !!} --}}</label>
                                    <input type="file" name="fProductDetail[]" class="form-control" id="exampleInputEmail1" multiple/>
                                </div>
                                {{-- @endfor --}}
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Sản phẩm</label>
                                      <select name="product_id" class="form-control input-sm m-bot15">
                                        @foreach($product as $key => $pro)
                                            <option value="{{$pro->id}}">{{$pro->name}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <button type="submit" name="add_image" class="btn btn-info">Thêm hình ảnh</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection