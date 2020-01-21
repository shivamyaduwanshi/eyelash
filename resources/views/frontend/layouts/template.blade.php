@extends('frontend.layouts.app')
@section('content')
  	<!--product details-->
	<section class="product-details my-account">
		<div class="container">
			<div class="navigation">
				<a href="index.html">Home</a> >
				<a href="my_account.html">My Account</a>
			</div>
			<div class="profile-details">
				<div class="profile">
					<img src="images/profile.jpg">
					<input type="file" name="">
					<i class="fa fa-camera"></i>
				</div>
				<div class="details">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<input type="text" class="form-control" value="Can Willamson" placeholder="Name" name="">
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<input type="email" class="form-control" value="Canwilliamson@gmail.com" placeholder="Email" name="">
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<input type="text" class="form-control" value="+12 345678978" placeholder="Number" name="">
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<input type="text" class="form-control" value="Sectore A-2 Lorem ipsum (4521023)" placeholder="Address" name="">
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
							<!--single-srvc-->
							<div class="col-md-6 col-sm-12 col-xs-12">
								<div class="single-srvc" data-toggle="modal" data-target="#order-details">
									<div class="date-strip">
										<h2><i class="fa fa-calendar"></i> <span>25-Aug-2019</span></h2>
									</div>
									<div class="warpper clearfix">
										<div class="img">
											<img src="images/03.jpg">
										</div>
										<div class="txt">
											<h2>Luxury Lashes</h2>
											<label>$150</label>
											<div class="border2"></div>
											<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
											
										</div>
									</div>
								</div>
							</div><!--end-->

							<!--single-srvc-->
							<div class="col-md-6 col-sm-12 col-xs-12">
								<div class="single-srvc ">
									<div class="date-strip">
										<h2><i class="fa fa-calendar"></i> <span>25-Aug-2019</span></h2>
									</div>
									<div class="warpper clearfix">
										<div class="img">
											<img src="images/03.jpg">
										</div>
										<div class="txt">
											<h2>Luxury Lashes</h2>
											<label>$150</label>
											<div class="border2"></div>
											<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
											
										</div>
									</div>
								</div>
							</div><!--end-->

							<!--single-srvc-->
							<div class="col-md-6 col-sm-12 col-xs-12">
								<div class="single-srvc">
									<div class="date-strip">
										<h2><i class="fa fa-calendar"></i> <span>25-Aug-2019</span></h2>
									</div>
									<div class="warpper clearfix">
										<div class="img">
											<img src="images/03.jpg">
										</div>
										<div class="txt">
											<h2>Luxury Lashes</h2>
											<label>$150</label>
											<div class="border2"></div>
											<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
											
										</div>
									</div>
								</div>
							</div><!--end-->

							<!--single-srvc-->
							<div class="col-md-6 col-sm-12 col-xs-12">
								<div class="single-srvc">
									<div class="date-strip">
										<h2><i class="fa fa-calendar"></i> <span>25-Aug-2019</span></h2>
									</div>
									<div class="warpper clearfix">
										<div class="img">
											<img src="images/03.jpg">
										</div>
										<div class="txt">
											<h2>Luxury Lashes</h2>
											<label>$150</label>
											<div class="border2"></div>
											<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
											
										</div>
									</div>
								</div>
							</div><!--end-->
						</div>
					</div>
				    </div>
				    <div id="classes" class="our-classes container tab-pane fade"><br>
				      	<div class="service-body">
					      	<div class="row">
								<!--single-srvc-->
								<div class="col-md-6 col-sm-12 col-xs-12">
									<div class="single-srvc" data-toggle="modal" data-target="#class-details">
										<div class="date-strip">
											<h2><i class="fa fa-calendar"></i> <span>25-Aug-2019</span></h2>
										</div>
										<div class="warpper clearfix">
											<div class="img">
												<img src="images/cap.png">
											</div>
											<div class="txt">
												<h2>Butterfly Lashes</h2>
												<label>$150</label>
												<div class="border2"></div>
												<ul>
													<li>
														<i class="fa fa-calendar"></i>
														<span>19-Nov-19</span> To
														<span>25-Nov-19</span>
													</li>
													<li>
														<i class="fa fa-clock-o"></i>
														<span>9AM:00</span> To 
														<span>3:00 Pm</span>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div><!--end-->
								<!--single-srvc-->
								<div class="col-md-6 col-sm-12 col-xs-12">
									<div class="single-srvc" data-toggle="modal" data-target="#class-details">
										<div class="date-strip">
											<h2><i class="fa fa-calendar"></i> <span>25-Aug-2019</span></h2>
										</div>
										<div class="warpper clearfix">
											<div class="img">
												<img src="images/cap.png">
											</div>
											<div class="txt">
												<h2>Butterfly Lashes</h2>
												<label>$150</label>
												<div class="border2"></div>
												<ul>
													<li>
														<i class="fa fa-calendar"></i>
														<span>19-Nov-19</span> To
														<span>25-Nov-19</span>
													</li>
													<li>
														<i class="fa fa-clock-o"></i>
														<span>9AM:00</span> To 
														<span>3:00 Pm</span>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div><!--end-->
								<!--single-srvc-->
								<div class="col-md-6 col-sm-12 col-xs-12">
									<div class="single-srvc" data-toggle="modal" data-target="#class-details">
										<div class="date-strip">
											<h2><i class="fa fa-calendar"></i> <span>25-Aug-2019</span></h2>
										</div>
										<div class="warpper clearfix">
											<div class="img">
												<img src="images/cap.png">
											</div>
											<div class="txt">
												<h2>Butterfly Lashes</h2>
												<label>$150</label>
												<div class="border2"></div>
												<ul>
													<li>
														<i class="fa fa-calendar"></i>
														<span>19-Nov-19</span> To
														<span>25-Nov-19</span>
													</li>
													<li>
														<i class="fa fa-clock-o"></i>
														<span>9AM:00</span> To 
														<span>3:00 Pm</span>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div><!--end-->
								<!--single-srvc-->
								<div class="col-md-6 col-sm-12 col-xs-12">
									<div class="single-srvc" data-toggle="modal" data-target="#class-details">
										<div class="date-strip">
											<h2><i class="fa fa-calendar"></i> <span>25-Aug-2019</span></h2>
										</div>
										<div class="warpper clearfix">
											<div class="img">
												<img src="images/cap.png">
											</div>
											<div class="txt">
												<h2>Butterfly Lashes</h2>
												<label>$150</label>
												<div class="border2"></div>
												<ul>
													<li>
														<i class="fa fa-calendar"></i>
														<span>19-Nov-19</span> To
														<span>25-Nov-19</span>
													</li>
													<li>
														<i class="fa fa-clock-o"></i>
														<span>9AM:00</span> To 
														<span>3:00 Pm</span>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div><!--end-->
							</div>
				      	</div>
				    </div>
				    <div id="appointment" class="appointment container tab-pane fade"><br>
				     	<div class="service-body">
					      	<div class="row">
								<!--single-srvc-->
								<div class="col-md-6 col-sm-12 col-xs-12">
									<div class="single-srvc" data-toggle="modal" data-target="#appointment-details">
										<div class="date-strip">
											<h2><i class="fa fa-calendar"></i> <span>25-Aug-2019</span></h2>
										</div>
										<div class="warpper clearfix">
											<div class="img">
												<img src="images/05.jpg">
											</div>
											<div class="txt">
												<h2>Butterfly Lashes</h2>
												<ul>
													<li>
														<i class="fa fa-calendar"></i>
														<span>19-Nov-19</span> To
														<span>25-Nov-19</span>
													</li>
													<li>
														<i class="fa fa-clock-o"></i>
														<span>9AM:00</span> To 
														<span>3:00 Pm</span>
													</li>
												</ul>
												<label>Total Amount: $150</label>
											</div>
										</div>
									</div>
								</div><!--end-->
								<!--single-srvc-->
								<div class="col-md-6 col-sm-12 col-xs-12">
									<div class="single-srvc" data-toggle="modal" data-target="#class-details">
										<div class="date-strip">
											<h2><i class="fa fa-calendar"></i> <span>25-Aug-2019</span></h2>
										</div>
										<div class="warpper clearfix">
											<div class="img">
												<img src="images/05.jpg">
											</div>
											<div class="txt">
												<h2>Butterfly Lashes</h2>
												<ul>
													<li>
														<i class="fa fa-calendar"></i>
														<span>19-Nov-19</span> To
														<span>25-Nov-19</span>
													</li>
													<li>
														<i class="fa fa-clock-o"></i>
														<span>9AM:00</span> To 
														<span>3:00 Pm</span>
													</li>
												</ul>
												<label>Total Amount: $150</label>
											</div>
										</div>
									</div>
								</div><!--end-->
								<!--single-srvc-->
								<div class="col-md-6 col-sm-12 col-xs-12">
									<div class="single-srvc" data-toggle="modal" data-target="#class-details">
										<div class="date-strip">
											<h2><i class="fa fa-calendar"></i> <span>25-Aug-2019</span></h2>
										</div>
										<div class="warpper clearfix">
											<div class="img">
												<img src="images/05.jpg">
											</div>
											<div class="txt">
												<h2>Butterfly Lashes</h2>
												<ul>
													<li>
														<i class="fa fa-calendar"></i>
														<span>19-Nov-19</span> To
														<span>25-Nov-19</span>
													</li>
													<li>
														<i class="fa fa-clock-o"></i>
														<span>9AM:00</span> To 
														<span>3:00 Pm</span>
													</li>
												</ul>
												<label>Total Amount: $150</label>
											</div>
										</div>
									</div>
								</div><!--end-->
								<!--single-srvc-->
								<div class="col-md-6 col-sm-12 col-xs-12">
									<div class="single-srvc" data-toggle="modal" data-target="#class-details">
										<div class="date-strip">
											<h2><i class="fa fa-calendar"></i> <span>25-Aug-2019</span></h2>
										</div>
										<div class="warpper clearfix">
											<div class="img">
												<img src="images/05.jpg">
											</div>
											<div class="txt">
												<h2>Butterfly Lashes</h2>
												<ul>
													<li>
														<i class="fa fa-calendar"></i>
														<span>19-Nov-19</span> To
														<span>25-Nov-19</span>
													</li>
													<li>
														<i class="fa fa-clock-o"></i>
														<span>9AM:00</span> To 
														<span>3:00 Pm</span>
													</li>
												</ul>
												<label>Total Amount: $150</label>
											</div>
										</div>
									</div>
								</div><!--end-->
							</div>
				      	</div>
				  </div>
			</div>
		</div>
	</section><!--end-->
@endsection