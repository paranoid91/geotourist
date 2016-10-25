@extends("admin/admin-app")

@section("css") <link rel="stylesheet" href="{{ asset('/css/tours.css') }}"> @endsection
    
@section("content")
    <div class="row">
        <div class="col-lg-12">
            @if($type==0)
                <h1 class="page-header text-center">ჩვეულებრივი ტურები</h1>
            @elseif($type==1)
                <h1 class="page-header text-center">ექსკლუზიური ტურები</h1>
            @endif
            <img src="{{ asset('/img/add-sign.png') }}" alt="" class="plus-sign-img">&nbsp;&nbsp;
            <a href="{{ action('AdminToursController@create', ['type' => $type]) }}" class="btn btn-success">ტურის დამატება</a>
        </div>
    </div>
      @foreach($tours as $tour)
            <hr>
            <div class="row" style="padding-left: 10px">
                <div class="col-lg-10">
                    <div class="row" style="margin-top:10px">
                        <div class="col-sm-12 col-md-12 col-lg-12 tour-wrapper">
                            <div class="col-sm-4 col-md-4 col-lg-4 tour-wrapper-image no-padding">
                                <a href="{{action('AdminToursController@edit', ['id' => $tour->id])}}">
                                    <img src="{{ asset($tour->list_img) }}" style="border:2px solid #f1f1f1"/>
                                </a>
                            </div>
                            <div class="col-sm-5 col-md-5 col-lg-5 tour-wrapper-text">
                                @if(isset($tour->tour_trans[2]))
                                    <h3>{{$tour->tour_trans[2]->title}}</h3>
                                @elseif(isset($tour->tour_trans[1]))
                                    <h3>{{$tour->tour_trans[1]->title}}</h3>
                                @elseif(isset($tour->tour_trans[0]))
                                    <h3>{{$tour->tour_trans[0]->title}}</h3>
                                @endif
                                @if(isset($tour->tour_trans[2]))
                                    <p>{!! $tour->tour_trans[2]->short_description !!}</p>
                                @elseif(isset($tour->tour_trans[1]))
                                    <p>{!! $tour->tour_trans[1]->short_description !!}</p>
                                @elseif(isset($tour->tour_trans[0]))
                                    <p>{!! $tour->tour_trans[0]->short_description !!}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="btn-group tour-btn-holder">
                      <a href="{{action('AdminToursController@edit', ['id' => $tour->id])}}" type="button" class="btn btn-info tour-edit-btn">
                      <span class="glyphicon glyphicon-edit"></span>&nbsp;განახლება
                      </a>
                    </div>
                    <div class="btn-group tour-btn-holder">
                      <a href="#" type="button" class="btn btn-danger tour-delete-btn" data-del-link="{{action('AdminToursController@destroy', ['id' => $tour->id]) }}">
                        <span class="glyphicon glyphicon-remove"></span>&nbsp;წაშლა
                      </a>
                    </div>
                </div>
            </div>
        @endforeach
@endsection

@section("script")
    <script>
        $(document).on("click", "a.tour-delete-btn", function(e) {

            var delLink = $(this).attr("data-del-link");
            bootbox.confirm({
                message: "გსურთ აღნიშნული ტურის წაშლა?",
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
@endsection