<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf_token" content="{{ csrf_token() }}">
	<title>Geo Tourists</title>
	<link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/summernote.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/admin-styles.css') }}" rel="stylesheet">
	<link href="{{ asset('/img/favicon.ico') }}" rel="icon" type="image/ico"/>
	@yield('css')
	<!--[if lt IE 9]>
	  <script src="{{ asset('https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js') }}"></script>
	  <script src="{{ asset('https://oss.maxcdn.com/respond/1.4.2/respond.min.js') }}"></script>
	<![endif]-->
	<script src="{{ asset('/js/jquery-1.9.1.min.js') }}"></script>
	<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('/js/lumino.glyphs.js') }}"></script>
	<script src="{{ asset('/js/slib.js') }}"></script>
	<script src="{{ asset('/js/bootbox.min.js') }}"></script>
        <script src="{{ asset('/js/summernote.min.js') }}"></script>
  <style type="text/css">
     .note-editable, .panel-body{
        min-height:300px;
     	max-height:400px;
     }
  </style>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ url("{lang}/admin") }}"><span>Geo</span>Tourist</a>
			<ul class="user-menu">
				<li class="dropdown pull-right">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> User <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="{{ action('Auth\AuthController@getLogout') }}"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>		
	</div>
</nav>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
	<ul class="nav menu">
		<li class="parent">
			<a href="#">
				<span data-toggle="collapse" href="#sub-item-1" class="sidebar-glyph"><span class="glyphicon glyphicon-picture" data-toggle="collapse" href="#sub-item-1" ></span>
				ტურები</span>
			</a>
			<ul class="children collapse" id="sub-item-1">
				<li>
					<a class="" href="{{ action('AdminToursController@index',['type' => 0]) }}">
						<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>ჩვეულებრივი ტურები
					</a>
				</li>
				<li>
					<a class="" href="{{ action('AdminToursController@index',['type' => 1]) }}">
						<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>ექსკლუზიური ტურები
					</a>
				</li>
			</ul>
		</li>
		<li><a href="{{ action("AdminEventsController@index") }}"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> ივენთები</a></li>
		<li class="parent">
			<a href="#">
				<span data-toggle="collapse" href="#sub-item-2" >
					<span data-toggle="collapse" href="#sub-item-2" ></span>
					<svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg>
				გვერდები</span>
			</a>
			<ul class="children collapse" id="sub-item-2">
				<li>
					<a class="" href="{{ action('AdminController@mainPage') }}">
						<svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg>მთავარი გვერდი
					</a>
					<a class="" href="{{ action('AdminController@galleryPage') }}">
						<svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg>გალერეა
					</a>
					<a class="" href="{{ action('AdminController@aboutPage') }}">
						<svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg>ჩვენს შესახებ
					</a>
				</li>
			</ul>
		</li>
		<li><a href="{{ action("AdminCarsController@index") }}"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg>მანქანები</a></li>
		<li><a href="{{ action("AdminController@placesIndex") }}"><svg class="glyph stroked star"><use xlink:href="#stroked-star"></use></svg>პოპ. ადგილები</a></li>
		<li class="parent">
			<a href="#">
				<span data-toggle="collapse" href="#sub-item-5" class="sidebar-glyph"><span class="glyphicon glyphicon-pencil" data-toggle="collapse" href="#sub-item-5" ></span>
				კომენტარების წაშლა</span>
			</a>
			<ul class="children collapse" id="sub-item-5">
				<li>
					<a class="" href="{{ action('AdminToursController@showAllToursFilter') }}">
						<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>ტურების კომ.
					</a>
				</li>
				<li>
					<a href="{{ action('AdminEventsController@showAllToursFilter') }}">
						<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg>ივენთების კომ.
					</a>
				</li>
			</ul>
		</li>
		<li><a href="{{ action("AdminController@showMails") }}"><svg class="glyph stroked email"><use xlink:href="#stroked-email"></use></svg>მეილები</a></li>
	</ul>
</div>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
			<li class="active">ადმინ პანელი</li>
		</ol>
	</div>
	@yield("content")
</div>
@yield("script")
</body>
</html>