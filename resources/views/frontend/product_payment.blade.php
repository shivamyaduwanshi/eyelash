@extends('frontend.layouts.app')
@section('content')
   @section('title')
     Payment
   @endsection
  	<!--product details-->
	<section class="product-details">
		<div class="container">
			
			<div class="navigation">
				<a href="{{route('home')}}">Home</a>
				<a href="{{url()->previous()}}">Products</a>
				<a href="javascript::void(0)">Payment</a>
			</div>
			
			<div class="payment-page">
				<div class="heading">
					<h2>Enter Your Basic Details</h2>
				</div>
				<div class="basic-details">
					<div class="from">
						    <input type="hidden" name="product_id" value="{{encrypt($data['product_id'])}}">
							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Enter Your Name" name="name" value="{{$data['name']}}">
										<span class="text-red text-error">Please enter your name </span>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="form-group">
										<input type="email" class="form-control" placeholder="Enter Your Email" name="email" value="{{$data['email']}}">
        							    <span class="text-red text-error">Please enter your email </span>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Enter Your Phone Number" name="phone" value="{{$data['phone']}}">
										 <span class="text-red text-error">Please enter your phone number </span>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Enter Your Address(Optional)" name="address" value="{{$data['address']}}">
										 <span class="text-red text-error">Please enter your address </span>
									</div>
								</div>
							</div>
					</div>
				</div>

				<div class="payment-details">
					<div class="heading">
						<h2>Choose Your Payment Mathod</h2>
					</div>
					<div class="payment-body">
						<h2 class="total-amount">Total Amount <span>{{env('CURRENCY')}} {{$data['totalCast']}}</span></h2>
						<div class="choose-option">
			          	<!--single-choosen-->
				          	<div class="single-choosen">
				          		<label>
				          			<input type="radio" checked="" name="payment_mode" value="paypal">
				          			<span class="checkmark">
				          				<i class="fa fa-paypal"></i>
				          				<h4>Paypal</h4>
				          			</span>
				          		</label>
				          	</div>

				          	<!--single-choosen-->
				          	<div class="single-choosen">
				          		<label>
				          			<input type="radio" name="payment_mode" value="card">
				          			<span class="checkmark">
				          				<i class="fa fa-credit-card-alt"></i>
				          				<h4>Cards</h4>
				          			</span>
				          		</label>
				          	</div>
				          	<!--single-choosen-->
				          	<div class="single-choosen">
				          		<label>
				          			<input type="radio" name="payment_mode" value="cod">
				          			<span class="checkmark">
				          				<i class="fa fa-usd"></i>
				          				<h4>Cash</h4>
				          			</span>
				          		</label>
				          	</div>
				        </div>
					</div>
				</div>

				<div class="btn">
					<a href="javascript:void(0);" data-button-type="payment" data-backdrop="static" data-keyboard="false" class="buy-now" data-toggle="modal" data-target="#book-appointment"> Pay </a>
				</div>
			</div>
		</div>
	</section><!--end-->
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
  <!-- The Modal -->
  <div class="modal fade buynow-popup" id="cart-payment">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Enter Card Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <div class="order-details">
            <div id="dropin-container"></div>
            <div class="btn">
					<a data-button-type="card" data-backdrop="static" data-keyboard="false" id="buy-now" class="buy-now"> Pay </a>
			</div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
@endsection
@push('css')
  <style type="text/css">
	.braintree-large-button.braintree-toggle {
    	display: none;
	}
  </style>
@endpush
@push('js')
 <script src="https://js.braintreegateway.com/web/dropin/1.22.0/js/dropin.min.js"></script>
 <script type="text/javascript">

 	$(function(){
        
        totalCast = "{{$data['totalCast']}}";
   	  	  $('input[name="partial_amount"]').keypress(function (e) {
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				return false;
			}
		});

   	  	$('input[name="phone"]').keypress(function (e) {
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				return false;
			}
		});

			$('input[name="partial_amount"]').change(function (e) {
				if($(this).val() > parseInt(totalCast)){
					alert('Partial payment can not be greater than full payment amount');
					$(this).val(totalCast);
					$(this).prop("checked", false);
                    $('input[name="partial_amount"]').prop("checked", true);
					//return false;
				}
			});
           
      $('.text-error').hide();

      $('.buy-now').on('click',function(e){
        
        nonce   = '';
  		product_id = $('input[name="product_id"]').val();
		name    = $('input[name="name"]').val();
		email   = $('input[name="email"]').val();
		phone   = $('input[name="phone"]').val();
		address = $('input[name="address"]').val();
		payment_mode   = $('input[name="payment_mode"]:checked').val();

		if(isEmpty(name))
          $('input[name="name"]').closest('div').find('.text-error').show();
        else
          $('input[name="name"]').closest('div').find('.text-error').hide();

		if(isEmpty(email))
		  $('input[name="email"]').closest('div').find('.text-error').show();
		else
		  $('input[name="email"]').closest('div').find('.text-error').hide();

		if(isEmpty(phone))
		  $('input[name="phone"]').closest('div').find('.text-error').show();
		else
		  $('input[name="phone"]').closest('div').find('.text-error').hide();

        if(!isEmail(email)){
           $('input[name="email"]').closest('div').find('.text-error').text('Plesae enter valid email address').show()
        	 return false;
        }
        
        if(phone.length < 10 && phone.length > 18 ){
        	$('input[name="phone"]').closest('div').find('.text-error').text('Plesae enter valid phone number').show()
        }


        if( isEmpty(product_id) || isEmpty(name) || isEmpty(email) || isEmpty(phone) || isEmpty(payment_mode) ){
		  return false;
        }

         if(payment_mode == 'card' && $(this).attr('data-button-type') == 'payment'){
	      	  if(payment_mode == 'card'){
	         	 $('#cart-payment').modal('show');
	      	  }else{
	      	  	 $('#cart-payment').modal('hide');
	      	  }
         }

         if(payment_mode == 'paypal'){
         	 window.location.replace("{{route('paypal.payment')}}"+'?product_id='+product_id+'&name='+name+'&email='+email+'&phone='+phone+'&address='+address+'&payment_for=product&payment_mode=paypal');
         	 return false;
         }

         var button = document.querySelector('#buy-now');
				    braintree.dropin.create({
				      authorization: "{{ Braintree_ClientToken::generate() }}",
				      container: '#dropin-container'
				    }, function (createErr, instance) {
				      button.addEventListener('click', function () {				      	
				        instance.requestPaymentMethod(function (err, payload) {
				        	console.log(payload,' == err == ',err);
				        	if(typeof payload != 'undefined'){
				              nonce = payload.nonce;
				              data = { product_id , name , email , phone , address , payment_mode , nonce };
       	  
								$.ajax({
									"headers":{
									'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
								},
								'type':'POST',
								'url' : "{{route('product.order')}}",
								'data' : data,
								beforeSend: function() {

								},
								'success' : function(response){
						         if(response.status){
						             window.location.replace("{{route('confirm.order')}}"+'?id='+response.id);
						         }else{
						          	 window.location.replace("{{route('transaction_failed')}}");
						         }
							
								},
								'error' : function(error){
								console.log(error);
								},
								complete: function() {

								},
								});	
				        	}      	         
				        });
				      });
				    });

          if($(this).attr('data-button-type') == 'payment' && payment_mode != 'card' && payment_mode != 'paypal'){

       	  data = { product_id , name , email , address , phone , payment_mode };
       	  
			$.ajax({
				"headers":{
				'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
			},
			'type':'POST',
			'url' : "{{route('product.order')}}",
			'data' : data,
			beforeSend: function() {

			},
			'success' : function(response){
             
             if(response.status){
                 window.location.replace("{{route('confirm.order')}}"+'?id='+response.id);
             }else{
             	alert('False');
             }
		
			},
			'error' : function(error){
			console.log(error);
			},
			complete: function() {

			},
			});
			}	 

			});

		      function isEmpty(str) {
		        return (!str || 0 === str.length);
		      }

		      function isEmail(email) {
				  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				  return regex.test(email);
			  }

        });
 </script>
@endpush