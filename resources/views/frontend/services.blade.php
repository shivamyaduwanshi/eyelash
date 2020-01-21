@extends('frontend.layouts.app')
@section('content')
    
    @section('title')
      Services
    @endsection

  	<!--product details-->
	<section class="product-details service-list our-services">
		<div class="container">
			<div class="navigation">
				<a href="{{route('home')}}">Home</a> >
				<a href="javascript::void(0)">All Services</a>
			</div>
			<div class="service-body">
				<div class="row">
					@forelse($data['services'] as $key => $service)
					<!--single-srvc-->
					<div class="col-md-6 col-sm-12 col-xs-12">
						<div class="single-srvc clearfix">
							<a href="{{route('service.details',['id' => encrypt($service->id)])}}">
								<div class="img">
									<img src="{{$service->service_image}}">
								</div>
								<div class="txt">
									<h2>{{$service->service_name}}</h2>
									<p>{{$service->service_description}}</p>
									<label>{{$service->currency}} {{$service->service_cost}}<p class="s-rating"> <span>5</span> <i class="fa fa-star"></i> </p> </label>
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