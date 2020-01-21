	<nav>
			<div class="site-menu">
				<ul>
					<li>
						<a href="{{route('home')}}">home</a>
					</li>
					<li>
						<a href="{{route('products')}}">products</a>
					</li>
					<li>
						<a href="{{route('services')}}">services</a>
					</li>
					<li>
						<a href="{{route('classes')}}">classes</a>
					</li>
				   @auth
					<li>
						<a href="{{route('my.account')}}">my account</a>
					</li>
					<li>
						<a href="{{ route('logout') }}" onclick="event.preventDefault();
						document.getElementById('logout-form').submit();">
						Logout
						</a>

						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</li>
      			   @endauth
      			   @guest()
				    <li>
					  <a href="{{route('register')}}">Register</a>
				 	</li>
					<li>
					  <a href="{{route('login')}}">Login</a>
				 	</li>
					@endguest
					<li>
						<a href="{{route('contact.us')}}">contact us</a>
					</li>
				</ul>
			</div>
		</nav>
		<header>
			<div class="container">
				<div class="row">
					<!--Logo-->
					<div class="col-6 col-md-4">
						<a href="{{route('home')}}" class="site-logo">
							<img src="{{asset('public/assets/frontend/')}}/images/logo.png">
						</a>
					</div>
					<!--Menu Burger-->
					<div class="col-6 col-md-8 text-right">
						<a href="javascript:void(0);" class="bell">
							<i class="fa fa-bell"></i>
							<span class="counter">2</span>
						</a>
						<a href="javascript:void(0);" class="toggle-btn nav-toggle">
							<span></span>
						</a>
					</div>
				</div>
			</div>
		</header>