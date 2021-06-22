<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Zainab Project | shopping website</title>
<link rel='stylesheet' href='{{ asset('site/css/woocommerce-layout.css') }}' type='text/css' media='all'/>
<link rel='stylesheet' href='{{ asset('site/css/woocommerce-smallscreen.css') }}' type='text/css' media='only screen and (max-width: 768px)'/>
<link rel='stylesheet' href='{{ asset('site/css/woocommerce.css') }}' type='text/css' media='all'/>
<link rel='stylesheet' href='{{ asset('site/css/font-awesome.min.css') }}' type='text/css' media='all'/>
<link rel='stylesheet' href='{{ asset('site/style.css') }}' type='text/css' media='all'/>
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Oswald:400,500,700%7CRoboto:400,500,700%7CHerr+Von+Muellerhoff:400,500,700%7CQuattrocento+Sans:400,500,700' type='text/css' media='all'/>
<link rel='stylesheet' href='{{ asset('site/css/easy-responsive-shortcodes.css') }}' type='text/css' media='all'/>
</head>
<body class="   woocommerce woocommerce-page">
<div id="page">
	<div class="container">

		
		@include('site.includes.header')
        
		@include('site.includes.alert')

		@yield('content')

	</div>
	<!-- .container -->

    @include('site.includes.footer')
	
</div>


<!-- #page -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src='{{ asset('site/js/jquery.js') }}'></script>
<script src='{{ asset('site/js/plugins.js') }}'></script>
<script src='{{ asset('site/js/scripts.js') }}'></script>
<script src='{{ asset('site/js/masonry.pkgd.min.js') }}'></script>
<script src='{{ asset('site/js/accordion.js') }}'></script>
<script src='{{ asset('site/js/tabs.js') }}'></script>
<script src='{{ asset('site/js/toggle.js') }}'></script>
<script src='{{ asset('site/js/validate.js') }}'></script>

{{-- custom js --}}
<script  type="text/javascript"  src='{{ asset('site/custom/site.js') }}'></script>




</body>
</html>