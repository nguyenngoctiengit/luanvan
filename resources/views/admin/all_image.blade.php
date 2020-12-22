@extends('admin.admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê sản phẩm
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên sản phẩm</th>
            <th>Hình sản phẩm 1</th>
            <th>Hình sản phẩm 2</th>
            <th>Hình sản phẩm 3</th>
            <th>Hình sản phẩm 4</th>
            <th>Hình sản phẩm 5</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($product as $key => $pro)
          @php
          $all_image = App\model\backend\Image::where('product_id',$pro->id)->take(5)->get();
          @endphp
          @if($all_image->count()==0)
          @continue;
          @endif
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $pro->name}}</td>
            @foreach($all_image as $img)
            <td><img src="{{URL::to('/uploads/product/'.$img->image)}}" height="100" width="100"></td>
          @endforeach
          @endforeach
        </tr>
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection