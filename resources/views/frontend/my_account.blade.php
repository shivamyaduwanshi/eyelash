@extends('frontend.layouts.app')
@section('content')
    @section('title')
      My Account
    @endsection
  	<!--product details-->
	<section class="product-details my-account">
		<div class="container">
			<div class="navigation">
				<a href="{{route('home')}}">Home</a> >
				<a href="javascript::void(0)">My Account</a>
			</div>
			<div class="profile-details">
				<div class="profile">
					<img src="{{$data['user']->user_image}}" title="{{$data['user']->user_name}}">
					<input type="file" name="">
					<i class="fa fa-camera"></i>
				</div>
				<div class="details">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Name" name="Name" value="{{old('name') ?? $data['user']->user_name}}">
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email') ?? $data['user']->email}}">
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<input type="text" class="form-control" value="{{old('phone') ?? $data['user']->phone}}" placeholder="Number" name="phone">
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<input type="text" class="form-control" value="{{old('address') ?? $data['user']->address}}" placeholder="Address" name="">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="border"></div>

			<div class="profile-tabs">
				<ul class="nav nav-tabs" role="tablist">
				    <li class="nav-item">
				      <a class="nav-link active" data-toggle="tab" href="#orders">My Orders</a>
				    </li>
				    <li class="nav-item">
				      <a class="nav-link" data-toggle="tab" href="#classes">My Classes</a>
				    </li>
				    <li class="nav-item">
				      <a class="nav-link" data-toggle="tab" href="#appointment">My Appointment</a>
				    </li>
				  </ul>

				  <!-- Tab panes -->
				  <div class="tab-content">
				    <div id="orders" class="orders container tab-pane active"><br>
				      <div class="service-body">
						<div class="row">
							@forelse($data['orders'] as $key => $value)
							<!--single-srvc-->
							<div class="col-md-6 col-sm-12 col-xs-12">
								<div class="single-srvc order-detail-model-btn" data-toggle="modal" data-target="#order-details" data="{{$value->json_data}}">
									<div class="date-strip">
										<h2><i class="fa fa-calendar"></i> <span>{{date('d-M-Y',strtotime($value->created_at))}}</span></h2>
									</div>
									<div class="warpper clearfix">
										<div class="img">
											<img src="{{$value->product_image}}">
										</div>
										<div class="txt">
											<h2>{{$value->product_name}}</h2>
											<label>{{env('CURRENCY')}} {{$value->product_cost}}</label>
											<div class="border2"></div>
											<p>{{$value->product_description}}</p>
										</div>
									</div>
								</div>
							</div><!--end-->
							@empty
							@endforelse
						</div>
					</div>
				    </div>
				    <div id="classes" class="our-classes container tab-pane fade"><br>
				      	<div class="service-body">
					      	<div class="row">
					      		@forelse($data['classes'] as $key => $value)
								<!--single-srvc-->
								<div class="col-md-6 col-sm-12 col-xs-12">
									<div class="single-srvc class-booking-order-btn" data-toggle="modal" data-target="#class-details" data="{{$value->json_data}}">
										<div class="date-strip">
											<h2><i class="fa fa-calendar"></i> <span>{{date('d-M-Y',strtotime($value->created_at))}}</span></h2>
										</div>
										<div class="warpper clearfix">
											<div class="img">
												<img src="{{asset('public/assets/frontend')}}/images/cap.png">
											</div>
											<div class="txt">
												<h2>{{$value->class_name}}</h2>
												<label>{{$value->total_cost}}</label>
												<div class="border2"></div>
												<ul>
													<li>
														<i class="fa fa-calendar"></i>
														<span>{{date('d-M-Y',strtotime($value->class_start_date))}}</span> To
														<span>{{date('d-M-Y',strtotime($value->class_end_date))}}</span>
													</li>
													<li>
														<i class="fa fa-clock-o"></i>
														<span>{{date('h:i A',strtotime($value->class_start_time))}}</span> To 
														<span>{{date('h:i A',strtotime($value->class_end_time))}}</span>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div><!--end-->
								@empty
								@endforelse
							</div>
				      	</div>
				    </div>
				    <div id="appointment" class="appointment container tab-pane fade"><br>
				     	<div class="service-body">
					      	<div class="row">
					      		@forelse($data['appointments'] as $key => $value)
									<!--single-srvc-->
									<div class="col-md-6 col-sm-12 col-xs-12">
										<div class="single-srvc class-modal-btn" data-toggle="modal" data-target="#appointment-details" data="{{$value->json_data}}">
											<div class="date-strip">
												<h2><i class="fa fa-calendar"></i> <span>{{$value->appointment_date}}</span></h2>
											</div>
											<div class="warpper clearfix">
												<div class="img">
													<img src="{{asset('public/assets/frontend')}}/images/cap.png">
												</div>
												<div class="txt">
													<h2>{{$value->service_names}}</h2>
													<ul>
														<li>
															<i class="fa fa-calendar"></i>
															<span>{{$value->appointment_date}}</span>
														</li>
														<li>
															<i class="fa fa-clock-o"></i>
															<span>{{$value->time_slot}}</span>
														</li>
													</ul>
													<label>Total Amount: {{$value->total_cost}}</label>
												</div>
											</div>
										</div>
									</div><!--end-->
					      		@empty
					      		@endforelse
							</div>
				      	</div>
				  </div>
			</div>
		</div>
	</section><!--end-->
	<!---------------ORDER DETAILS-------------->
<!-- The Modal -->
  <div class="modal fade buynow-popup order-details-p " id="order-details">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Order Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body order-detail-model">
          <div class="p-0 order-details service-body">
          	<form>
          		<div class="basic-details">
          			<h2 class="heading">Product Details</h2>
          			<div class="row">
          				<!--single-srvc-->
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="single-srvc clearfix">
								<div class="img">
									<img src="images/03.jpg" class="product-image">
								</div>
								<div class="txt">
									<h2 class="product-name">Luxury Lashes</h2>
									<label class="product-cost">$150</label>
									<div class="border2"></div>
									<p class="product-description">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
									
								</div>
							</div>
						</div><!--end-->
          			</div>
          		</div>
          		<div class="border2"></div>
          		<div class="payment-method">
          			<h2 class="heading">Basic Details</h2>
          			<div class="row">
          				<div class="col-md-6 col-sm-6 col-xs-12">
		          			<div class="form-group">
			          			<input type="text" class="form-control name" value="John Smith" placeholder="Full Name" name="" readonly> 
			          		</div>
		          		</div>
		          		<div class="col-md-6 col-sm-6 col-xs-12">
		          			<div class="form-group">
			          			<input type="text" class="form-control phone" value="+12 3564859578" placeholder="Number" name="" readonly>
			          		</div>
		          		</div>
          				<div class="col-md-12 col-sm-12 col-xs-12">
          					<div class="form-group">
			          			<input type="text" class="form-control address" value="Sectore A -85/2 Lorem ipsum, ipsum, (A.B.) 123456" placeholder="Address" name="" readonly>
			          		</div>
			          	</div>	          		
          			</div>
          		</div>
          		<div class="border2"></div>
          		<div class="payment-details">
          			<h2 class="heading">Payment Details</h2>

          			<div class="status-type">
          				<h3>Payment Status: <span class="payment-status">Paid</span></h3>
          				<h3>Payment Type: <span class="payment-mode">Paypal</span></h3>
          			</div>
          		</div>
          	</form>
          </div>
        </div>       
      </div>
    </div>
  </div>

  <!---------------ORDER DETAILS-------------->
<!---------------CLASSES DETAILS-------------->
<!-- The Modal -->
  <div class="modal fade buynow-popup our-classes class-booking-order-btn" id="class-details">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Classes Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body class-detail-model">
          <div class="p-0 order-details service-body">
          	<form>
          		<div class="basic-details">
          			<h2 class="heading">Product Details</h2>
          			<div class="row">
          				<!--single-srvc-->
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="single-srvc">
								<div class="warpper clearfix">
									<div class="img">
										<img src="{{asset('public/assets/frontend')}}/images/cap.png">
									</div>
									<div class="txt">
										<h2 class="class-name">Butterfly Lashes</h2>
										<label class="total-cost">$150</label>
										<div class="border2"></div>
										<ul>
											<li>
												<i class="fa fa-calendar"></i>
												<span class="class-start-date">19-Nov-19</span> To
												<span class="class-end-date">25-Nov-19</span>
											</li>
											<li>
												<i class="fa fa-clock-o"></i>
												<span class="class-start-time">9AM:00</span> To 
												<span class="class-end-time">3:00 Pm</span>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div><!--end-->
          			</div>
          		</div>
          		<div class="border2"></div>
          		<div class="payment-method">
          			<h2 class="heading">Basic Details</h2>
          			<div class="row">
          				<div class="col-md-6 col-sm-6 col-xs-12">
		          			<div class="form-group">
			          			<input type="text" class="form-control name" value="John Smith" placeholder="Full Name" name="">
			          		</div>
		          		</div>
		          		<div class="col-md-6 col-sm-6 col-xs-12">
		          			<div class="form-group">
			          			<input type="text" class="form-control phone" value="+12 3564859578" placeholder="Number" name="">
			          		</div>
		          		</div>
          				<div class="col-md-12 col-sm-12 col-xs-12">
          					<div class="form-group">
			          			<input type="text" class="form-control address" value="Sectore A -85/2 Lorem ipsum, ipsum, (A.B.) 123456" placeholder="Address" name="">
			          		</div>
			          	</div>	          		
          			</div>
          		</div>
          		<div class="border2"></div>
          		<div class="payment-details">
          			<h2 class="heading">Payment Details</h2>

          			<div class="status-type">
          				<h3>Payment Status: <span class="payment-status">Paid</span></h3>
          				<h3>Payment Type: <span class="payment-mode">Paypal</span></h3>
          			</div>
          		</div>
          	</form>
          </div>
        </div>        
      </div>
    </div>
  </div>
<!---------------Appointment DETAILS-------------->
<!-- The Modal -->
  <div class="modal fade buynow-popup appointment" id="appointment-details">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Appointment Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body app-detail-modal">
          <div class="p-0 order-details service-body">
          	<p>Appointment ID:<span class="appointment-id"></span></p>
          	<form>
          		<div class="basic-details">
          			<div class="row">
          				<!--single-srvc-->
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="single-srvc">
								<div class="warpper clearfix">
									<div class="img">
										<img src="images/05.jpg">
									</div>
									<div class="txt">
										<h2 class="app-services">Butterfly Lashes</h2>
										<label class="app-total-cost">$150</label>
										<div class="border2"></div>
										<ul>
											<li>
												<i class="fa fa-calendar"></i>
												<span class="app-appointment-date">19-Nov-19</span>
											</li>
											<li>
												<i class="fa fa-clock-o"></i>
												<span class="app-slot-time">9AM:00</span>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div><!--end-->
          			</div>
          		</div>
          		<div class="border2"></div>
          		<div class="payment-method">
          			<h2 class="heading">Basic Details</h2>
          			<div class="row">
          				<div class="col-md-6 col-sm-6 col-xs-12">
		          			<div class="form-group">
			          			<input type="text" class="form-control app-name" value="John Smith" placeholder="Full Name" name="">
			          		</div>
		          		</div>
		          		<div class="col-md-6 col-sm-6 col-xs-12">
		          			<div class="form-group">
			          			<input type="text" class="form-control app-phone" value="+12 3564859578" placeholder="Number" name="">
			          		</div>
		          		</div>
          				<div class="col-md-12 col-sm-12 col-xs-12">
          					<div class="form-group">
			          			<input type="text" class="form-control app-address" value="Sectore A -85/2 Lorem ipsum, ipsum, (A.B.) 123456" placeholder="Address" name="">
			          		</div>
			          	</div>	          		
          			</div>
          		</div>
          		<div class="border2"></div>

          		<div class="spc-box">
          			<div class="row">
          				<div class="col-md-4 col-sm-12">
          					<div class="payment-details">
			          			<h2 class="heading">Selected Services</h2>

			          			<div class="status-type services-list">
			          			</div>
			          		</div>
          				</div>
          				<div class="col-md-4 col-sm-12">
          					<div class="payment-details">
			          			<h2 class="heading">Payment Details</h2>

			          			<div class="status-type">
			          				<h3>Payment Status: <span class="app-payment-status">Paid</span></h3>
			          				<h3>Payment Type: <span class="app-payment-mode">Paypal</span></h3>
			          			</div>
			          		</div>
          				</div>
          				<div class="col-md-4 col-sm-12">
          					<div class="qr-code">
			          			<h2 class="heading">Generated QR Code</h2>

			          			<div class="code-img">
			          				<img src="images/QR-Code.png">
			          			</div>
			          		</div>
          				</div>
          			</div>
          		</div>

          		<div class="border2"></div>

          		<div class="rating-box">
          			<h2>Share your experience</h2>
          			<form>
          				<input type="hidden" name="app-id" value="" class="app-id">
          				<div class="product-star-rating star-rating clearfix">
					      <input class="rating" name="rating" value="">
					    </div>
          				<ul>
	          				<li><i class="fa fa-star fill"></i></li>
	          				<li><i class="fa fa-star fill"></i></li>
	          				<li><i class="fa fa-star fill"></i></li>
	          				<li><i class="fa fa-star"></i></li>
	          				<li><i class="fa fa-star"></i></li>
	          			</ul>
	          			<textarea class="form-control review" name="review" rows="3" placeholder="Write here..."></textarea>
	          			<span class="review-error-text text-red" style="display: none;">Review field is required</span>

	          			<div class="btn">
	          				<button type="submit" class="give-review-rating">Submit</button>
	          			</div>
          			</form>
          		</div>
          	</form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('css')
 <style type="text/css" src="{{asset('public/assets/frontend/css/simple-rating.css')}}"></style>
@endpush
@push('js')
  <script type="text/javascript" src="{{asset('public/assets/frontend/js/simple-rating.js')}}"></script>
  <script type="text/javascript">

  	$('.order-detail-model .review-error-text').hide();

  	$('.order-detail-model-btn').on('click',function(e){
       data = $(this).attr('data');
       data = JSON.parse(data);
		$('.order-detail-model .product-name').text(data.product_name);
		$('.order-detail-model .product-cost').text(data.total_cost);
		$('.order-detail-model .product-description').text(data.product_description);
		$('.order-detail-model .name').val(data.name);
		$('.order-detail-model .phone').val(data.phone);
		$('.order-detail-model .email').val(data.email);
		$('.order-detail-model .address').val(data.address);
		$('.order-detail-model .payment-status').text(data.payment_status);
		$('.order-detail-model .payment-mode').text(data.payment_mode);
		$('.order-detail-model .product-image').attr('src',data.product_image);
  	});

  	$('.class-booking-order-btn').on('click',function(e){
        data = $(this).attr('data');
        data = JSON.parse(data);
		$('.class-detail-model .class-name').text(data.class_name);
		$('.class-detail-model .total-cost').text(data.total_cost);
		$('.class-detail-model .class-description').text(data.class_description);
		$('.class-detail-model .class-start-date').text(data.class_start_date);
		$('.class-detail-model .class-end-date').text(data.class_end_date);
    	$('.class-detail-model .class-start-time').text(data.class_start_time);
		$('.class-detail-model .class-end-time').text(data.class_end_time);
		$('.class-detail-model .name').val(data.name);
		$('.class-detail-model .phone').val(data.phone);
		$('.class-detail-model .email').val(data.email);
		$('.class-detail-model .address').val(data.address);
		$('.class-detail-model .payment-status').text(data.payment_status);
		$('.class-detail-model .payment-mode').text(data.payment_mode);
  	});

  	$('.class-modal-btn').on('click',function(e){
         data = $(this).attr('data');
         data = JSON.parse(data);
       	$('.app-detail-modal .rating').val(data.rating);
   	    $('.app-detail-modal .review').val(data.review);
    	$('.app-detail-modal .app-id').val(data.appointment_id);
   	    $('.app-detail-modal .app-services').text(data.service_names);
	    $('.app-detail-modal .appointment-id').text(data.appointment_booking_id);
		$('.app-detail-modal .app-total-cost').text(data.total_cost);
    	$('.app-detail-modal .app-appointment-date').text(data.appointment_date);
		$('.app-detail-modal .app-slot-time').text(data.time_slot);
		$('.app-detail-modal .app-name').val(data.name);
		$('.app-detail-modal .app-phone').val(data.phone);
		$('.app-detail-modal .app-email').val(data.email);
		$('.app-detail-modal .app-address').val(data.address);
		$('.app-detail-modal .app-payment-status').text(data.payment_status);
		$('.app-detail-modal .app-payment-mode').text(data.payment_mode);
		html = '';
		if(data.service_name){
	       data.service_name.forEach(function(value,key){
	         html +='<h3>'+value.service_name+': <span>$ '+value.service_price+'</span></h3>';
	       });
		}
		$('.app-detail-modal .services-list').html(html);
  	});

  	$('.give-review-rating').on('click',function(e){
  		 e.preventDefault();
  		 rating = $('input[name="rating"]').val();
  		 review = $('textarea[name="review"]').val();
  		 appId  = $('input[name="app-id"]').val();

  		 if(isEmpty(review)){
            $('.review-error-text').show();
  		 }else{
  		 	$('.review-error-text').hide();
  		 }

  		   data = { appId , rating , review };
				       	  
			$.ajax({
				"headers":{
				'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
			},
			'type':'POST',
			'url' : "{{route('give.review.rating')}}",
			'data' : data,
			beforeSend: function() {

			},
			'success' : function(response){
              console.log(response);  
       	    },
			'error' : function(error){
			console.log(error);
			},
			complete: function() {

			},
			});

  	});

  	 function isEmpty(str) {
		        return (!str || 0 === str.length);
		      }

  </script>
@endpush