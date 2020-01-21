<!DOCTYPE html>
<html>
<head>
 @include('frontend.layouts.head')
</head>
<body>
<section class="sign-up">
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
						 <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}" enctype="multipart/form-data">
                            @csrf
							<div class="input-field">
								<h2 class="heading"> Sign up</h2>
								<div class="profile">
									<img id="imagePreview" src="">
									<input type="file" name="profile_image" id="image">
									<i class="fa fa-camera"></i>
								</div>
								
									<div class="form-group {{ $errors->has('your_name') ? ' is-invalid' : '' }}">
										<input type="text" class="form-control" placeholder="Enter your Name" name="your_name" value="{{old('your_name')}}">
										 @if ($errors->has('your_name'))
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $errors->first('your_name') }}</strong>
		                                    </span>
                                         @endif
									</div>
									<div class="form-group {{ $errors->has('your_email') ? ' is-invalid' : '' }}">
										<input type="email" class="form-control" placeholder="Enter your Email" name="your_email" value="{{old('your_email')}}">
										 @if ($errors->has('your_email'))
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $errors->first('your_email') }}</strong>
		                                    </span>
                                         @endif
									</div>
									<div class="form-group {{ $errors->has('your_mobile_number') ? ' is-invalid' : '' }}">
										<input type="text" class="form-control" placeholder="Enter your Mobile Number" name="your_mobile_number" value="{{old('your_mobile_number')}}">
										 @if ($errors->has('your_mobile_number'))
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $errors->first('your_mobile_number') }}</strong>
		                                    </span>
                                         @endif
									</div>
									<div class="form-group {{ $errors->has('your_password') ? ' is-invalid' : '' }}">
										<input type="password" class="form-control" placeholder="Enter your Password" name="your_password" value="{{old('your_password')}}">
										 @if ($errors->has('your_password'))
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $errors->first('your_password') }}</strong>
		                                    </span>
                                         @endif
									</div>
									<div class="form-group {{ $errors->has('your_birth_date') ? ' is-invalid' : '' }}">
										<input type="text" class="form-control" placeholder="Enter your Birth Date" name="your_birth_date" value="{{old('your_birth_date')}}">
										<button><i class="fa fa-calendar"></i></button>
										 @if ($errors->has('your_birth_date'))
		                                    <span class="invalid-feedback" role="alert">
		                                        <strong>{{ $errors->first('your_birth_date') }}</strong>
		                                    </span>
                                         @endif
									</div>
									<div class="frgt-btn clearfix">
										<a href="javascript:void(0)" class="sign-btn">Sign Up <i class="fa fa-long-arrow-right"></i></a>
									</div>

									<p class="signup-link">Already have an account? <a href="{{route('login')}}">Sign In</a></p>
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
  	
  	 $('#image').change(function (event) {
           var tmppath = URL.createObjectURL(event.target.files[0]);
           $('#imagePreview').attr('src',tmppath);
     });

  </script>
</body>
</html>