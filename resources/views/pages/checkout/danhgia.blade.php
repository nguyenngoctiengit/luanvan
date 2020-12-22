@extends('pages.layout.layout')
@section('content')
 <div style="margin-top: -20px" class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="{{route('home')}}">Home</a></li>   
                        <li class="active">Đánh giá sản phẩm</li> 
                    </ul>           
                </div>
            </div>  
        </div>      
            <div style="margin-top: 20px" class="Shopping-cart-area pt-60 pb-60">
                <div class="container">
                    <div class="row">
                        <div class="col-12"> 
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{session()->get('message')}}
                            </div> 
                        @elseif(session()->has('error'))  
                        <div class="alert alert-danger">
                                {{session()->get('error')}}
                        </div> 
                        @endif 
                        <p class="test-message">Chia sẻ cảm nhận của bạn về tất cả sản phẩm trong đơn hàng của bạn bằng cách cho số sao ở mỗi sản phẩm!</p>   
                            <form action="{{URL::to('/danh-gia')}}" method="post">
                                @csrf
                                <div class="table-content table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                            <th class="li-product-thumbnail">Hình ảnh</th>
                                            <th class="cart-product-name">Sản phẩm</th>
                                            <th class="li-product-quantity">Đánh giá</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tblbody">
                                            @foreach($product as $item)
                                            <tr>
                                                <td class="li-product-thumbnail"><img width="90px" src="{{URL::to('/uploads/product/'.$item->image)}}" alt="Li's Product Image"></a></td>
                                                <td class="li-product-name">{{$item->name}}</td>
                                                <td><select name="select[{{$item->id}}]" class="star-rating">
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3" >3</option>
                                                                            <option value="4">4</option>
                                                                            <option selected value="5">5</option>
                                                                        </select></td>
                                                <input type="hidden" name="product_id[]" value="{{$item->id}}">
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-9" style="margin-top: 40px">
                                        <span style="border-radius: 10px;border: 2px solid #cc0000;margin-right: 10px;padding: 10px 20px">5 sao: Xuất sắc</span>
                                         <span style="border-radius: 10px;border: 2px solid #FF9900;margin-right: 10px;padding: 10px 20px">4 sao: Tốt</span>
                                          <span style="border-radius: 10px;border: 2px solid #FFFF33;margin-right: 10px;padding: 10px 20px">3 sao: Tạm được</span>
                                           <span style="border-radius: 10px;border: 2px solid #66FF33;margin-right: 10px;padding: 10px 20px">2 sao: Không tốt</span>
                                            <span style="border-radius: 10px;border: 2px solid #00CC66;margin-right: 10px;padding: 10px 20px">1 sao: Rất không tốt</span>
                                    </div>
                                    <div class="col-3">
                                        <div class="coupon-all">
                                            <div class="coupon2">
                                                <input class="button" value="Gửi đánh giá" type="submit">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
@endsection
