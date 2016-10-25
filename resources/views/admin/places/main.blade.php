@extends("admin/admin-app")

@section("css")

@endsection

@section("content")
<div class="container-fluid">
    <h2 class="text-center">პოპულარული ადგილები</h2>
    <div class="row" style="margin-top:30px;">
        <img src="{{ asset('/img/add-sign.png') }}" alt="" class="plus-sign-img">&nbsp;&nbsp;
        <a href="{{ action("AdminController@placesAdd") }}" type="button" class="btn btn-success">ადგილის დამატება</a>
    </div>
    <hr>
    @if(isset($places))
        @foreach($places as $place)
            <div class="row" style="padding-left: 10px">
                <div class="col-lg-10">
                    <div class="row" style="margin-top:10px">
                        <div class="col-sm-12 col-md-12 col-lg-12 tour-wrapper">
                            <div class="col-sm-4 col-md-4 col-lg-6 tour-wrapper-image no-padding">
                                <a href="{{action('AdminController@placesEdit', ['id' => $place->id])}}">
                                    <img src="{{ asset($place->img) }}" style="border:2px solid #f1f1f1" height="200" width="320" />
                                </a>
                            </div>
                            <div class="col-sm-5 col-md-5 col-lg-3 tour-wrapper-text">
                                @if(!empty($place->place_trans[2]->title))
                                    <h3>{{$place->place_trans[2]->title}}</h3>
                                @elseif(!empty($place->place_trans[1]->title))
                                    <h3>{{$place->place_trans[1]->title}}</h3>
                                @elseif(!empty($place->place_trans[0]->title))
                                    <h3>{{$place->place_trans[0]->title}}</h3>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="btn-group tour-btn-holder">
                        <a href="{{action('AdminController@placesEdit', ['id' => $place->id])}}" type="button" class="btn btn-info tour-edit-btn">
                            <span class="glyphicon glyphicon-edit"></span>&nbsp;განახლება
                        </a>
                    </div>
                    <div class="btn-group tour-btn-holder">
                        <a href="#" type="button" class="btn btn-danger tour-delete-btn del-place" data-del-place-link="{{action('AdminController@placesDestroy', ['id' => $place->id]) }}">
                            <span class="glyphicon glyphicon-remove"></span>&nbsp;წაშლა
                        </a>
                    </div>
                </div>
            </div>
            <hr>
        @endforeach
    @endif
</div>
@endsection

@section("script")
<script>
    $(document).on("click", "a.del-place", function(e) {
        var delLink = $(this).attr("data-del-place-link");
        bootbox.confirm({
            message: "გსურთ აღნიშნული ადგილის წაშლა?",
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
