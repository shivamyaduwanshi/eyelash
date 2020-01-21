@extends('frontend.layouts.app')
@section('content')
   @section('title')
     Products
   @endsection
  <!--product details-->
	<section class="product-details">
		<div class="container">
			<div class="navigation">
				<a href="{{route('home')}}">Home</a> >
				<a href="javascript::void(0)">All Products</a>
			</div>
			<div class="more-product">
				<div class="row">
  				 @forelse($data['products'] as $key => $product)
					<!--single product-->
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="img-wrapper">
							<a href="{{route('product.details',encrypt('1'))}}">
								<div class="img">
									<img src="{{$product->product_image}}" alt="suggestion-gallery" class="img-fluid">
								</div>
								<div class="price-name">
									<h2>{{$product->product_name}}</h2>
									<label>{{env('CURRENCY')}}{{$product->product_cost}}</label>
								</div>
							</a>
						</div>
					</div><!--end-->
					@empty
					@endforelse
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
		</div>
	</section><!--end-->
  <!--product details-->
@endsection