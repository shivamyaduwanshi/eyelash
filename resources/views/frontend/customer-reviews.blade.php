@extends('frontend.layouts.app')
@section('content')
  <!--product details-->
	<section class="product-details service-details">
		<div class="container">
			<div class="navigation">
				<a href="index.html">Home</a> >
				<a href="customer-reviews.html">Customer Reviews</a>
			</div>
			<!--single-service-->
			<div class="single-service">
				<div class="row">
					<div class="col-md-2 col-sm-4 col-xs-12">
						<div class="product-img">
							<img src="{{asset('public/assets/frontend')}}/images/05.jpg">
						</div>
					</div>

					<div class="col-md-10 col-sm-8 col-xs-12">
						<div class="product-txt">
							<div class="name-price">
								<h2>Luxury Lashes</h2>
								<label>Cost: $150 <p class="s-rating"> <span>5</span> <i class="fa fa-star"></i> </p> </label>
								<!-- <p> <label>Stock : </label> <span>Only 4 left</span></p> -->
							</div>
							<div class="border"></div>
							<div class="Description">
								<h2>Description:</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusm tempor incididunt ut labore et dolore piscing elit, sed do eiusm tempor in</p>
							</div>
						</div>
						<div class="btn">
							<a href="service_details.html">Book Appointment </a>
						</div>
					</div>
				</div>
			</div><!--end-->
		</div>
	</section><!--end-->
@endsection