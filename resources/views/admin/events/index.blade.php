@extends("admin/admin-app")

@section("css")

@endsection

@section("content")
    <div class="row">
        <h2 class="text-center">ივენთები</h2>
        <hr>
    </div>
    <div class="row">
        <h3>&nbsp;&nbsp;<a href="{{ action("AdminEventsController@showEventsSlider") }}" style="text-decoration: underline">ივენთების სლაიდერი</a></h3>
    </div>
    <div class="row">
        <h3>&nbsp;&nbsp;<a href="{{ action("AdminEventsController@mainText") }}" style="text-decoration: underline">მთავარი ტექსტი</a></h3>
    </div>
    <div class="row">
        <div class="col-lg-12" style="margin-top: 50px">
            <img src="{{ asset('/img/add-sign.png') }}" alt="" class="plus-sign-img">&nbsp;&nbsp;
            <a href="{{ action('AdminEventsController@categories') }}" type="button" class="btn btn-info">კატეგორიის დამატება/განახლება</a>
        </div>
        <div class="col-lg-12" style="margin-top: 50px">
            <img src="{{ asset('/img/add-sign.png') }}" alt="" class="plus-sign-img">&nbsp;&nbsp;
            <a href="{{ action('AdminEventsController@create') }}" class="btn btn-success">ივენთის დამატება</a>
        </div>
    </div>
    @foreach($events->all() as $event)
        <hr>
        <div class="row" style="padding-left: 10px">
            <div class="col-lg-10">
                <div class="row" style="margin-top:10px">
                    <div class="col-sm-12 col-md-12 col-lg-12 tour-wrapper">
                        <div class="col-sm-4 col-md-4 col-lg-6 tour-wrapper-image no-padding">
                            <a href="{{action('AdminEventsController@edit', ['id' => $event->id])}}">
                                <img src="{{ asset($event->list_img) }}" style="border:2px solid #f1f1f1"/>
                            </a>
                        </div>
                        <div class="col-sm-5 col-md-5 col-lg-3 tour-wrapper-text">
                            @if(isset($event->event_trans[2]))
                                <h3>{{$event->event_trans[2]->title}}</h3>
                            @elseif(isset($event->event_trans[1]))
                                <h3>{{$event->event_trans[1]->title}}</h3>
                            @elseif(isset($event->event_trans[0]))
                                <h3>{{$event->event_trans[0]->title}}</h3>
                            @endif
                            @if(isset($event->event_trans[2]))
                                <p>{!! $event->event_trans[2]->short_body !!}</p>
                            @elseif(isset($event->event_trans[1]))
                                <p>{!! $event->event_trans[1]->short_body !!}</p>
                            @elseif(isset($event->event_trans[0]))
                                <p>{!! $event->event_trans[0]->short_body !!}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="btn-group tour-btn-holder">
                    <a href="{{action('AdminEventsController@edit', ['id' => $event->id])}}" type="button" class="btn btn-info tour-edit-btn">
                        <span class="glyphicon glyphicon-edit"></span>&nbsp;განახლება
                    </a>
                </div>
                <div class="btn-group tour-btn-holder">
                    <a href="#" type="button" class="btn btn-danger tour-delete-btn" data-del-link="{{action('AdminEventsController@destroy', ['id' => $event->id]) }}">
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
            message: "გსურთ აღნიშნული ივენთის წაშლა?",
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
