@extends('frontend.layouts.app')
@section('content')
    @section('title')
      Classes
    @endsection
  	<!--product details-->
  		<!--our services-->
	<section class="product-details our-services our-classes our-classes-list">
		<div class="container">
			<div class="navigation">
				<a href="{{route('home')}}">Home</a> >
				<a href="javascript::void(0)">All Classes</a>
			</div>

			<div class="service-body pt-0">
				<div class="row">
					@forelse($data['classes'] as $key => $class)
                       
					<!--single-srvc-->
					<div class="col-md-6 col-sm-12 col-xs-12">
						<div class="single-srvc clearfix">
   							 <a href="{{route('class.details',encrypt($class->id))}}">
								<div class="img">
									<img src="{{asset('public/assets/frontend/')}}/images/cap.png">
								</div>
								<div class="txt">
									<h2>{{$class->class_name}}</h2>
									<ul>
										<li>
											<i class="fa fa-calendar"></i>
											<span>{{dateFormate($class->class_start_date)}}</span> To
											<span>{{dateFormate($class->class_end_date)}}</span>
										</li>
										<li>
											<i class="fa fa-clock-o"></i>
											<span>{{timeFormate($class->class_start_time)}}</span> To 
											<span>{{timeFormate($class->class_end_time)}}</span>
										</li>
									</ul>
									<label>{{$class->currency}} {{$class->class_cost}}</label>
								</div>
							</a>
						</div>
					</div><!--end-->
					@empty
					@endforelse
				
				</div>
			</div>
			<div class="pagination">
				<ul>
					<li>
						<a href="javascript:void(0);"><i class="fa fa-chevron-left"></i></a>
					</li>
					<li>
						<a href="javascript:void(0);">1</a>
					</li>
					<li>
						<a href="javascript:void(0);">2</a>
					</li>
					<li>
						<a href="javascript:void(0);">3</a>
					</li>
					<li>
						<a href="javascript:void(0);">5</a>
					</li>
					<li>
						<a href="javascript:void(0);">6</a>
					</li>
					<li>
						<a href="javascript:void(0);"><i class="fa fa-chevron-right"></i></a>
					</li>
				</ul>
			</div>
		</div>
	</section><!--end-->

@endsection