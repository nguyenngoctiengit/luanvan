@extends('pages.layout.layout')
@section('content')
<!-- Begin Li's Breadcrumb Area -->
 <div style="margin-top: -20px" class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="{{route('home')}}">Home</a></li>   
                       <li class="active">Thanh toán</li> 
                    </ul>           
                </div>
            </div>  
        </div>      
<!-- Li's Breadcrumb Area End Here -->
<!--Checkout Area Strat-->

<div class="checkout-area pt-60 pb-30">
   <div class="container">
   

<div class="row">
    <div class="col-lg-6 col-12">
        <form method="POST">
         @csrf
         <div class="checkbox-form">
            <h3>Thông tin nhận hàng</h3>
            <div class="row">                         
                <div class="col-md-12">
                    <div class="checkout-form-list">
                        <label>Name <span class="required">*</span></label>
                        <input value="{{$ttkh->name}}" class="name" name="name" placeholder="Name" type="text">
                          
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="checkout-form-list">
                        <label>Address <span class="required">*</span></label>
                        <input value="{{$ttkh->address}}" class="address" name="address" placeholder="Street address" type="text">
                    </div>
                </div>                             
                <div class="col-md-6">
                    <div class="checkout-form-list">
                        <label>Email Address <span class="required">*</span></label>
                        <input readonly="readonly" value="{{$ttkh->email}}" class="email" name="email" placeholder="" type="email">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="checkout-form-list">
                        <label>Phone  <span class="required">*</span></label>
                        <input value="{{$ttkh->phone}}" class="phone" name="phone" type="text">
                         
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="checkout-form-list">
                        <label>Ghi chú <span class="required">*</span></label>
                        <textarea class="notes" name="notes" style="background-color:#ffffff; border:1px solid #e5e5e5;" placeholder="Notes"></textarea>
                    </div>
                </div>  
                <div class="col-md-12">
                    <div class="country-select clearfix">
                        <label>Phương thức thanh toán <span class="required">*</span></label>
                        <select name="method" class="nice-select wide method">
                          <option value="1">Thanh toán tiền mặt</option>
                          <option value="2">Thanh toán chuyển khoản</option>

                      </select>
                  </div>
              </div>
          </div>    
      </form>
  </div>
</div>
<div class="col-lg-6 col-12">
    <div class="your-order">
        <h3>Your order</h3>
        <div class="your-order-table table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="cart-product-name">Product</th>
                        <th id="after_title_count" ></th>
                        <th class="cart-product-total">Total</th>
                    </tr>
                </thead>
                <tbody>
                 @if(Session::get('cart')==true)
                 @php 
                 $total=0;
                 @endphp
                 @foreach(Session::get('cart') as $key=>$cart)
                 @php 
                 $subtotal=$cart['product_price']*$cart['product_qty'];
                 $total+=$subtotal;
                 @endphp
                 <tr class="cart_item">
                  <td class="cart-product-name"> {{$cart['product_name']}}<strong class="product-quantity"> x{{$cart['product_qty']}}</strong></td>
                  <td style="color:red" id="product_count_thieu_{{$cart['product_id']}}"></td>
                  <td class="cart-product-total"><span class="amount">{{number_format($subtotal).' VND'}}</span></td>  
              </tr>
              @endforeach
              @endif
          </tbody>
          <tfoot>
            <tr class="order-total">
                <th>Order Total</th>
                <th></th>
                <td><strong><span class="amount">{{number_format($total).' VND'}}</span></strong></td>
            </tr>
        </tfoot>
    </table>
</div>
<div class="payment-method">
    <div class="payment-accordion">
        <div id="accordion">
          <div class="card">
            <div class="card-header" id="#payment-1">
              <h5 class="panel-title">
                <a class="" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Direct Bank Transfer.
              </a>
          </h5>
      </div>
      <div id="collapseOne" class="collapse show" data-parent="#accordion">
          <div class="card-body">
            <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header" id="#payment-2">
      <h5 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Cheque Payment
      </a>
  </h5>
</div>
<div id="collapseTwo" class="collapse" data-parent="#accordion">
  <div class="card-body">
    <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
</div>
</div>
</div>
<div class="card">
    <div class="card-header" id="#payment-3">
      <h5 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          PayPal
      </a>
  </h5>
</div>
<div id="collapseThree" class="collapse" data-parent="#accordion">
  <div class="card-body">
    <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
</div>
</div>
</div>
</div>
<div class="order-button-payment">
    <input name="send_order" class="send_order" value="Place order" type="button">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!--Checkout Area End-->
@endsection