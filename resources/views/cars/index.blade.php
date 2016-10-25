@extends("ancestor")

@section('title') {{ trans("main.car") }} @endsection

@section("css")
    <link rel="stylesheet" href="{{ asset("/css/cars.css") }}">
@endsection
@section("content")
@if(isset($img[0]->path))
<div class="main-car-bg">
  <img src="{{ asset($img[0]->path) }}" alt="" class="img-responsive">
</div>
@endif
<div class="cars-content">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                @if(isset($cats))
                    @foreach($cats as $cat)
                        <div class="col-xs-9 col-sm-6 col-md-4 col-lg-4 car-wr main-cars-wrapper">
                            <a href="{{ action("CarsController@showList", ["id" => $cat->id]) }}" class="car-link">
                                <div class="car-headline text-center">
                                    <span>{{ $cat->title }}</span>
                                </div>
                                <div class="car-wrapper">
                                    {{--<img src="{{ asset($cat->car_cat->img) }}" class="img-responsive">--}}
                                    <div style="background-image: url({{ asset($cat->car_cat->img) }})" class="lst-img-wr"></div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
            @include("ad", ["class" => "ad-car-stl"])
        </div>
    </div>
</div>
@endsection
@section("script")

@endsection