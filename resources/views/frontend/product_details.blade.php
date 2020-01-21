@extends('frontend.layouts.app')
@section('content')
   
   @section('title')
     Product | {{$data['product']->product_name}}
   @endsection

  	<!--product details-->
	<section class="product-details">
		<div class="container">
			<div class="navigation">
				<a href="{{route('home')}}">Home</a> >
				<a href="javascript::void(0)">Product Details</a>
			</div>
			<div class="row">
				<div class="col-md-4 col-sm-5 col-xs-12">
					<div class="product-img">
						<img src="{{$data['product']->product_image}}">
					</div>
				</div>

				<div class="col-md-8 col-sm-7 col-xs-12">
					<div class="product-txt">
						<div class="name-price">
							<h2>{{$data['product']->product_name}}</h2>
							<label>{{$data['product']->currency}}{{$data['product']->product_cost}}</label>
							<p> <label>Stock : </label> <span>Only 4 left</span></p>
						</div>
						<div class="border"></div>
						<div class="Description">
							<h2>Description:</h2>
							<p>{{$data['product']->product_description}}</p>
						</div>

{{-- 						<a href="{{route('product.payment')}}" data-backdrop="static" data-keyboard="false" class="buy-now" data-toggle="modal" data-target="#buy-now">Buy Now</a> --}}
						<a href="{{route('product.payment',['product_id'=>encrypt($data['product']->id)])}}" class="buy-now">Buy Now</a>
					</div>
				</div>
			</div>
			<div class="border2"></div>

			<div class="more-product">
				<div class="section-heading">
					<h2>More Products</h2>
				</div>
				<div class="row">

					<!--single product-->
					@forelse($data['products'] as $key => $product)
					<div class="col-md-3 col-sm-4 col-xs-12">
						<div class="img-wrapper">
							<a href="{{ route('product.details',encrypt($product->id))}}">
								<div class="img">
									<img src="{{$product->product_image}}" alt="suggestion-gallery" class="img-fluid">
								</div>
								<div class="price-name">
									<h2>{{$product->product_name}}</h2>
									<label>{{$product->currency}}{{$product->product_cost}}</label>
								</div>
							</a>
						</div>
					</div><!--end-->
					@empty
					@endforelse
				</div>
			</div>
		</div>
	</section><!--end-->
	<!-- The Modal -->
  <div class="modal fade buynow-popup" id="buy-now">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Proceed To Order</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <div class="order-details">
          	<form>
          		<div class="basic-details">
          			<h2 class="heading">Basic Details</h2>
          			<div class="form-group">
	          			<input type="text" class="form-control" placeholder="Enter Your Name" name="">
	          		</div>
	          		<div class="form-group">
	          			<input type="email" class="form-control" placeholder="Enter Your Email" name="">
	          		</div>
	          		<div class="form-group">
	          			<input type="text" class="form-control" placeholder="Enter your Mobile Number" name="">
	          		</div>
	          		<div class="form-group">
	          			<input type="text" class="form-control" placeholder="Enter Your Address" name="">
	          		</div>
          		</div>

          		<div class="payment-method">
          			<h2 class="heading">Payment Method</h2>

          			<div class="choose-option">
			          	<!--single-choosen-->
			          	<div class="single-choosen">
			          		<label>
			          			<input type="radio" checked="" name="radio">
			          			<span class="checkmark">
			          				<i class="fa fa-paypal"></i>
			          				<h4>Paypal</h4>
			          			</span>
			          		</label>
			          	</div>

			          	<!--single-choosen-->
			          	<div class="single-choosen">
			          		<label>
			          			<input type="radio" name="radio">
			          			<span class="checkmark">
			          				<i class="fa fa-credit-card-alt"></i>
			          				<h4>Cards</h4>
			          			</span>
			          		</label>
			          	</div>
			          	<!--single-choosen-->
			          	<div class="single-choosen">
			          		<label>
			          			<input type="radio" name="radio">
			          			<span class="checkmark">
			          				<i class="fa fa-usd"></i>
			          				<h4>Cash</h4>
			          			</span>
			          		</label>
			          	</div>
			        </div>
          			<div class="border"></div>
          			<h3  class="sub-heading">Enter Your Card details</h3>
          			<div class="row">
          				<div class="col-md-10 col-sm-10 col-xs-12">
          					<div class="form-group">
			          			<input type="text" class="form-control" placeholder="Card Holdern Name" name="">
			          		</div>
			          	</div>
		          		<div class="col-md-10 col-sm-10 col-xs-12">
		          			<div class="form-group">
			          			<input type="email" class="form-control" placeholder="Card Number" name="">
			          		</div>
		          		</div>
		          		<div class="col-md-5 col-sm-5 col-xs-12">
		          			<div class="form-group">
			          			<input type="text" class="form-control" placeholder="CCV?" name="">
			          		</div>
		          		</div>
		          		<div class="col-md-5 col-sm-5 col-xs-12">
		          			<div class="form-group">
			          			<input type="text" class="form-control" placeholder="Expiry Date" name="">
			          		</div>
		          		</div>
          			</div>
          		</div>

          		<div class="btns">
          			<button><a href="{{route('confirm.order')}}">Place Order</a></button>
          			<button>Cancel</button>
          		</div>
          	</form>
          </div>
        </div>
        
        <!-- Modal footer -->
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div> -->
        
      </div>
    </div>
  </div>
@endsection