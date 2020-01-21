@extends('frontend.layouts.app')
@section('content')
 @section('title')
    Confirm Order
 @endsection
  <!--product details-->
	<section class="confirm-order">
		<div class="container">
			<div class="thank-mg">
				<div class="img-thnx">
					<img src="{{asset('public/assets/frontend')}}/images/check.png">
					<div class="thnx">
						<label>Thank You</label>
						<h5>Your Order is Successfully Placed</h5>
					</div>
				</div>
				<p class="opntmnt-id">
					Your Order Id: <span>#{{$data['id']}}</span>
				</p>
				@auth
				<p>You can see all details of order in history</p>
                @endauth
				<div class="btn">
					@auth
					<a href="my_account.html">Details</a>
					@endauth
					<a class="bth" href="{{route('home')}}">Back to home page</a>
				</div>
			</div>
			<div class="border"></div>

			<div class="qr-code">
				<h2>Your QR Code is Generated and sent to your Email</h2>
				<div class="qr-code-img">
					<img src="{{asset('public/assets/frontend')}}/images/QR-Code.png">
					<span>Scan me</span>
				</div>
				<p>When you reach salon you need to show your generated QR Code to shopkeeper QR Code is already sent to your Registered Email </p>
			</div>
		</div>
	</section><!--end-->

@endsection