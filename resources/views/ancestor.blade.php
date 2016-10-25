<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="туры в Грузию, путешествие по Грузии, мероприятия в Грузии, tours in Georgia, events in Georgia, travel in Georgia, ტურები საქართველოში, ივენთები საქართველოში" />
	<meta name="description" content="Tурагентство Geotourist, туры и мероприятия в Грузии, Tour agency Geotourist, tours and events in Georgia, ტურისიტული სააგენტო Geotourist-ი, ტურები და ივენთები საქართველოში. მოგზაურობა საქართველოში" />
	<title>@yield('title')</title>
	<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet"/>
	<link href="{{ asset('/css/main.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('/fonts/proxima.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('/css/slick.css') }}" rel="stylesheet" type="text/css"/>
	<!--<link href="{{ asset('/css/bootstrap-submenu.min.css') }}" rel="stylesheet" type="text/css"/>-->
	@if(App::getLocale() == "ge")
	<link href="{{ asset('/css/geStyle.css') }}" rel="stylesheet" type="text/css"/>
	@elseif(App::getLocale() == "en")
	<link href="{{ asset('/css/enStyle.css') }}" rel="stylesheet" type="text/css"/>
	@elseif(App::getLocale() == "ru")
	<link href="{{ asset('/css/ruStyle.css') }}" rel="stylesheet" type="text/css"/>
	@endif
	<link href="{{ asset('/img/favicon.ico') }}" rel="icon" type="image/ico"/>
	@yield('css')
	<!--[if lt IE 9]>
	<script src="{{ asset('https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js') }}"></script>
	<script src="{{ asset('https://oss.maxcdn.com/respond/1.4.2/respond.min.js') }}"></script>
	<![endif]-->
</head>
<body>
@yield("slider")
<header>
	<nav class="navbar" role="navigation">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar icon-bar-color"></span>
				<span class="icon-bar icon-bar-color"></span>
				<span class="icon-bar icon-bar-color"></span>
			</button>
			<div class="navbar-brand">
				<a href="{{ action('PagesController@index') }}">
					<img class="logo-img" src="{{ asset('/img/geotourist.png') }}"/>
				</a>
				<div class="flags-holder">
					<a class="lang-flag" href="{{lang_url('ge')}}" title="ქართული ენა"><img src="{{ asset('/img/geo-flag.png')}}"></a>
					<a class="lang-flag" href="{{lang_url('en')}}" title="English Language"><img src="{{ asset('/img/uk.png')}}"></a>
					<a class="lang-flag" href="{{lang_url('ru')}}" title="Русский Язык"><img src="{{ asset('/img/russia-flag.png')}}"></a>
					<br/>
					<span class="phone-nav">
					   <span class="glyphicon glyphicon-earphone top-menu-gl"></span>
					   <span class="top-men mu-contact">&nbsp;+995 551 65 44 44</span>
				   </span>
				</div>
			</div>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="{{ action('PagesController@index') }}" >{{ trans("main.home") }}</a></li>
				<li><a href="{{ action('PagesController@about') }}" >{{ trans("main.about") }}</a></li>
				<li class="dropdown">
					<a class="dropdown-toggle disabled" data-toggle="dropdown" href="{{ action("ToursController@showAllTours") }}">{{ trans("main.tours") }}
						<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="{{ action('ToursController@showExTours' )}}">{{ trans("main.exclousive") }}</a></li>
						<li><a href="{{ action('ToursController@showTours') }}">{{ trans("main.tours") }}</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle disabled" data-toggle="dropdown" href="{{ action('EventsController@index') }}">{{ trans("main.events") }}
						<span class="caret"></span></a>
					<ul class="dropdown-menu">
						@if(function_exists('getMenuTrans'))
							<?php $cat = getMenuTrans(); ?>
						@endif
						@if(isset($cat) && count($cat) > 0)
							@foreach($cat as $c)
								<li><a href='{{ action("EventsController@showCatgories", ["id" => $c->event_cat->id]) }}'>{{ $c->title }}</a></li>
							@endforeach
							<?php unset($cat); ?>
						@endif
					</ul>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle disabled" data-toggle="dropdown" href="{{ action("PagesController@showWholeGallery") }}">{{ trans("main.gallery") }}
						<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="{{ action("PagesController@toursGallery") }}">{{ trans("main.tours_gallery") }}</a></li>
						<li><a href="{{ action("PagesController@eventsGallery")  }}">{{ trans("main.events_gallery") }}</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans("main.services") }} <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="{{ action('CarsController@index') }}">{{ trans("main.car_rent") }}</a></li>
						<li><a href="{{ asset('http://www.fly.ge/ru/') }}" target="_blank">{{ trans("main.plane_tickets") }}</a></li>
					</ul>
				</li>
				<li><a href="{{ action('PagesController@contact') }}">{{ trans("main.contact") }}</a></li>
			</ul>
		</div>
	</nav>
</header>
<!----- content ----->
<div id="page">
	@yield('content')
</div>
<!----- end of content ----->
<div id="footer">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<div class="col-lg-3 company-desc">
					<img  class="geot-fl" src="{{ asset('/img/geotourist.png') }}" class="img-responsive"><!-- TOP.GE COUNTER CODE -->
					<!-- TOP.GE COUNTER CODE -->
					<div class="topgewr">
						<script language="JavaScript" type="text/javascript" src="//counter.top.ge/cgi-bin/cod?100+104405"></script>
						<noscript>
							<a target="_top" href="http://counter.top.ge/cgi-bin/showtop?104405">
								<img src="//counter.top.ge/cgi-bin/count?ID:104405+JS:false" border="0" alt="TOP.GE" /></a>
						</noscript>
					</div>
					<!-- / END OF TOP.GE COUNTER CODE -->
				</div>
				<div class="col-lg-4 col-lg-offset-1 social">
					<h1 class="contact_h1" style="font-size:1.3em">{{ trans("main.find_uz") }}</h1>
					<a target="_blank" href="https://www.facebook.com/geotoursistgeorgiantours/"><img src="{{ asset('/img/facebook32.png') }}"></a>
					<a target="_blank" href="http://vk.com/id234946723"><img src="{{ asset('/img/vk1.png') }}"></a>
					<a target="_blank" href="https://plus.google.com/107611953072084740662/posts"><img src="{{ asset('/img/googleplus32.png') }}"></a>
					<a target="_blank" href="https://twitter.com/Geotourist2"><img src="{{ asset('/img/twitter32.png') }}"></a>
					<a target="_blank" href="https://www.instagram.com/geotourist/"><img src="{{ asset('/img/instagram32.png') }}"></a>
					<a target="_blank" href="https://www.youtube.com/channel/UCAGDzDqpMKEsloFPrcM40WA"><img src="{{ asset('/img/youtube32.png') }}"></a>
				</div>
				<div class="col-lg-3 col-lg-offset-1">
					<h1 class="contact_h1" style="font-size:1.3em">{{ trans("main.contact_us") }}</h1>
					<ul class="list-unstyled contact">
						<li><span class="glyphicon glyphicon-map-marker"></span>&nbsp;&nbsp;&nbsp;{{ trans("main.address") }}</li>
						<li><span class="glyphicon glyphicon-time"></span>&nbsp;&nbsp;&nbsp;09:00 - 20:00</li>
						<li><span class="glyphicon glyphicon-phone"></span>&nbsp;&nbsp;&nbsp;+995 551 65 44 44</li>
						<li><span class="glyphicon glyphicon-earphone"></span>&nbsp;&nbsp;&nbsp;+995 322 30 82 08</li>
						<li><a class="mailto-link" href="mailto:info@geotourist.ge"><span class="glyphicon glyphicon-envelope"></span>&nbsp;&nbsp;&nbsp;info@geotourist.ge</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row bottom_div">
			<p class="text-center" style="font-size:1em">{{ trans("main.made") }}<a class="galaxy-studio" target="_blank" href="{{ url('http://www.galaxystudio.ge/') }}"> Galaxy Studio</a>{{ trans("main.end") }} &copy; 2016</p>
		</div>
	</div>
</div>
<a href="#0" class="cd-top"><span class="glyphicon glyphicon-chevron-up">Top</span></a>
<script src="{{ asset('/js/jquery-1.9.1.min.js') }}"></script>
<script src="{{ asset('/js/jquery-migrate-1.0.0.min.js') }}"></script>
<script src="{{ asset('/js/jquery_colors.js') }}"></script>
<script src="{{ asset('/js/slick.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<!--<script src="{{ asset('/js/bootstrap-submenu.min.js') }}"></script>-->
@yield("script")
<script src="{{ asset('/js/lib.js') }}"></script>
</body>
</html>