@extends('frontend.layouts.app')
@section('content')
   @section('title')
     Service | {{$data['service']->service_name ?? ''}}
   @endsection
  	<!--product details-->
	<section class="product-details service-details">
		<div class="container">
			<div class="navigation">
				<a href="{{route('home')}}">Home</a> >
				<a href="javascript::void(0)">Service Details</a>
			</div>
			@php $totalCost = 0 @endphp
			@forelse($data['cart_services'] as $key => $service)
			  @php $totalCost += $service->service_cost @endphp
			<!--single-service-->
			<div class="single-service">
				<div class="row">
					<div class="col-md-2 col-sm-4 col-xs-12">
						<div class="product-img">
							<img src="{{$service->service_image}}">
						</div>
					</div>

					<div class="col-md-10 col-sm-8 col-xs-12">
						<div class="product-txt">
							<div class="name-price">
								<h2>{{$service->service_name}}</h2>
								<label>Cost: {{$service->currency}} {{$service->service_cost}} 
									<p data-toggle="modal" data-target="#customer-ratting" class="s-rating"> <span>5</span> <i class="fa fa-star"></i></p> 
								</label>
								<!-- <p> <label>Stock : </label> <span>Only 4 left</span></p> -->
							</div>
							<div class="border"></div>
							<div class="Description">
								<h2>Description:</h2>
								<p>{{$service->service_description}}</p>
							</div>
							@if($data['totalCartServices'] > 1)
							<a href="{{route('remove.item',['item_type' => 'Service' , 'item_id' => encrypt($service->id)])}}" class="delete"><i class="fa fa-trash"></i> Remove</a>
							@endif
						</div>
					</div>
				</div>
			</div><!--end-->
			@empty
			@endforelse
			<div class="book-appointment">
				<div class="ad-strip clearfix">
					<h2>Total Amount {{env('CURRENCY')}} {{$totalCost}}</h2>
 					<button type="button" data-toggle="modal" data-target="#add-service"><i class="fa fa-plus"></i> Add More Services</button>
{{--   				    <button id="add-service-modal"><i class="fa fa-plus"></i> Add More Services</button> --}}
				</div>
			</div>
			<p class="b-warning booking-alert">
				<i class="fa fa-info-circle"></i>
				This time slot is not available, If you book, Your appointment will be waitlisted
			</p>
			<p class="b-danger booking-alert">
				<i class="fa fa-info-circle"></i>
				This time slot is blocked by admin
			</p>
			<p class="b-success booking-alert">
				<i class="fa fa-briefcase"></i>
				<b>Hurry Up!</b> This schedule is 50% busy book your appointment 
			</p>
			<div class="date-time">
				<div class="head-strip">
					<h2>Select Date & Time</h2>
				</div>
				<div class="calendar-time">
					<div class="row">
						<div class="col-md-7 col-sm-12 col-xs-12">
							<div class="calendar">
							  <div id="calendar"></div>
							</div>
						</div>
                        <form></form>
						<div class="col-md-5 col-sm-12 col-xs-12">
							<form id="timeSlotForm" action="{{route('service.payment')}}" method="GET">
								<input type="hidden" name="appointment_date" value="{{date('Y-m-d')}}">
								@csrf
								<div class="time-tag" id="timeSlotList">
									@forelse($data['timeSlots'] as $key => $timeSlot)
									<label class="tag">
										<input type="radio" name="time_slot" value="{{$timeSlot}}">
										<span>{{$timeSlot}}</span>
									</label>
									@empty
									@endforelse
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<div class="btn">
 				<a href="javascript::void(1)" class="payment-page">Next <i class="fa fa-arrow-right"></i> </a>
			</div>
		</div>
		 <!-- The Modal -->
  <div class="modal fade customer-reviews" id="customer-ratting">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="cr-header modal-header">
			<h2>Reviews</h2>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
			<div class="cr-wrapper">
				<div class="cr-body">
					<ul>
						<!--single ratting-->
						<li>
							<div class="img-txt">
								<div class="img">
									<img src="images/login-pic.jpg">
								</div>
								<div class="txt">
									<label>19-Dec-20</label>
									<h5>Natalie rachel</h5>
								</div>
							</div>
							<p class="comment">Amazing very fast service...!</p>
							<div class="star-ratting">
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</div>
						</li><!--end-->
						<!--single ratting-->
						<li>
							<div class="img-txt">
								<div class="img">
									<img src="images/login-pic.jpg">
								</div>
								<div class="txt">
									<label>19-Dec-20</label>
									<h5>Natalie rachel</h5>
								</div>
							</div>
							<p class="comment">Amazing very fast service...!</p>
							<div class="star-ratting">
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</div>
						</li><!--end-->
						<!--single ratting-->
						<li>
							<div class="img-txt">
								<div class="img">
									<img src="images/login-pic.jpg">
								</div>
								<div class="txt">
									<label>19-Dec-20</label>
									<h5>Natalie rachel</h5>
								</div>
							</div>
							<p class="comment">Amazing very fast service...!</p>
							<div class="star-ratting">
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</div>
						</li><!--end-->
						<!--single ratting-->
						<li>
							<div class="img-txt">
								<div class="img">
									<img src="images/login-pic.jpg">
								</div>
								<div class="txt">
									<label>19-Dec-20</label>
									<h5>Natalie rachel</h5>
								</div>
							</div>
							<p class="comment">Amazing very fast service...!</p>
							<div class="star-ratting">
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</div>
						</li><!--end-->
						<!--single ratting-->
						<li>
							<div class="img-txt">
								<div class="img">
									<img src="images/login-pic.jpg">
								</div>
								<div class="txt">
									<label>19-Dec-20</label>
									<h5>Natalie rachel</h5>
								</div>
							</div>
							<p class="comment">Amazing very fast service...!</p>
							<div class="star-ratting">
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</div>
						</li><!--end-->
						<!--single ratting-->
						<li>
							<div class="img-txt">
								<div class="img">
									<img src="images/login-pic.jpg">
								</div>
								<div class="txt">
									<label>19-Dec-20</label>
									<h5>Natalie rachel</h5>
								</div>
							</div>
							<p class="comment">Amazing very fast service...!</p>
							<div class="star-ratting">
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</div>
						</li><!--end-->
					</ul>
				</div>
			</div>
        </div>        
      </div>
    </div>
  </div>
	</section><!--end-->
	<!-- The Modal -->
  <div class="modal fade buynow-popup add-service-modal" id="add-service">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Proceed To Order</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        	<div class="service-body">
				<div class="row">
					@forelse($data['services'] as $key => $service)
					<!--single-srvc-->
					<div class="col-md-6 col-sm-12 col-xs-12">
						<div class="single-srvc clearfix">
							<a href="{{route('service.details',[ 'id' => encrypt($service->id), 'addMore' => true ])}}">
							<div class="img">
								<img src="{{$service->service_image}}">
							</div>
							<div class="txt">
								<h2>{{$service->service_name}}</h2>
								<p>{{$service->service_description}}</p>
								<label>{{env('CURRENCY')}} {{$service->service_cost}} <p class="s-rating"> <span>4.1</span> <i class="fa fa-star"></i> </p> </label>
							</div>
						   </a>
						</div>
					</div><!--end-->
					@empty
					@endforelse
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

 <!-- The Modal -->
  <div class="modal fade customer-reviews" id="customer-ratting">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="cr-header modal-header">
			<h2>Reviews</h2>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
			<div class="cr-wrapper">
				<div class="cr-body">
					<ul>
						<!--single ratting-->
						<li>
							<div class="img-txt">
								<div class="img">
									<img src="images/login-pic.jpg">
								</div>
								<div class="txt">
									<label>19-Dec-20</label>
									<h5>Natalie rachel</h5>
								</div>
							</div>
							<p class="comment">Amazing very fast service...!</p>
							<div class="star-ratting">
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</div>
						</li><!--end-->
						<!--single ratting-->
						<li>
							<div class="img-txt">
								<div class="img">
									<img src="images/login-pic.jpg">
								</div>
								<div class="txt">
									<label>19-Dec-20</label>
									<h5>Natalie rachel</h5>
								</div>
							</div>
							<p class="comment">Amazing very fast service...!</p>
							<div class="star-ratting">
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</div>
						</li><!--end-->
						<!--single ratting-->
						<li>
							<div class="img-txt">
								<div class="img">
									<img src="images/login-pic.jpg">
								</div>
								<div class="txt">
									<label>19-Dec-20</label>
									<h5>Natalie rachel</h5>
								</div>
							</div>
							<p class="comment">Amazing very fast service...!</p>
							<div class="star-ratting">
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</div>
						</li><!--end-->
						<!--single ratting-->
						<li>
							<div class="img-txt">
								<div class="img">
									<img src="images/login-pic.jpg">
								</div>
								<div class="txt">
									<label>19-Dec-20</label>
									<h5>Natalie rachel</h5>
								</div>
							</div>
							<p class="comment">Amazing very fast service...!</p>
							<div class="star-ratting">
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</div>
						</li><!--end-->
						<!--single ratting-->
						<li>
							<div class="img-txt">
								<div class="img">
									<img src="images/login-pic.jpg">
								</div>
								<div class="txt">
									<label>19-Dec-20</label>
									<h5>Natalie rachel</h5>
								</div>
							</div>
							<p class="comment">Amazing very fast service...!</p>
							<div class="star-ratting">
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</div>
						</li><!--end-->
						<!--single ratting-->
						<li>
							<div class="img-txt">
								<div class="img">
									<img src="images/login-pic.jpg">
								</div>
								<div class="txt">
									<label>19-Dec-20</label>
									<h5>Natalie rachel</h5>
								</div>
							</div>
							<p class="comment">Amazing very fast service...!</p>
							<div class="star-ratting">
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star fill"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</div>
						</li><!--end-->
					</ul>
				</div>
			</div>
        </div>        
      </div>
    </div>
  </div>

@endsection
@push('js')
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script type="text/javascript">
 	$(function(){
        
     //   $('#add-service-modal').modal('show');
 		/*
 		* Calander JS
 		*/
 		 weekStartDay = "{{weekStartDay()}}";
         $('#calendar').datepicker({
         	minDate : 0,
         	firstDay: weekStartDay,
	        onSelect: function(dateText, inst) {
	         	getTimeSlots(dateText);
	        }
		 });

		 /*
		 *Get Time Slot
		 */

		 getTimeSlots = function (date) {
		 	 $('input[name="appointment_date"]').val(date);
				$.ajax({
					"headers":{
				    	'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
					},
					'type':'GET',
					'data' : {date :  date},
					'url' :  "{{route('getTimeSlots')}}",
					beforeSend: function() {

					},
					'success' : function(response){
                       $('.time-tag').html(response);
					},
					'error' : function(error){
					console.log(error);
					},
					complete: function() {

					},
				});
		 }

		 /*
		 * Payment Page
		 */

         $('.payment-page').on('click',function(){
             var timeSlots = [];
             $('#timeSlotList input:checked').each(function() {
		         timeSlots.push($(this).val());
	         });
             if(timeSlots.length <= 0){
                alert('Please select a time slot');
                return false;
             }
         	$('#timeSlotForm').submit();
         });


 	});
 </script>
@endpush