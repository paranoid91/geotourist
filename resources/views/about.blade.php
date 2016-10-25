@extends("ancestor")

@section("title") {{ trans("main.about") }} @endsection

@section("css")
    <link rel="stylesheet" href="{{ asset('/css/about.css') }}">
@endsection

@section("content")
    <div class="container-fluid about-cont">
        <div class="row headline_wr">
            <h3 class="about_headline">{{ trans("main.about") }}</h3>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                    @if(isset($texts))
                        @if(App::getLocale() == 'ge')
                            {!! $texts[0]->ge_body !!}
                        @elseif(App::getLocale() == 'en')
                            {!! $texts[0]->en_body !!}
                        @else
                            {!! $texts[0]->ru_body !!}
                        @endif
                    @endif
                    {{-- <div class="container-fluid ppl-wrapper">
                          <h3 class="text-center">{{ trans("about.team") }}</h3>
                          <div class="col-lg-8 col-lg-offset-2 text-center sub-ppl-text">
                              We possess within us two minds. So far I have written only of the conscious mind. I would now like to
                              introduce you to your second mind, the hidden and mysterious subconscious. Our subconscious mind.
                          </div>
                      </div>
                      <div class="container-fluid ppl-container">
                          <div class="row">
                              <div class="col-lg-12 ppl-pics">
                                  <div class="col-sm-3 col-md-3 col-lg-3">
                                      <img src="" class="img-responsive img-circle ppl-img">
                                      <h4 class="text-center">Lorem</h4>
                                      <p class="ppl-sp-text text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                          sed do eiusmod tempor incididunt ut labore et dolore magna.Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                          sed do eiusmod tempor incididunt ut labore et dolore magna.
                                      </p>
                                  </div>
                                  <div class="col-sm-3 col-md-3 col-lg-3">
                                      <img src="" class="img-responsive img-circle ppl-img">
                                      <h4 class="text-center">Ipsum</h4>
                                      <p class="ppl-sp-text text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                          sed do eiusmod tempor incididunt ut labore et dolore magna.Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                          sed do eiusmod tempor incididunt ut labore et dolore magna.
                                      </p>
                                  </div>
                                  <div class="col-sm-3 col-md-3 col-lg-3">
                                      <img src=""  alt="" class="img-responsive img-circle ppl-img">
                                      <h4 class="text-center">Dolor</h4>
                                      <p class="ppl-sp-text text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                          sed do eiusmod tempor incididunt ut labore et dolore magna.Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                          sed do eiusmod tempor incididunt ut labore et dolore magna.
                                      </p>
                                  </div>
                                  <div class="col-sm-3 col-md-3 col-lg-3">
                                      <img src="" class="img-responsive img-circle ppl-img" alt="">
                                      <h4 class="text-center">Consectetur</h4>
                                      <p class="ppl-sp-text text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                          sed do eiusmod tempor incididunt ut labore et dolore magna.Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                          sed do eiusmod tempor incididunt ut labore et dolore magna.
                                      </p>
                                  </div>
                              </div>
                          </div>
                      </div>--}}
                </div>
                @include("ad")
            </div>
        </div>
    </div>
@endsection
@section("script")

@endsection