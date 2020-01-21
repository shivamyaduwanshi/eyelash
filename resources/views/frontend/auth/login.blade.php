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
						<form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                            @csrf
							<div class="input-field">
								<div class="logo">
									<img src="{{asset('public/assets/frontend')}}/images/logo.png">
								</div>
								<h2 class="heading"> Sign in</h2>
									<div class="form-group {{ $errors->has('email') ? ' is-invalid' : '' }}">
										<input type="email" class="form-control" placeholder="Enter your Email" name="email" value="{{old('email')}}">
										@if ($errors->has('email'))
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $errors->first('email') }}</strong>
		                                    </span>
		                                @endif
									</div>
									<div class="form-group {{ $errors->has('password') ? ' is-invalid' : '' }}">
										<input type="password" class="form-control" placeholder="Enter your Password" name="password" value="{{old('password')}}">
										@if ($errors->has('password'))
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $errors->first('password') }}</strong>
		                                    </span>
		                                @endif
									</div>
									<div class="frgt-btn clearfix">
										<a href="{{route('password.request')}}" class="frgt-pass">Forgot Password</a>
										<a href="javascript:void(0)" class="sign-btn">Sign In <i class="fa fa-long-arrow-right"></i></a>
									</div>

									<p class="signup-link">Don’t have an account? <a href="{{route('register')}}">Sign up</a></p>

									<div class="social-login">
										<button class="fb">
											<a href="javascript:void(0);">
												<i class="fa fa-facebook"></i>
												Sign in With Facebook
											</a>
										</button>
										<button class="insta">
											<a href="javascript:void(0);">
												<i class="fa fa-instagram"></i>
												Sign in With Instagram
											</a>
										</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--script-->
  @include('frontend.layouts.foot')
  <script type="text/javascript">
  	$('.sign-btn').click(function(e){
       $('form').submit();
  	});
  </script>
</body>
</html>