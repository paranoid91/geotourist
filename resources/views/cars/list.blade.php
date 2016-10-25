@extends("ancestor")

@section('title') {{ trans("main.car") }} @endsection

@section("css")
    <link rel="stylesheet" href="{{ asset("/css/cars.css") }}">
@endsection

@section("content")
    <div class="cars-list-content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    @if(isset($trans))
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            @foreach($trans as $tr)
                                @foreach($tr->car_cat_trans as $tr)
                                    @if($tr->lang->lang == App::getLocale())
                                        @if($tr->id == $current_id)
                                            <div class="panel panel-default">
                                                <div class="panel-heading" role="tab" id="h{{ removeWS($tr->title) }}">
                                                    <h4 class="panel-title">
                                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#{{ removeWS($tr->title) }}" aria-expanded="true" aria-controls="{{ removeWS($tr->title) }}">
                                                            {{$tr->title}}
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="{{ removeWS($tr->title)}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="h{{ removeWS($tr->title) }}">
                                                    <div class="panel-body">
                                                        @if(null !== $tr->car_cat->cars)
                                                            @foreach($tr->car_cat->cars as $car)
                                                                <div class="col-sm-4  col-md-4 col-lg-4">
                                                                    <div class="wrapper-img-gallery">
                                                                        <a href="{{ action("CarsController@show", ["id" => $car->id]) }}">
                                                                            <div class="values-inner" style="background-image: url({{ asset($car->img)}})"></div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                @foreach($car->car_trans as $transl)
                                                                    @if($transl->lang->lang == App::getLocale())
                                                                        <div class="col-sm-2 col-md-2 col-lg-2">
                                                                            <div class="list-car-desc">
                                                                                <div class="car-ls-wr">
                                                                                    <div class="list-car-title">
                                                                                        <span>{{ $transl->title }}</span>
                                                                                    </div>
                                                                                    <div class="list-car-price">
                                                                                        <span>{{ trans("main.prc") }}&nbsp;{{ $car->price }}</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="list-car-link">
                                                                                    <a href="{{ action("CarsController@show", ["id" => $car->id]) }}">{{ trans("main.dets") }}</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            @endforeach
                            @foreach($trans as $tr)
                                @foreach($tr->car_cat_trans as $tr)
                                    @if($tr->lang->lang == App::getLocale())
                                        @if($tr->id == $current_id)
                                            <?php  continue; ?>
                                        @else
                                            <div class="panel panel-default">
                                                <div class="panel-heading" role="tab" id="h{{ removeWS($tr->title) }}">
                                                    <h4 class="panel-title">
                                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#{{ removeWS($tr->title) }}" aria-expanded="false" aria-controls="{{ removeWS($tr->title) }}">
                                                            {{$tr->title}}
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="{{ removeWS($tr->title)}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="h{{ removeWS($tr->title) }}">
                                                    <div class="panel-body">
                                                        @if(null !== $tr->car_cat->cars)
                                                            @foreach($tr->car_cat->cars as $car)
                                                                <div class="col-sm-4 col-md-4 col-lg-4">
                                                                    <div class="wrapper-img-gallery">
                                                                        <a href="{{ action("CarsController@show", ["id" => $car->id]) }}">
                                                                            <div class="values-inner" style="background-image: url({{ asset($car->img)}})"></div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                @foreach($car->car_trans as $transl)
                                                                    @if($transl->lang->lang == App::getLocale())
                                                                        <div class="col-sm-2 col-md-2 col-lg-2">
                                                                            <div class="list-car-desc">
                                                                                <div class="car-ls-wr">
                                                                                    <div class="list-car-title">
                                                                                        <span>{{ $transl->title }}</span>
                                                                                    </div>
                                                                                    <div class="list-car-price">
                                                                                        <span>{{ trans("main.prc") }}&nbsp;{{ $car->price }}</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="list-car-link">
                                                                                    <a href="{{ action("CarsController@show", ["id" => $car->id]) }}">{{ trans("main.dets") }}</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                    @endif
                </div>
                @include("ad")
            </div>
        </div>
    </div>
@endsection
