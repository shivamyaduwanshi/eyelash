@extends('frontend.layouts.app')
@section('content')
 @section('title')
    Transaction Failed
 @endsection
  <!--product details-->
	<section class="confirm-order">
		<div class="container">
			<div class="thank-mg">
				<div class="img-thnx">
					<img src="{{asset('public/assets/frontend')}}/images/check.png">
					<div class="thnx">
						<label>Failed</label>
						<h5>Transaction faild, Please try letter </h5>
					</div>
					<div class="btn">
					<a class="bth" href="{{route('home')}}">Back to home page</a>
				</div>
				</div>
			</div>
		</div>
	</section><!--end-->

@endsection