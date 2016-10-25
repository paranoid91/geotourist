@extends("ancestor")

@section("title")
    @if(isset($title)) {{ trans("events.title") }} @endif
@endsection

@section("css")
    <link href="{{ asset('/css/tours.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section("content")
    <div class="container event-list-wrapper">
        <div class="row">
             <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9" style="padding-right:20px">
                @if(isset($cat))
                    @if(isset($title))
                        <h2 class="text-center event-list-head">{{ $title }}</h2>
                    @endif
                    @foreach($cat as $c)
                        <div class="row event-list-cat">
                            <div class="col-sm-12 col-md-12 col-lg-12 tour-wrapper">
                                <div class="col-sm-4 col-md-4 col-lg-4 tour-wrapper-image no-padding">
                                    @if(isset($boss_mode) && $boss_mode === true)
                                        <a href="{{ action('EventsController@show', ["id" => $c->event->id]) }}">
                                            <img src="{{ asset($tour->list_img) }}">
                                        </a>
                                    @else
                                        <a href="{{ action('EventsController@show', ["id" => $c->event->id]) }}" style="background-image: url({{ asset($c->event->paralax_img) }})" class="lst-img-wr">
                                            @if($c->event->sticker == 1)
                                                <div class="atlist__item__angle" style="background-color:#01cb68">{{ trans("main.forsale") }}</div>
                                            @elseif($c->event->sticker == 2)
                                                <div class="atlist__item__angle" style="background-color:#eb4293">{{ trans("main.upcmg") }}</div>
                                            @endif
                                        </a>
                                    @endif
                                </div>
                                <div class="col-sm-5 col-md-5 col-lg-5">
                                    <div class="tour-txt-fx-wd">
                                        <h2 class="tour-h2-new">{{ $c->title }}</h2>
                                        <p>{!! $c->short_body !!}</p>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-3 col-lg-3 txt-wrapper">
                                    <div class="txt-wt-link">
                                        @if(($mark = getEventStarts($c->event->id)) > 0)
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
                                        @if(count($c->event->reviews) > 0)
                                            <div class="rev-count">
                                                <span>{{ count($tour->event->reviews) }}</span>
                                                <span class="revcount-sp">{{ (count($tour->event->reviews) > 1 ? trans("main.revcounts") : trans("main.revcount")) }}</span>
                                            </div>
                                        @else
                                            <div class="rev-count">
                                                <span class="revcount-sp">0 {{ trans("main.revcount") }}</span>
                                            </div>
                                        @endif
                                        @if(!empty($c->event->price))
                                            <div class="price-new">
                                                <span class="price-is">{{ $c->event->price }}</span><br>
                                                <span class="price-per">{{ trans("main.per-per") }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    @if(isset($boss_mode) && $boss_mode === true)
                                        <a href="{{ url('{$lang}/filter-events/' . $c->event->id) }} }}" class="tour-button text-center">{{ trans("main.view-more") }}</a>
                                    @else
                                        <div class="link-wr">
                                            <a href="{{ action('EventsController@show', ["id" => $c->event->id]) }}" class="tour-button text-center">{{ trans("main.view-more") }}</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                @if($title == "ფესტივალები" || $title == "Festivals" || $title == "Фестивали")
                    <div class="row iframe-video">
                       <div class="col-xs-12 col-sm-12 col-md-offset-4 col-md-4 col-lg-offset-4 col-lg-4">
                           <iframe src="https://www.youtube.com/embed/o8l1o8deAW0" frameborder="0" allowfullscreen></iframe>
                       </div>
                    </div>
                @endif
            </div>
            @include("ad", ["class" => "list-tr-ad-event"])
        </div>
    </div>
@endsection

@section("script")
@endsection