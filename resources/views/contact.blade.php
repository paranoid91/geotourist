@extends("ancestor")

@section("title") {{ trans('contact.title') }} @endsection

@section("css")
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/contact.css') }}">
@endsection

@section("content")
	<div class="container">
		<div class="row">
			<div id="content-contact">
				@include("errors/errors")
				@if(session('msg'))
					<div class="alert alert-success text-center"><h4>{{ trans("contact.msg") }}</h4></div>
				@endif
				<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
					<div class="container-fluid">
						<div class="row h1-icons">
							<div class="col-lg-6 contact-head-texts">
								<h1>{{ trans('contact.contact_us') }}</h1>
								<p class="cont-p-text">{{ trans('contact.work_time') }} 09:00 - 21:00</p>
								<p class="working-days">{{ trans("contact.work-sch") }}</p>
							</div>
							<div class="col-lg-5 col-lg-offset-1">
								<div class="contact-sc-icons">
									<h1>{{ trans('contact.find_us') }}</h1>
									<a class="soc-net-icon" target="_blank" href="https://www.facebook.com/geotoursistgeorgiantours/"><img src="{{ asset('/img/facebook500.png') }}"/></a>
									<a class="soc-net-icon" target="_blank" href="https://vk.com/id234946723"><img src="{{ asset('/img/vk.png') }}"/></a>
									<a class="soc-net-icon" target="_blank" href="https://www.instagram.com/geotourist/"><img src="{{ asset('/img/instagram.png') }}"/></a><br>
									<a class="soc-net-icon" target="_blank" href="https://plus.google.com/107611953072084740662/posts"><img src="{{ asset('/img/googleplus.png') }}"/></a>
									<a class="soc-net-icon" href="https://www.youtube.com/channel/UCAGDzDqpMKEsloFPrcM40WA" target="_blank"><img src="{{ asset('/img/youtube.png') }}"/></a>
									<a class="soc-net-icon" target="_blank" href="https://twitter.com/Geotourist2"><img src="{{ asset('/img/twitter.png') }}"/></a>
								</div>
							</div>
						</div>
					</div>
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-5 col-md-6 col-lg-6">
								<iframe class="google-map" src="{{ URL::asset('https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2977.77021223739!2d44.77727708813877!3d41.725477100000006!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb00cfe8627537ddc!2sGeoTourist!5e0!3m2!1ska!2s!4v1456569275734')}}" frameborder="0" allowfullscreen></iframe>
							</div>
							<div class="col-sm-7 col-md-6 col-lg-6">
								<div class="contact-form">
									<form class="form-inline" method="POST" accept-charset="UTF-8" action="{{ action('PagesController@sendEmail') }}">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<div class="form-group">
											<label class="sr-only" for="name">{{ trans('contact.name') }}</label>
											<input type="text" class="form-control" name="username" placeholder="{{ trans('contact.name') }}" required/>
											<label class="sr-only" for="email">{{ trans('contact.email') }}</label>
											<input type="email" class="form-control sec-input" name="email" placeholder="{{ trans('contact.email') }}" required/>
											<label class="sr-only" for="subject">{{ trans('contact.subject') }}</label>
											<input type="text" class="form-control sec-input" name="subject" placeholder="{{ trans('contact.subject') }}" required/>
										</div>
										<textarea class="form-control textar" rows="3" name="mail_text" placeholder="{{ trans('contact.type_text') }}"></textarea>
										<input type="submit" class="btn btn-default btn-lg btn-block sub-but" value="{{ trans('contact.submit') }}"/>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="container-fluid big-icons">
						<div class="row">
							<div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1 gl-icons">
								<div class="col-sm-4 col-md-4 col-lg-4 icon-holder">
									<span class="glyphicon glyphicon-map-marker glyph"></span>
									<p class="gl-icons-desc">{{ trans('contact.address') }}</p>
								</div>
								<div class="col-sm-4 col-md-4 col-lg-4 icon-holder">
									<span class="glyphicon glyphicon-earphone glyph"></span>
									<p class="gl-icons-desc">+995 551 65 44 44</p>
								</div>
								<div class="col-sm-4 col-md-4 col-lg-4 icon-holder">
									<span class="glyphicon glyphicon-envelope glyph"></span>
									<p class="gl-icons-desc">info@geotourist.ge</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				@include("ad", ["class" => "contact-ad-inc"])
			</div>
		</div>
	</div>
@endsection