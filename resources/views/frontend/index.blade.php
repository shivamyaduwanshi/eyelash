@extends('frontend.layouts.app')
@section('content')

    @section('title')
       Home
    @endsection

	<!--our product-->
	<section class="our-product">
		<div class="section-heading">
			<h2 class="same-heading">Our Products</h2>
			<p>Lorem ipsum dolor sit amet, consectetur</p>
			<div class="flower-line">
				<p><img src="{{asset('public/assets/frontend/')}}/images/flower.png"></p>
			</div>
		</div>

		<div class="section-body">
			<div class="product-gallery">
				<div class="photos">
					@forelse($data['products'] as $key => $product)
                       
                       @if($key == 4)
                           @break
                       @endif
                   
                    @if($key == 0)
					<div class="img-wrapper top">
						<a href="{{ route('product.details',encrypt($product->id))}}">
							<div class="img">
								<img src="{{$product->product_image}}" alt="suggestion-gallery" class="img-fluid">
							</div>
							<div class="price-name">
								<h2>{{$product->product_name}}</h2>
								<label>{{$product->currency}}{{$product->product_cost}}</label>
							</div>
						</a>
					</div>
					@endif
					@if($key == 1)
					<div class="img-double">
						<div class="img-wrapper">
							<a href="{{ route('product.details',encrypt($product->id))}}">
								<div class="img">
									<img src="{{$product->product_image}}" alt="suggestion-gallery" class="img-fluid">
								</div>
								<div class="price-name">
									<h2>{{$product->product_name}}</h2>
									<label>{{$product->currency}}{{$product->product_cost}}</label>
								</div>
							</a>
						</div>
						<div class="img-wrapper">
							<a href="{{ route('product.details',encrypt($product->id))}}">
								<div class="img">
									<img src="{{$product->product_image}}" alt="suggestion-gallery" class="img-fluid">
								</div>
								<div class="price-name">
									<h2>{{$product->product_name}}</h2>
									<label>{{$product->currency}}{{$product->product_cost}}</label>
								</div>
							</a>
						</div>
					</div>
					@endif
					@if($key == 3)
					<div class="img-wrapper bottom">
						<a href="{{ route('product.details',encrypt($product->id))}}">
							<div class="img">
								<img src="{{asset('public/assets/frontend/')}}/images/04.jpg" alt="suggestion-gallery" class="img-fluid">
							</div>
							<div class="price-name">
								<h2>{{$product->product_name}}</h2>
								<label>{{$product->currency}}{{$product->product_cost}}</label>
							</div>
						</a>
					</div>
					@endif
					@empty
					@endforelse
				</div>
				<div class="view-btn">
					<a href="{{route('products')}}">View All <i class="fa fa-arrow-right"></i></a>
				</div>
			</div>
		</div>
	</section><!--end-->

	<!--our services-->
	<section class="our-services">
		<div class="container">
			<div class="section-heading">
				<h2 class="same-heading">Our Services & Price</h2>
				<p>Lorem ipsum dolor sit amet, consectetur</p>
				<div class="flower-line">
					<p><img src="{{asset('public/assets/frontend/')}}/images/flower.png"></p>
				</div>
			</div>

			<div class="service-body">
				<div class="row">
				   @forelse($data['services'] as $key => $service)
                       
                       @if($key == 4)
                           @break
                       @endif

						<!--single-srvc-->
						<div class="col-md-6 col-sm-12 col-xs-12">
							<div class="single-srvc clearfix">
								<a href="{{url('/service/details?id='.encrypt($service->id))}}">
								<div class="img">
									<img src="{{$service->service_image}}">
								</div>
								<div class="txt">
									<h2>{{$service->service_name}}</h2>
									<p>{{$service->service_description}}</p>
									<label>{{$service->currency}} {{$service->service_cost}}<p class="s-rating"> <span>4.1</span> <i class="fa fa-star"></i> </p> </label>
								</div>
						   	  </a>
							</div>
						</div><!--end-->
					@empty
					@endforelse
				</div>

				<div class="view-btn text-center">
					<a href="{{route('services')}}">View All <i class="fa fa-arrow-right"></i></a>
				</div>
			</div>
		</div>
	</section><!--end-->

	<!--our services-->
	<section class="our-services our-classes">
		<div class="container">
			<div class="section-heading">
				<h2 class="same-heading">Our Classes</h2>
				<p>Lorem ipsum dolor sit amet, consectetur</p>
				<div class="flower-line">
					<p><img src="{{asset('public/assets/frontend/')}}/images/flower.png"></p>
				</div>
			</div>

			<div class="service-body">
				<div class="row">
					@forelse($data['classes'] as $key => $class)
                       
                       @if($key == 4)
                           @break
                       @endif
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
			<div class="view-btn text-center">
				<a href="{{route('classes')}}">View All <i class="fa fa-arrow-right"></i></a>
			</div>
		</div>
	</section><!--end-->

	<!-- The Modal -->
  <div class="modal fade home-popup" id="home-popup">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">What Are You Looking</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <div class="choose-option">
	          	<!--single-choosen-->
	          	<div class="single-choosen">
	          		<label data-dismiss="modal">
	          			<input type="radio" checked="" name="radio">
	          			<span class="checkmark">
	          				<i class="fa fa-graduation-cap"></i>
	          				<h4>Classes</h4>
	          			</span>
	          		</label>
	          	</div>

	          	<!--single-choosen-->
	          	<div class="single-choosen">
	          		<label data-dismiss="modal">
	          			<input type="radio" name="radio">
	          			<span class="checkmark">
	          				<i class="fa fa-calendar"></i>
	          				<h4>Appointment</h4>
	          			</span>
	          		</label>
	          	</div>
	        </div>
        </div>
        
        <!-- Modal footer -->
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div> -->
        
      </div>
    </div>
  </div>
<!--script-->

	@endsection