@extends("ancestor")

@section("title") {{ trans("events.title") }} @endsection

@section("css")
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/events.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/specTours.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/swiper.min.css')}}">
@endsection

@section("content")
	@if(isset($pics) && count($pics) > 0)
		<div id="myCarousel" class="carousel slide bt-carousel" data-interval="3000" data-ride="carousel">
			<ol class="carousel-indicators">
				@for($i = 0; $i < count($pics); $i++)
					@if($i==0)
						<li data-target="#myCarousel" data-slide-to="0" class="active img-responsive"></li>
					@else
						<li data-target="#myCarousel" class="img-responsive" data-slide-to="{{ $i }}"></li>
					@endif
				@endfor
			</ol>
			<div class="carousel-inner">
				@for($i = 0; $i < count($pics); $i++)
					@if($i == 0)
						<div class="item active">
							<img src="{{ asset($pics[$i]["path"]) }}">
						</div>
					@else
						<div class="item">
							<img src="{{ asset($pics[$i]["path"]) }}">
						</div>
					@endif
				@endfor
			</div>
			<a class="carousel-control left" href="#myCarousel" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
			</a>
			<a class="carousel-control right" href="#myCarousel" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
			</a>
		</div>
	@endif
	<div class="content-events">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
					<div class="container-fluid upcoming-events">
						@if(isset($upcoming) && count($upcoming) > 0)
							<h1 class="up-event-h1 text-center">{{ trans("events.upcome") }}</h1>
							<div class="container-fluid">
								<div class="row excl-tour" style="overflow: hidden;">
									<div class="silk-slider">
										@foreach($upcoming as $tr)
											@for($i = 0; $i < count($tr->event_trans); $i++)
												@if($tr->event_trans[$i]->lang->lang == App::getLocale())
													<div class="slider-holder">
														<div class="col-sm-12 col-md-12 col-lg-12 tour-wrapper">
															<div class="col-xs-12 col-sm-5 col-md-5 col-lg-5 tour-wrapper-image ev-img no-padding">
																<a href="{{ action('EventsController@show', ["id" => $tr->id]) }}" class="lst-img-wr" style="background-image: url({{ asset($tr->paralax_img) }})">
																	{{--<img src="{{ asset($tr->list_img) }}" class="img-responsive">--}}
																</a>
															</div>
															<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 tour-wrapper-text">
																<h1>{{ $tr->event_trans[$i]->title }}</h1>
																<p>{!! $tr->event_trans[$i]->short_body !!}</p>
															</div>
															<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 tour-wrapper-desc">
																<div class="event-block-hg">
																@if(($mark = getEventStarts($tr->id)) > 0)
																	<span class="stars">
																	@for($i = 1; $i <= $mark; $i++)
																		<span class="glyphicon glyphicon-star"></span>
																	@endfor
																	</span>
																@endif
																@if(!empty($tr->price))
																	<p class="price">{{ $tr->price }}</p>
																	<p class="perperson">{{ trans("main.per-per") }}</p>
																@endif
																</div>
																<a href="{{ action('EventsController@show', ["id" => $tr->id]) }}" class="tour-button text-center">{{ trans("main.view-more") }}</a>
															</div>
														</div>
													</div>
												@endif
											@endfor
										@endforeach
									</div>
								</div>
							</div>
						@endif
					</div>
					<div class="container-fluid ev-txt">
						@if(isset($texts) && count($texts) > 0)
							<div class="row events-main-text">
								<h1 class="text-center">{{ trans("events.title") }}</h1>
								@if(App::getLocale() == "en")
									<p class="events-top-text">{{ $texts[0]->en_main_text or null }}</p>
								@elseif(App::getLocale() == "ge")
									<p class="events-top-text">{{ $texts[0]->ge_main_text or null }}</p>
								@elseif(App::getLocale() == "ru")
									<p class="events-top-text">{{ $texts[0]->ru_main_text or null }}</p>
								@endif
							</div>
						@endif
						<div class="row swp-wrapper">
							<div class="swiper-container">
								<div class="swiper-wrapper">
									@if(isset($cat) && count($cat) > 0)
										@foreach($cat as $c)
											<div class="swiper-slide">
												<div class="swip-bg-div" style="background-image: url({{ asset($c->img) }});">
													<a href="{{ action("EventsController@showCatgories", ["id" => $c->id ]) }}" class="swip-link">
														@foreach($c->event_cat_trans as $tr)
															@if($tr->lang->lang == App::getLocale())
																<div class="swp-headline showMe"><p id="swp-text">{{ $tr->title }}</p></div>
															@endif
														@endforeach
													</a>
												</div>
											</div>
										@endforeach
									@endif
								</div>
								<div class="swiper-pagination"></div>
							</div>
						</div>
					</div>
					<div class="container-fluid">
						<div class="row festivals-wrapper">
							@if(isset($cat) && count($cat) > 0)
								@foreach($cat as $c)
									@if($c->category == 'Festivals')
										@foreach($c->event_cat_trans as $trans)
											@if($trans->lang->lang == App::getLocale())
												<h2 class="text-center festivals-head">{{$trans->title}}</h2>
											@endif
										@endforeach
									@endif
								@endforeach
							@endif
						</div>
						<div class="row">
							@if(isset($events) && count($events) > 0)
								<?php $i = 0; ?>
								@foreach($events as $event)
									@if($event->cat->category == "Festivals")
										<?php  if($i > 5) break; ?>
										<div class="col-sm-6 col-md-4 col-lg-4 no-padding">
											<div style="background: url({{ asset($event->paralax_img)}}) no-repeat; height:300px; background-size: cover; background-position: center center; margin: 1px;">
												<a href="{{ action("EventsController@show", ["id" => $event->id]) }}" class="box overlay">
													@foreach($event->event_trans as $tr)
														@if($tr->lang->lang == App::getLocale())
															<span class="image-caption img-cp">{{ $tr->title }}</span>
														@endif
													@endforeach
												</a>
											</div>

										</div>
										<?php $i++ ?>
									@endif
								@endforeach
							@endif
						</div>
					</div>
					<div class="container-fluid">
						<div class="row">
							@if(isset($cat) && count($cat) > 0)
								@foreach($cat as $c)
									@if($c->category == 'Wedding')
										@foreach($c->event_cat_trans as $trans)
											@if($trans->lang->lang == App::getLocale())
												<h2 class="text-center weeding-h1">{{$trans->title}}</h2>
											@endif
										@endforeach
									@endif
								@endforeach
							@endif
						</div>
					</div>
					<div class="container-fluid events-last-cont">
                           <div class="row">
                               <div class="slc-sld">
                                   @foreach($events as $tour)
                                       @for($i = 0; $i < count($tour->event_trans); $i++)
                                          @if($tour->event_trans[$i]->lang->lang == App::getLocale() && $tour->cat->category == "Wedding") 
                                               <div class="col-sm-12 col-md-12 col-lg-12 tour-wrapper">
                                                       <div class="col-sm-4 col-md-4 col-lg-4 tour-wrapper-image no-padding">
                                                           <a href="{{ action('EventsController@show', ["id" => $tour->id]) }}" style="background-image: url({{ asset($tour->paralax_img) }})" class="lst-img-wr">
                                                           </a>
                                                       </div>
                                                       <div class="col-sm-5 col-md-5 col-lg-5">
                                                           <div class="tour-txt-fx-wd">
                                                               <h2 class="tour-h2-new">{{ $tour->event_trans[$i]->title }}</h2>
                                                               <p>{!! $tour->event_trans[$i]->short_body !!}</p>
                                                           </div>
                                                       </div>
                                                       <div class="col-sm-3 col-md-3 col-lg-3 txt-wrapper">
                                                           <div class="txt-wt-link">
                                                               @if(($mark = getEventStarts($tour->id)) > 0)
                                                                   <span class="stars">
                                                                        @for($i = 1; $i <= $mark; $i++)
                                                                           <span class="glyphicon glyphicon-star"></span>
                                                                       @endfor
                                                                    </span>
                                                               @else
                                                                   <span class="glyphicon glyphicon-star" style="color: transparent; text-shadow: 0px 0px 3px rgba(224, 224, 224, 1);"></span>
                                                                   <span class="glyphicon glyphicon-star" style="color: transparent; text-shadow: 0px 0px 3px rgba(224, 224, 224, 1);"></span>
                                                                   <span class="glyphicon glyphicon-star" style="color: transparent; text-shadow: 0px 0px 3px rgba(224, 224, 224, 1);"></span>
                                                                   <span class="glyphicon glyphicon-star" style="color: transparent; text-shadow: 0px 0px 3px rgba(224, 224, 224, 1);"></span>
                                                                   <span class="glyphicon glyphicon-star" style="color: transparent; text-shadow: 0px 0px 3px rgba(224, 224, 224, 1);"></span>
                                                               @endif
                                                               @if(count($tour->reviews) > 0)
                                                                   <div class="rev-count">
                                                                       <span>{{ count($tour->reviews) }}</span>
                                                                       <span class="revcount-sp">{{ (count($tour->reviews) > 1 ? trans("main.revcounts") : trans("main.revcount")) }}</span>
                                                                   </div>
                                                               @else
                                                                   <div class="rev-count">
                                                                       <span class="revcount-sp">0 {{ trans("main.revcount") }}</span>
                                                                   </div>
                                                               @endif
                                                               @if(!empty($tour->price))
                                                                   <div class="price-new">
                                                                       <span class="price-is">{{ $tour->price }}</span><br>
                                                                       <span class="price-per">{{ trans("main.per-per") }}</span>
                                                                   </div>
                                                               @endif
                                                           </div>
                                                           <div class="link-wr">
                                                               <a href="{{ action('EventsController@show', ["id" => $tour->id]) }}" class="tour-button text-center">{{ trans("main.view-more") }}</a>
                                                           </div>
                                                       </div>
                                                   </div>
                                           @endif
                                       @endfor
                                   @endforeach
                                   </div>
                           </div>
                        </div>
				</div>
				<div class="events-ads-wrapper">
					@include("ad", ["margs" => "marg"])
				</div>
			</div>
		</div>
	</div>

@endsection

@section("script")
	<script src="{{ asset('/js/swiper.min.js') }}"></script>
	<script src="{{ asset('/js/swiper.jquery.min.js') }}"></script>
@endsection