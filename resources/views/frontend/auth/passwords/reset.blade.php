<!DOCTYPE html>
<html>
<head>
 @include('frontend.layouts.head')
</head>
<body>
<section class="sign-up login">
	<div class="container">
		<div class="back-home">
			<a href="{{route('home')}}"><i class="fa fa-arrow-left"></i> Back To Home</a>
		</div>
		<div class="section-wrapper">
			<div class="section-body">
				<div class="row">
					<div class="col-md-7 col-sm-12 col-xs-12">
						<div class="img">
							<img src="{{asset('public/assets/frontend')}}/images/login-pic.jpg">
						</div>
					</div>

					<div class="col-md-5 col-sm-12 col-xs-12">
						<div class="input-field">
							<div class="logo">
								<img src="{{asset('public/assets/frontend')}}/images/logo.png">
							</div>
							<h2 class="heading"> Forgot Password</h2>
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Enter your full name" name="">
								</div>
								<div class="form-group">
									<input type="email" class="form-control" placeholder="Enter your Email" name="">
								</div>
								<!-- <div class="form-group">
									<input type="password" class="form-control" placeholder="Enter your Password" name="">
								</div> -->
								<div class="form-group btn">
									<!-- <a href="javascript:void(0);" class="frgt-pass">Forgot Password</a> -->
									<a href="login.html" class="sign-btn">Send<!--  <i class="fa fa-long-arrow-right"></i> --></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--script-->
 @include('frontend.layouts.foot')
</body>
</html>