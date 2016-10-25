@extends("ancestor")

@section('title') Tours @endsection

@section("css")
    <link href="{{ asset('/css/tours.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section("content")
    <div class="content-tours">
        <div class="container animated slideInUp">
            @foreach($events as $event)
                @for($i = 0; $i < count($event->event_trans); $i++)
                    @if($event->event_trans[$i]->lang->lang == App::getLocale())
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 tour-wrapper">
                                <div class="col-sm-4 col-md-4 col-lg-4 tour-wrapper-image no-padding">
                                    @if(isset($boss_mode) && $boss_mode === true)
                                        <a href="{{ action('AdminEventsController@showFilter', ["id" => $event->id]) }}">
                                            <img src="{{ asset($event->list_img) }}">
                                        </a>
                                    @endif
                                </div>
                                <div class="col-sm-5 col-md-5 col-lg-5 tour-wrapper-text">
                                    <h1>{{ $event->event_trans[$i]->title }}</h1>
                                    <p>{!! $event->event_trans[$i]->short_body !!}</p>
                                </div>
                                <div class="col-sm-3 col-md-3 col-lg-3 tour-wrapper-desc">
                                    @if(($mark = getEventStarts($event->id)) > 0)
                                        <span class="stars">
						            	@for($i = 1; $i <= $mark; $i++)
                                                <span class="glyphicon glyphicon-star"></span>
                                            @endfor
							            </span>
                                    @endif
                                    <p class="price">{{ $event->price }}</p>
                                    <p class="perperson">{{ trans("main.per-per") }}</p>
                                    @if(isset($boss_mode) && $boss_mode === true)
                                        <a href="{{ action('AdminEventsController@showFilter', ["id" => $event->id]) }}" class="tour-button text-center">{{ trans("main.view-more") }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endfor
            @endforeach
        </div>
    </div>
@endsection
