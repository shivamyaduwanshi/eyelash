@extends('frontend.layouts.app')
@section('content')
   
   @section('title')
     Payment
   @endsection
   
  	<!--product details-->
	<section class="product-details">
		<div class="container">
			<div class="navigation">
				<a href="home.html">Home</a> >
				<a href="product_details.html">Service Details</a> >
				<a href="payment.html">Payment</a>
			</div>
			
			<div class="payment-page">
				<div class="heading">
					<h2>Enter Your Basic Details</h2>
				</div>
				<div class="basic-details">
					<div class="from">
						<form>
							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Enter Your Name" name="">
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="form-group">
										<input type="email" class="form-control" placeholder="Enter Your Email" name="">
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Enter Your Phone Number" name="">
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Enter Your Address(Optional)" name="">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>

				<div class="payment-details">
					<div class="heading">
						<h2>Choose Your Payment Mathod</h2>
					</div>
					<div class="payment-body">
						<h2 class="total-amount">Total Amount <span>$300</span></h2>
						<div class="custom-radio-btn">
							<label class="radio-box">
		            			Full Payment
		            			<input type="radio" checked="checked" name="d-status">
		            			<span class="checkmark"></span>
		            		</label>
		            		<label class="radio-box">
		            			Partial Payment
		            			<input type="radio" checked="checked" name="d-status">
		            			<span class="checkmark"></span>
		            		</label>
						</div>
						<div class="amount-box">
							<i class="fa fa-dollar"></i>
							<input type="text" placeholder="Enter Amount here..." name="">
						</div>
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
					</div>
				</div>

				<div class="btn">
					<a href="javascript:void(0);"  data-backdrop="static" data-keyboard="false" class="buy-now" data-toggle="modal" data-target="#book-appointment"> Book an appointment </a>
				</div>
			</div>
		</div>
	</section><!--end-->
@endsection