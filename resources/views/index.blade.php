@extends("ancestor")

@section("title") {{ "Geotourist" }} @endsection

@section("css")
    <link rel="stylesheet" href="{{ asset("/css/specTours.css") }}">
    <link rel="stylesheet" href="{{ asset("/css/swiper.min.css") }}">
@endsection

@section("slider")
<div id="main" style="width: 100%">
  <div id="slide" style="width: 100%">
    <div class="slider" style="width: 100%">
      <ul class="items">
          @if(isset($slider) && count($slider)>0)
              @foreach($slider as $pic)
                  <li><img style="width: 100%" class="slider-img" src="{{ asset($pic->path) }}" /></li>
              @endforeach
          @endif
      </ul>
    </div>
  </div>
</div>
@endsection

@section("content")
	<div id="content">
      <h1 class="text-center slogan">
          @if(isset($texts[0]))
              @if(App::getLocale() == "en")
                  {{ $texts[0]->en_headline or null }}
              @elseif(App::getLocale() == "ge")
                  {{ $texts[0]->ge_headline or null }}
              @else
                  {{ $texts[0]->ru_headline or null }}
              @endif
          @endif
      </h1>
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
              <p class="text-center main-text">
                  @if(isset($texts[0]))
                      @if(App::getLocale() == "en")
                          {{ $texts[0]->en_main_text or null }}
                      @elseif(App::getLocale() == "ge")
                          {{ $texts[0]->ge_main_text or null }}
                      @else
                          {{ $texts[0]->ru_main_text or null }}
                      @endif
                  @endif
              </p>
            </div>
          </div>
        </div>
      <div class="container-fluid text-center buttons">    
        <a href="{{ action('ToursController@showAllTours') }}" class="btn btn-default main-button"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;{{trans("main.tours")}}</a>
<a href="{{ action("EventsController@index") }}" role="button" class="btn btn-default main-button ge_but ru_but second-button"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;{{trans("main.events")}}</a>
      </div>
       <div class="container-fluid no-padding" style="background:#fff; margin-top:19%">
          <div class="container no-padding">
              <div class="row no-margin no-padding">
               <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 a-side_wrapper">
                   @if(isset($ex_tours) && count($ex_tours) > 0)
                       <div class="container-fluid offers-holder" style="padding-bottom: 10px">
                           <h1 class="special_tours_h1 text-center">{{ trans("main.excl") }}</h1>
                           <div class="row">
                               <div class="slc-sld">
                                   @foreach($ex_tours as $tour)
                                       @for($i = 0; $i < count($tour->tour_trans); $i++)
                                           @if($tour->tour_trans[$i]->lang_id == $lang[0]->id)
                                               <div class="col-sm-12 col-md-12 col-lg-12 tour-wrapper">
                                                       <div class="col-sm-4 col-md-4 col-lg-4 tour-wrapper-image no-padding">
                                                           <a href="{{ action('ToursController@show', ["id" => $tour->id]) }}" style="background-image: url({{ asset($tour->paralax_img) }})" class="lst-img-wr">
                                                           </a>
                                                       </div>
                                                       <div class="col-sm-5 col-md-5 col-lg-5">
                                                           <div class="tour-txt-fx-wd">
                                                               <h2 class="tour-h2-new">{{ $tour->tour_trans[$i]->title }}</h2>
                                                               <p>{!! $tour->tour_trans[$i]->short_description !!}</p>
                                                           </div>
                                                           @if($tour->sp_tour_num != 0 && $tour->tour_trans[$i]->d10)
                                                               <div class="times">
                                                                   <a href="{{ action('ToursController@show', ["id" => $tour->id . "scn10"]) }}">
                                                                       <span class="span-time">
                                                                           <span class="glyphicon glyphicon-time gl-tm-tour"></span>
                                                                           <span class="time-fn">
                                                                               &nbsp;{{ $tour->sp_tour_num }} {{ trans("tours.day") }}
                                                                           </span>
                                                                       </span>
                                                                   </a>
                                                               </div>
                                                           @endif
                                                       </div>
                                                       <div class="col-sm-3 col-md-3 col-lg-3 txt-wrapper">
                                                           <div class="txt-wt-link">
                                                               @if(($mark = getTourStarts($tour->id)) > 0)
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
                                                               <a href="{{ action('ToursController@show', ["id" => $tour->id]) }}" class="tour-button text-center">{{ trans("main.view-more") }}</a>
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
                   <div class="container-fluid tours no-padding">
                       <h1 class="tours-headline text-center">{{ trans("main.tours-h") }}</h1>
                       <div class="row" style="margin:0 5px 0 0 !important">
                           @if(isset($usual_tours) && count($usual_tours) > 0)
                               @foreach($usual_tours as $tour)
                                   @for($i = 0; $i < count($tour->tour_trans); $i++)
                                       @if($tour->tour_trans[$i]->lang->lang == App::getLocale())
                                           <div class="col-sm-6 col-md-4 col-lg-4 us-tr-ancestor">
                                               <div class="us-tr-wr" style="background-image: url('{{ asset($tour->paralax_img)}}');">
                                                   <a href="{{ action("ToursController@show", ["id" => $tour->id]) }}" class="box overlay">
                                                       <span class="image-caption img-cp">{{ $tour->tour_trans[$i]->title }}</span>
                                                   </a>
                                               </div>
                                           </div>
                                       @endif
                                   @endfor
                               @endforeach
                           @endif
                       </div>
                   </div>
                   @if(isset($events) && count($events) > 0)
                   <div class="container-fluid events-container">
                       <h1 class="text-center">{{ trans("main.event-h") }}</h1>
                       <div class="container-fluid">
                           <div class="row">
                               <div class="multiple-events">

                                       @foreach($events as $event)
                                           <div class="col-lg-3 event-holder">
                                               <a href="{{ action('EventsController@show', ["id" => $event->id]) }}">
                                                   <div class="event-bg" style="background-image: url('{{ $event->paralax_img }} ')"></div>
                                               </a>
                                               <div class="event-desc">
                                                   @foreach($event->event_trans as $trans)
                                                       @if($trans->lang->lang == App::getLocale())
                                                           <span class="event-desc-headline">{{ $trans->title }}</span>
                                                           @if(($mark = getEventStarts($event->id)) > 0)
                                                               <div class="starts-wrapper">
                                                                   @for($i = 1; $i <= $mark; $i++)
                                                                       <span class="glyphicon glyphicon-star"></span>
                                                                   @endfor
                                                               </div>
                                                           @endif
                                                           <p>{!! $trans->short_body !!}</p>
                                                       @endif
                                                   @endforeach
                                                   <span class="price">{{ $event->price }}</span>
                                               </div>
                                           </div>
                                       @endforeach
                               </div>
                           </div>
                       </div>
                   </div>
                   @endif
                   @if(isset($places) && count($places) > 0)
                       <div class="popular-places">
                           <h1 class="text-center pop-pl-h">{{ trans("main.pop") }}</h1>
                           <div class="container-fluid">
                               <div class="row">
                                   <div class="col-lg-offset-1 col-lg-10">
                                       <div class="swiper-container">
                                           <div class="swiper-wrapper">
                                               @foreach($places as $place)
                                                   @if($place->lang->lang == App::getLocale())
                                                       <div class="swiper-slide">
                                                           <img src="{{ asset($place->place->img) }}" class="img-circle img-popular img-responsive">
                                                           <h2 class="text-center pop-h1" style="height:90px; font-size:1.9em">{{ $place->title }}</h2>
                                                            <div class="ph-container">
    <div class="ph-float" style="padding-bottom:20px; text-align: center;">
        <a href="javascript:void(0);" class="ph-button ph-btn-green show_hide">{{ trans("main.pop-btn") }}
         <span class="glyphicon glyphicon-chevron-down" style="vertical-align: middle"></span>
        </a>
    </div> 
	<div class="slidingDiv">
		<p class="justify">{{ $place->body }}</p>
	</div>
</div>
                                                           
                                                       </div>
                                                   @endif
                                               @endforeach
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   @endif
                   @if(null !== $reviews && count($reviews) > 0)
                       <div class="container-fluid comments-wr">
                           <div class="row">
                               @for($i = 0; $i < 3; $i++)
                                  @if(isset($reviews[$i]))
                                   <div class="col-sm-4 col-md-4 col-lg-4 rand-comments-wrapper">
                                           <div class="main-com-img text-center">
                                               <img src="{{ asset($reviews[$i]->users->avatar) }}" class="img-circle main-com-photo"/><br>
                                               <h4 class="main-com-name">{{ $reviews[$i]->users->name }}</h4>
                                               @if(($mark = getTourStarts($reviews[$i]->tour->id)) > 0)
                                                   @for($j = 1; $j <= $mark; $j++)
                                                       <span class="glyphicon glyphicon-star"></span>
                                                   @endfor
                                               @endif
                                               <br>
                                               <span class="sp-comment">"{{ $reviews[$i]->comment }}"</span>
                                           </div>
                                       </div>
                                  @endif
                               @endfor  
                          </div>
                            <div class="row">
                               @for($i = 3; $i < 6; $i++)
                                  @if(isset($reviews[$i]))
                                   <div class="col-sm-4 col-md-4 col-lg-4 rand-comments-wrapper">
                                           <div class="main-com-img text-center">
                                               <img src="{{ asset($reviews[$i]->users->avatar) }}" class="img-circle main-com-photo"/><br>
                                               <h4 class="main-com-name">{{ $reviews[$i]->users->name }}</h4>
                                               @if(($mark = getTourStarts($reviews[$i]->tour->id)) > 0)
                                                   @for($j = 1; $j <= $mark; $j++)
                                                       <span class="glyphicon glyphicon-star"></span>
                                                   @endfor
                                               @endif
                                               <br>
                                               <span class="sp-comment">"{{ $reviews[$i]->comment }}"</span>
                                           </div>
                                       </div>
                                  @endif
                               @endfor  
                          </div>
                           <div class="row">
                               @for($i = 6; $i < 9; $i++)
                                  @if(isset($reviews[$i]))
                                   <div class="col-sm-4 col-md-4 col-lg-4 rand-comments-wrapper">
                                           <div class="main-com-img text-center">
                                               <img src="{{ asset($reviews[$i]->users->avatar) }}" class="img-circle main-com-photo"/><br>
                                               <h4 class="main-com-name">{{ $reviews[$i]->users->name }}</h4>
                                               @if(($mark = getTourStarts($reviews[$i]->tour->id)) > 0)
                                                   @for($j = 1; $j <= $mark; $j++)
                                                       <span class="glyphicon glyphicon-star"></span>
                                                   @endfor
                                               @endif
                                               <br>
                                               <span class="sp-comment">"{{ $reviews[$i]->comment }}"</span>
                                           </div>
                                       </div>
                                  @endif
                               @endfor  
                          </div>
                          <div class="row">
                               @for($i = 9; $i < 12; $i++)
                                  @if(isset($reviews[$i]))
                                   <div class="col-sm-4 col-md-4 col-lg-4 rand-comments-wrapper">
                                           <div class="main-com-img text-center">
                                               <img src="{{ asset($reviews[$i]->users->avatar) }}" class="img-circle main-com-photo"/><br>
                                               <h4 class="main-com-name">{{ $reviews[$i]->users->name }}</h4>
                                               @if(($mark = getTourStarts($reviews[$i]->tour->id)) > 0)
                                                   @for($j = 1; $j <= $mark; $j++)
                                                       <span class="glyphicon glyphicon-star"></span>
                                                   @endfor
                                               @endif
                                               <br>
                                               <span class="sp-comment">"{{ $reviews[$i]->comment }}"</span>
                                           </div>
                                       </div>
                                  @endif
                               @endfor  
                          </div>
                       </div>
                   @endif
                   <div class="news-wrapper">
                       @if(session('msg'))
                           <div class="alert alert-success text-center"><h4>{{ trans("main.added") }}</h4></div>
                       @endif
                       @include("errors/errors")
                       <div class="news-form">
                           <h3 class="text-center">{{ trans("main.news") }}</h3>
                           <span class="news-span">{{ trans("main.news-span") }}</span>
                           {!! Form::open(["method" => "POST", 'enctype' => 'application/x-www-form-urlencoded', 'action' => "PagesController@saveMail"]) !!}
                           <div class="form-group fr-gr-wr">
                               <input type="text" name="email" placeholder="{{ trans("main.urmail") }}" required class="sub-email form-control"/><input name="submit" type="submit" value="{{ trans("main.subscribe") }}" class="sub-butt"/>
                           </div>
                           {!! Form::close() !!}
                       </div>
                   </div>
               </div>
               @include("ad", ["class" => "main-ad-ind"])
           </div>
         </div>
       </div>
    </div>
@endsection
@section("script")
<script src="{{ asset('/js/jquery.easing.1.3.js') }}"></script>
<script src="{{ asset('/js/tms-0.4.1.js') }}"></script>
<script src="{{ asset('/js/swiper.min.js') }}"></script>
<script>
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        slidesPerView: 3,
        centeredSlides: true,
        paginationClickable: true,
        spaceBetween: 30,
        breakpoints: {
            400: {
                slidesPerView: 1,
                spaceBetweenSlides: 10
            },
            700: {
                slidesPerView: 2,
                spaceBetweenSlides: 20
            }
        }
    });
</script>
@endsection