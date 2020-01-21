<!DOCTYPE html>
<html>
<head>
  @include('frontend.layouts.head')
  @stack('css')
</head>
<body>
	<!--header-bg-->
	<section class="@if(url()->current() == url('/')) header-bg @endif">
	  @include('frontend.layouts.header')
	  @if(url()->current() == url('/'))
		<div class="header-text">
			<div class="inner">
				<h2>Lorem ipsum dolor sit amet, </h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				<a data-toggle="modal" data-target="#home-popup" href="javascript:void(0);">Explore More <i class="fa fa-arrow-right"></i></a>
			</div>
		</div>
	  @endif
	</section><!--end-->

	 @section('content')@show

	<!--footer-->
	<footer>
	  @include('frontend.layouts.footer')
	</footer>

  @include('frontend.layouts.foot')
  @stack('js')
</body>
</html>