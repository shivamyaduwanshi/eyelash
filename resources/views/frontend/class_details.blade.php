@extends('frontend.layouts.app')
@section('content')
    @section('title')
      Class | {{$data['class']->class_name}}
    @endsection
  	<!--product details-->
	<section class="product-details service-details classes-details">
		<div class="container">
			<div class="navigation">
				<a href="{{route('home')}}">Home</a> >
				<a href="javascript::void(0)">Classes Details</a>
			</div>
			<!--single-service-->
			<div class="single-service">
				<div class="row">
					<div class="col-md-2 col-sm-24 col-xs-22">
						<div class="product-img">
							<img src="{{asset('public/assets/frontend/')}}/images/cap.png">
						</div>
					</div>

					<div class="col-md-10 col-sm-10 col-xs-10">
						<div class="product-txt">
							<div class="name-price">
								<h2>{{$data['class']->class_name}}</h2>
								<label>Cost: {{$data['class']->currency}} {{$data['class']->class_cost}}</label>
								<div class="border"></div>
								<ul>
									<li>
										<i class="fa fa-calendar"></i>
										<span>{{dateFormate($data['class']->class_start_date)}}</span> To
										<span>{{dateFormate($data['class']->class_end_date)}}</span>
									</li>
									<li>
										<i class="fa fa-clock-o"></i>
										<span>{{timeFormate($data['class']->class_start_time)}}</span> To 
										<span>{{timeFormate($data['class']->class_end_time)}}</span>
									</li>
								</ul>
							</div>
							<div class="border"></div>
							<p class="ledt-item"> <button>4 Seat left</button> </p>
							<div class="border"></div>
							<div class="Description">
								<h2>Description:</h2>
								<p>{{$data['class']->class_description}}</p>
							</div>
						</div>
					</div>
				</div>
			</div><!--end-->
			<div class="book-appointment">
				<div class="ad-strip clearfix">
					<h2>Total Amount {{$data['class']->currency}} {{$data['class']->class_cost}}</h2>
					<!-- <button data-toggle="modal" data-target="#add-service"><i class="fa fa-plus"></i> Add More Services</button> -->
				</div>
			</div>

			<div class="date-time">
				<div class="head-strip">
					<h2>Select Date &amp; Time</h2>
				</div>
				<div class="calendar-time">
					<div class="row">
						<div class="col-md-7 col-sm-12 col-xs-12">
							<div class="calendar">
								 <div id="calendar"></div>
							</div>
						</div>

						<div class="col-md-5 col-sm-12 col-xs-12">
							<div class="class-timing">
								<h2>Class Timing</h2>
								<div class="class-t">
									<div class="from">
										<h5>From</h5>
										<label>{{timeFormate($data['class']->class_start_time)}}</label>
									</div>
									<span class="dash">-</span>
									<div class="to">
										<h5>To</h5>
										<label>{{timeFormate($data['class']->class_end_time)}}</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="btn">
				<a href="{{route('class.payment',['id' => encrypt($data['class']->id)])}}">Next <i class="fa fa-arrow-right"></i> </a>
			</div>
		</div>
	</section><!--end-->
@endsection
@push('js')
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script type="text/javascript">
 	$(function(){

 		startDate = "{{date('m/d/y',strtotime($data['class']->class_start_date))}}";
		endDate   = "{{date('m/d/y',strtotime($data['class']->class_end_date))}}";

		console.log(startDate);
        console.log(endDate);
        
     //   $('#add-service-modal').modal('show');
 		/*
 		* Calander JS
 		*/
         $('#calendar').datepicker({
         	minDate : startDate,
         	maxDate : endDate,
	        onSelect: function(dateText, inst) {
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