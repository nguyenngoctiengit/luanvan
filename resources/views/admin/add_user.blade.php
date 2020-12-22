@extends('admin.admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm nhân viên công ty
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
                                <form role="form" action="{{URL::to('/save-user')}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">email</label>
                                    <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">mật khẩu</label>
                                    <input type="text"  name="password" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên nhân viên</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại</label>
                                    <input type="text" name="phone" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Phân quyền</label>
                                      <select name="phancap" class="form-control input-sm m-bot15">
                                        @foreach($role as $key => $r)
                                            <option value="{{$r->id}}">{{$r->name}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>                              
                                <button type="submit" name="add_user" class="btn btn-info">Thêm thành viên</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection