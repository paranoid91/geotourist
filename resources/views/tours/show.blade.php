@extends("ancestor")

@section('title') {{ trans("tours.title") }} @endsection

@section("css")
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{ asset('/css/tours_desc.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/css/jssor.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/css/jquery.mCustomScrollbar.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/css/star-rating.css') }}" media="all" rel="stylesheet" type="text/css" />
<link href="{{ asset('/css/theme-krajee-svg.css') }}" media="all" rel="stylesheet" type="text/css" />
<link href="{{ asset('/css/animate.css') }}" rel="stylesheet" type="text/css"/>

   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link href="{{ asset('/css/bootstrap-social.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/login.css') }}" rel="stylesheet" type="text/css" />
<style>

.new-commerc{
    width:220px;
-webkit-box-shadow: 0px 0px 7px 0px rgba(79,79,79,1);
-moz-box-shadow: 0px 0px 7px 0px rgba(79,79,79,1);
box-shadow: 0px 0px 7px 0px rgba(79,79,79,1);
}

.ad-texts{
    bottom:0
}

@if(empty($tour->price))
   .ad-main-style{
      margin-top:180px !important;
}
@endif

	@media only screen and (max-width: 1240px) and (min-width:1200px) {
		.new-commerc{
			width:100%;
		}
	}
@media only screen and (max-width: 1200px){
.ad-texts{
    top:140px;
}
.new-commerc{
    margin-left:4%
}

@if(empty($tour->price))
   .ad-main-style{
      margin-top:auto !important;
}

@endif

}
@media only screen and (min-width: 992px){
      .ad-main-style{
           box-shadow: 0 0 0 0 transparent;
           -webkit-box-shadow: 0 0 0 0 transparent;
      }

}

@media only screen and (max-width: 992px){
      .ad-main-style{
           background: 0 0 0 0 transparent;
      }

}
</style>
@endsection

@section("content")
	@foreach($tour->tour_trans as $tr)
		@if($tr->lang_id == $lang[0]->id)
<div class="parallax-window" data-parallax="scroll" data-natural-height="800" data-position="0 0" data-image-src="{{ asset($tour->paralax_img) }}">
			<!--<div class="parallax-window" data-parallax="scroll">-->
				<div class="animated bounceInDown">
					<h1>{{ $tr->title }}</h1>
					@if(($mark = getTourStarts($tour->id)) > 0)
						<span class="stars">
							@for($i = 1; $i <= $mark; $i++)
								<span class="glyphicon glyphicon-star"></span>
							@endfor
						</span>
					@endif
				</div>
			</div>
			<div class="container content-tours-desc">
				@if(!empty($tour->price))
					<div class="price-wrap text-center">
						<div class="price-price">
							<span class="glyphicon glyphicon-tags"></span>&nbsp;&nbsp;{{ $tour->price }}
						</div>
						<div class="price-wrap-txt">
							{{ trans("main.per-per") }}
						</div>
                                                @if($tour->tour_type == 1)
						<div class="price-decoration__label-round" style="background-color:#eb4293">
							<span class="sp-circle">{!! trans("main.sp-circle") !!}</span>
						</div>
						@endif	
					</div>
				@endif
				<div class="row">
					<div class="col-lg-10">
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#sectionA">{{ trans("tours.title") }} </a></li>
							@if($tour->tour_type == 0)
								@if($tr->d3 && $tr->d3_num != 0)
									<li><a data-toggle="tab" href="#sectionC">{{$tr->d3_num}} {{ trans("tours.day") }}</a></li>
								@endif
								@if($tr->d7 && $tr->d7_num != 0)
									<li><a data-toggle="tab" href="#sectionD">{{$tr->d7_num}} {{ trans("tours.day") }}</a></li>
								@endif
								@if($tr->d10 && $tr->d10_num != 0)
									<li><a data-toggle="tab" href="#sectionE">{{$tr->d10_num}} {{ trans("tours.day") }}</a></li>
								@endif
							@elseif($tour->tour_type == 1)
								@if($tr->d10)
									@if(!is_null($tour->sp_tour_num ) && $tour->sp_tour_num != 0)
										<li><a data-toggle="tab" href="#sectionE">{{ $tour->sp_tour_num }} {{ trans("tours.day") }}</a></li>

									@endif
								@endif
							@endif
							@if(count($tour->tour_gallery)>0)
								<li><a data-toggle="tab" href="#sectionF">{{ trans("events.gallery") }} </a></li>
							@endif
							@if(($tour->tour_videos) && (count($tour->tour_videos) > 0))
								<li><a data-toggle="tab" href="#sectionG">{{ trans("events.videos") }}</a></li>
							@endif
						</ul>
						<div class="tab-content">
							<div id="sectionA" class="tab-pane fade in active tab-pane-holder">
								<div class="rm-mrg row no-padding">
									<div class="col-lg-12 main-text-holder">
										<div class="col-lg-4">
											<img src="{{ asset($tour->list_img) }}" class="img-responsive main-text-holder-img">
										</div>
										<div class="col-lg-8 mCustomScrollbar" data-mcs-theme="dark">
											<h1 class="tour-desc-h1">{{ $tr->title }}</h1>
											<p class="desc-main-text" >
											<div class="container-fluid">
												{!! $tr->body !!}
											</div>
											</p>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 table-holder">
										<table class="table table-striped table-hover">
											<tbody>
											@if($tr->location)
												<tr>
													<td class="tb-key">{{ trans("tours.loc") }}</td>
													<td class="tb-value">{{ $tr->location }}</td>
												</tr>
											@endif
											@if($tr->depture_time)
												<tr>
													<td class="tb-key">{{ trans("tours.dep") }}</td>
													<td class="tb-value">{{ $tr->depture_time }}</td>
												</tr>
											@endif
											@if($tr->return_time)
												<tr>
													<td class="tb-key">{{ trans("tours.ret") }}</td>
													<td class="tb-value">{{ $tr->return_time }}</td>
												</tr>
											@endif
											</tbody>
										</table>
									</div>
								</div>
							</div>
							@if($tour->tour_type == 0)
								@if($tr->d3)
									<div id="sectionC" class="tab-pane fade">
										<div class="container-fluid">
											{!! $tr->d3 !!}
										</div>
									</div>
								@endif
								@if($tr->d7)
									<div id="sectionD" class="tab-pane fade">
										<div class="container-fluid">
											{!! $tr->d7 !!}
										</div>
									</div>
								@endif
								@if($tr->d10)
									<div id="sectionE" class="tab-pane fade">
										<div class="container-fluid">
											<div class="col-lg-12">
												{!! $tr->d10 !!}
											</div>
										</div>
									</div>
								@endif
							@endif
							@if($tour->tour_type == 1)
								<div id="sectionE" class="tab-pane fade">
									<div class="container-fluid">
										{!! $tr->d10 !!}
									</div>
								</div>
							@endif
							@if(count($tour->tour_gallery)>0)
								<div id="sectionF" class="tab-pane fade">
									<div class="jssor-sl">
										<div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 960px; height: 480px; overflow: hidden; visibility: hidden; background-color: #24262e;">
											<div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
												<div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
												<div style="position:absolute;display:block;background:url('img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
											</div>
											<div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 240px; width: 720px; height: 480px; overflow: hidden;">
												@foreach($tour->tour_gallery as $pic)
													@if(is_file(public_path() . $pic->path) && file_exists(public_path() . $pic->path))
														<div data-p="150.00" style="display: none;">
															<img data-u="image" src="{{ $pic->path }}" />
															<img data-u="thumb" src="{{ $pic->path }}" />
														</div>
													@endif
												@endforeach
											</div>
											<div data-u="thumbnavigator" class="jssort01-99-66" style="position:absolute;left:0px;top:0px;width:240px;height:480px;" data-autocenter="2">
												<div data-u="slides" style="cursor: default;">
													<div data-u="prototype" class="p">
														<div class="w">
															<div data-u="thumbnailtemplate" class="t"></div>
														</div>
														<div class="c"></div>
													</div>
												</div>
											</div>
										</div>
										<span data-u="arrowleft" class="jssora05l" style="top:158px;left:248px;width:40px;height:40px;" data-autocenter="2"></span>
										<span data-u="arrowright" class="jssora05r" style="top:158px;right:8px;width:40px;height:40px;" data-autocenter="2"></span>
									</div>
								</div>
							@endif
							@if($tour->tour_videos && count($tour->tour_videos)>0)
								<div id="sectionG" class="tab-pane fade">
									<div class="row no-margin ifr-holder">
										@foreach($tour->tour_videos->all() as $video)
											<iframe src="{{ $video->src }}" frameborder="0" class="iframe-block" allowfullscreen></iframe>
										@endforeach
									</div>
								</div>
							@endif
							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
										<div class="container-fluid reviews-wrapper no-padding">
											<div class="row review-holder">
												<h1 class="text-center">{{ trans("tours.rew") }} </h1>
												<div class="row comments-wrap">
													<div class="col-lg-10">
													@include("errors/errors")
														<form class="com-form rew-form" method="POST" data-form-id="{{ $tour->id }}" action="{{ action('Auth\AuthController@handleComment') }}">
															{{ csrf_field() }}
															<h3>{{ trans("main.ratn") }}</h3>
															<input id="input-rat" data-size="sm" class="rating rating-loading" data-min="0" data-max="5" data-step="1">
															<input type="hidden" value="0" class="hidden-rate" name="user_rate" />
															<input type="hidden" value="tour" name="bel_to" />
															<input type="hidden" value="{{ $tour->id }}" name="data_id" />
															<div class="form-group com-wrapper">
																<textarea name="user_comment" class="form-control comment-txt-ar" rows="10">{{ old('user_comment') }}</textarea>
															</div>
															<div class="form-group com-wrapper">
																<input type="submit" class="btn btn-default btn-comment" value="{{ trans("main.submit") }}">
															</div>
														</form>
													</div>
												</div>


			@if(!session('user') and !session('soc_type'))
            <div class="form-group login-wrap" style="margin:20px 0 0 15px; display:none">
                <a class="soc-bt-log btn btn-social btn-facebook" data-soc="fb" data-type="soc-link" href="{{ action("Auth\AuthController@redirectToProvider") }}">
                    <span class="fa fa-facebook"></span>
                    Sign in with Facebook
                </a>&nbsp;&nbsp;&nbsp;
                <?php $href = "https://oauth.vk.com/authorize?client_id=5304987&display=page&redirect_uri=http://geotourist.ge/".App::getLocale()."/vk-callback&scope=friends&response_type=code&v=5.45"; ?>
                <a href="{{ $href }}" class="soc-bt-log btn btn-social btn-vk" data-soc="vk" data-type="soc-link">
                    <span class="fa fa-vk"></span>
                    Sign in with Vkontakte
                </a>
            </div>
			@endif
											</div>
											@if(null !== $tour_reviews && count($tour_reviews) > 0)
												@foreach($tour_reviews as $review)
													<hr/>
													<div class="row" style="margin-bottom: 30px">
														<div class="col-sm-3 col-md-3 col-lg-3">
															<img class="com-auth-img img-responsive" src="{{asset( $review->users->avatar)}}" alt="">
														</div>
														<div class="col-sm-8 col-md-8 col-lg-8">
															<div class="row">
																<div class="col-sm-6 col-md-7 col-lg-7" style="padding:0">
																	<h4 class="comment-author">{{ $review->users->name}}</h4>
																</div>
																<div class="col-sm-6 col-md-5 col-lg-5">
																	<div class="rat-stars" style="font-size: 0.9em">
																		@for($i = 0; $i < $review->rate; $i++)
																			<span class="glyphicon glyphicon-star"></span>
																		@endfor
																	</div>
																</div>
															</div>
															<h5 class="time_added">{{ $review->time_added }}</h5>
															<p class="thecomment">{{ $review->comment }}</p>
														</div>
													</div>
													@if(isset($boss_mode) && $boss_mode === true)
														<button type="button" role="button" class="btn btn-default btn-danger" data-comment-id="{{ action("AdminToursController@removeCommment", ["id" => $review->id]) }}">წაშლა</button>
													@endif
												@endforeach
											@endif
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					@include("ad-show", ["show" => "ad-small"])
				</div>
			@endif
	  @endforeach
@endsection
@section("script")
<script src="{{ asset('/js/parallax.min.js') }}"></script>
@if(count($tour->tour_gallery)>0)
<script src="{{ asset('/js/jssor.slider.mini.js') }}"></script>
@endif
<script src="{{ asset('/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('/js/jquery.video.min.js') }}"></script>
<script src="{{ asset('/js/star-rating.min.js') }}"></script>
<script>
	$(document).ready(function(){
		$('.parallax-window').parallax(/*{imageSrc: "{{ asset($tour->paralax_img) }}"}*/);
		$(".mCustomScrollbar").mCustomScrollbar();

        if (window.location.hash && window.location.hash == '#_=_') {
            window.location.hash = '';
          }
         if(window.location.href.indexOf("#") > -1)
             window.location.href = window.location.href.replace("#","");
 	});

  
</script>
<script>
	$(document).ready(function(){
		var url = document.location.toString();
		if (url.match('scn3')) {
			$('.nav-tabs a[href=#sectionC]').tab('show');
		}else if(url.match('scn7')){
			$('.nav-tabs a[href=#sectionD]').tab('show');
		}else if(url.match('scn10')){
			$('.nav-tabs a[href=#sectionE]').tab('show');
		}

if($('.btn-comment').length > 0){
     $('.btn-comment').on('click', function(event) {
         event.preventDefault();
           $.ajax({
                headers: {'X-CSRF-Token': $('input[name="_token"]').val()},
                url: "{{ action("Auth\AuthController@handleComment", ["id" => $tour->id]) }}",
                method: 'POST',
			   dataType: 'json',
                data:{ user_rate: $(".hidden-rate").val(), bel_to: $("input[name=bel_to]").val(), user_comment: $(".comment-txt-ar").val(), data_id: $("input[name=data_id]").val()}
            }).done(function(data){
			   var res = data;
			   if(typeof res != "undefined" && typeof res.add != "undefined" && res.add == "1"){
				   window.location.reload();
			   }
		   });
   	 $(".login-wrap").slideDown();
     });
 }

});
</script>
@if(count($tour->tour_gallery)>0)
<script>
	$(document).ready(function(){
		jssor_1_slider_init();
	});
</script>
@endif
@if(isset($boss_mode) && $boss_mode === true)
	<script src="{{ asset('/js/bootbox.min.js') }}"></script>
	<script>
		$(document).on("click", "button[data-comment-id]", function(e) {
			var delLink = $(this).attr("data-comment-id");
			bootbox.confirm({
				message: "გსურთ აღნიშნული კომენტარის წაშლა?",
				callback: function(result){ }
			});
			$("button[data-bb-handler='confirm']").on("click",function(){
				$.ajax({
					headers: {'X-CSRF-Token': $('meta[name="csrf_token"]').attr('content')},
					url: delLink,

				}).done(function() {
					window.location.reload();
				});
			});
		});
	</script>
@endif
@endsection