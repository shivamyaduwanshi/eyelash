	<title>{{env('APP_NAME')}} | @section('title') @show</title>
	<meta charset="UTF-8">
	<meta name="keywords" content="codemeg, home">
	<meta name="author" content="Codemeg Solution Pvt. Ltd., info@codemeg.com">
	<meta name="url" content="http://codemeg.com">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<!--css-->
	<link rel="stylesheet" type="text/css" href="{{asset('public/assets/frontend/')}}/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset('public/assets/frontend/')}}/css/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset('public/assets/frontend/')}}/css/style.css">
	<link rel="stylesheet" type="text/css" href="{{asset('public/assets/frontend/')}}/css/responsive.css">
	<!--font awesome 4-->
	<link rel="stylesheet" type="text/css" href="{{asset('public/assets/frontend/')}}/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.css">