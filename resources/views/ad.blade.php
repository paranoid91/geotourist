@if(isset($ads) && count($ads) > 0)
@if(isset($class))
   <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 {{ $class }} ad-main-style" style="padding-top:30px">
@else
   <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 ad-main-style" style="padding-top:30px">
@endif
        @foreach($ads as $ad)
            @if(isset($ad->event_id))
                @foreach($ad->event->event_trans as $trans)
                    @if($trans->lang->lang == App::getLocale())
                         <div class="col-xs-offset-2 col-xs-8 col-sm-offset-2 col-sm-4 col-md-12 col-lg-12 new-commerc">
                           <a href="{{ action("EventsController@show", ['id' => $ad->event_id]) }}" class="ad-main-link">
                                <div class="img-parent view view-sixth">
                                    <div class="img-child" style="background-image: url({{ asset($ad->event->list_img)}});">
                                        @if($ad->event->sticker == 1)
                                            <div class="atgrid__item__angle" style="background-color:#01cb68">{{ trans("main.forsale") }}</div>
                                        @elseif($ad->event->sticker == 2)
                                            <div class="atgrid__item__angle" style="background-color:#eb4293">{{ trans("main.upcmg") }}</div>
                                        @endif
                                        <div class="mask">
                                            <h2 class="text-center">{{ $trans->title }}</h2>
                                            <p>{{ trans("main.eventsz") }}</p>
                                        </div>
                                        <div class="ad-texts">
                                            @if(!empty($ad->event->price))
                                                <div class="ad-price">
                                                    {{ $ad->event->price }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
            @elseif(isset($ad->tour_id))
                @foreach($ad->tour->tour_trans as $trans)
                    @if($trans->lang->lang == App::getLocale())
                        <div class="col-xs-offset-2 col-xs-8 col-sm-offset-2 col-sm-4 col-md-12 col-lg-12 new-commerc">
                            <a href="{{ action("ToursController@show", ['id' => $ad->tour_id]) }}" class="ad-main-link">
                                <div class="img-parent view view-sixth">
                                    <div class="img-child" style="background-image: url({{ asset($ad->tour->list_img)}});">
                                        @if($ad->tour->sticker == 1)
                                            <div class="atgrid__item__angle" style="background-color:#01cb68">{{ trans("main.forsale") }}</div>
                                        @elseif($ad->tour->sticker == 2)
                                            <div class="atgrid__item__angle" style="background-color:#eb4293">{{ trans("main.upcmg") }}</div>
                                        @endif
                                        <div class="mask">
                                            <h2>{{ $trans->title }}</h2>
                                            <p>{{ trans("main.tours") }}</p>
                                        </div>
                                        <div class="ad-texts">
                                            @if(!empty($ad->tour->price))
                                                <div class="ad-price">
                                                    {{ $ad->tour->price }}
                                                </div>
                                            @endif
                                        </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>
    @endif
