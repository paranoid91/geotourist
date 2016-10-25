@extends("ancestor")

@section("title") {{ trans("gallery.title") }} @endsection

@section("css")
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/gallery.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/js/lightGallery/dist/css/lightgallery.css') }}">
@endsection
@section("content")
    <div class="container-fluid" id="content-gallery">
        <div class="gallery-tabs-holder">
            <ul class="nav nav-pills nav-t" style="font-size: 1.3em;">
                @if(isset($pics) && (count($pics)>0))
                    <li class="active"><a data-toggle="tab" href="#sectionPhotos">{{ trans("gallery.photos") }}</a></li>
                    <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
                @endif
                @if(isset($videos) && (count($videos)>0))
                        <li><a data-toggle="tab" href="#sectionVideos">{{ trans("gallery.videos") }}</a></li>
                @endif
            </ul>
        </div>
        <div class="tab-content">
            @if(isset($pics) && (count($pics)>0))
                <div class="tab-pane fade in active tab-pane-holder demo-gallery" id="sectionPhotos">
                    <ul id="lightgallery" class="row no-margin">
                        @foreach($pics->all() as $pic)
                            @if(file_exists(public_path() . $pic->path))
                                <div class="gal-img-holder col-xs-6 col-sm-4 col-md-4 col-lg-3" data-responsive="{{ asset($pic->path) }}, {{ asset($pic->path) }}" data-src="{{ asset($pic->path) }}">
                                    <a href="" class="sld-img-wrapper">
                                        <div class="wrapper-img-gallery">
                                            <div class="values-inner" style="background-image: url('{{ asset($pic->path) }}'); background-size: cover;"></div>
                                            <img src="{{ asset($pic->path) }}" style="display: none">
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(($videos) && (count($videos)>0))
                <div id="sectionVideos" class="tab-pane fade">
                    <div class="container">
                        <div class="row video">
                            @foreach($videos->all() as $video)
                                <div class="col-lg-6">
                                    <iframe class="video v2" src="{{ $video->src }}" frameborder="0" allowfullscreen></iframe>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
@section("script")
    <script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
    <script src="/js/lightGallery/dist/js/lightgallery.js"></script>
    <script src="/js/lightGallery/dist/js/lg-fullscreen.js"></script>
    <script src="/js/lightGallery/dist/js/lg-thumbnail.js"></script>
    <script src="/js/lightGallery/dist/js/lg-video.js"></script>
    <script src="/js/lightGallery/dist/js/lg-autoplay.js"></script>
    <script src="/js/lightGallery/dist/js/lg-zoom.js"></script>
    <script src="/js/lightGallery/dist/js/lg-hash.js"></script>
    <script src="/js/lightGallery/dist/js/lg-pager.js"></script>
    <script src="/js/lightGallery/lib/jquery.mousewheel.min.js"></script>
    <script src="{{ asset('/js/jquery.video.min.js') }}"></script>
@endsection