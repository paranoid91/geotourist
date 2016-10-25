@extends("ancestor")

@section('title') {{ trans("main.car") }} @endsection

@section("css")
    <link rel="stylesheet" href="{{ asset("/css/cars.css") }}">
    <link rel="stylesheet" href="{{ asset("/css/galleries.css") }}">
    <link rel="stylesheet" href="{{ asset("/css/lightbox.min.css") }}">
<style>
        .images{
            display: none;
            
        }
</style>
@endsection

@section("content")
    @if(isset($car))
        @foreach($car->car_trans as $c)
            @if($c->lang->lang == App::getLocale())
            <div class="container car-show-content">
               <div class="row">
                <h3 class="car-head text-center">{{ $c->title }}</h3>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-offset-1 col-lg-6 car-sh-main">
                        @if(null !== $car->car_gallery)
                            <div class="gallery">
                                <!-- <div class="images">
                                    <div class="image">
                                        <a href="{{ $car->img }}" style="display:inline-block" data-lightbox="img">
                                            <div class="content" style="background-image: url('{{ $car->img }}')"></div>
                                        </a>
                                    </div>
                                    @for($i = 0; $i < count($car->car_gallery); $i++)
                                        <div class="image">
                                            <div class="content" style="background-image: url('{{ $car->car_gallery[$i]->path }}')"></div>
                                        </div>
                                    @endfor
                                </div> -->
                                <div class="thumbs">
                                    <a href="{{ $car->img }}" style="display:inline-block" data-lightbox="img">
                                       <div class="thumb" style="background-image: url('{{ $car->img }}')"></div>
                                    </a>
                                    @for($i = 0; $i < count($car->car_gallery); $i++)
                                    <a href="{{ $car->car_gallery[$i]->path }}" style="display:inline-block" data-lightbox="img">
                                        <div class="thumb" style="background-image: url('{{ $car->car_gallery[$i]->path}}')"></div>
                                    </a>
                                    @endfor
                                </div>
                            </div>
                        @endif
                        <div class="container-fluid car-show-data">
                            <div class="row car-show-title">
                                {!! $c->title !!}
                            </div>
                            <div class="row car-show-price">
                                {!! $car->price !!}
                            </div>
                            <div class="row car-show-body">
                                {!! $c->body !!}
                            </div>
                            <div class="reserve-link">
                                <a href="mailto:info@geotourist.ge" class="btn btn-primary res-btn">{{ trans("main.reserve") }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                   @include("ad", ["class" => "ad-stl-car-sh"])
               </div>
                <div class="row car-ad-wrapper">
                    @if(isset($cats))
                        @foreach($cats as $cat)
                            <div class="col-xs-8 col-sm-4 col-md-3 col-lg-3 car-ad-show">
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
            </div>
            @endif
        @endforeach
    @endif
@endsection

@section("script")
<!-- <script src="{{ asset("/js/hammer.js") }}"></script>
<script src="{{ asset("/js/gallery.js") }}"></script> -->
<script src="{{ asset("/js/lightbox.min.js") }}"></script>
<script>
    lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true
    })
</script>

@endsection
