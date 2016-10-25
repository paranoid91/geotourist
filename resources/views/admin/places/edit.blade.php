@extends("admin/admin-app")

@section("css")

@endsection

@section("content")
    <div class="container-fluid">
        <h2 class="text-center">ადგილების განახლება</h2>
        @include("errors/errors")
        @if(session('msg'))
            <div class="alert alert-success text-center"><h4>{{session('msg')}}</h4></div>
        @endif
        {!! Form::open(["method" => "POST", 'enctype' => 'multipart/form-data', 'action' => ["AdminController@placesUpdate", "id" => $place->id]]) !!}
        <hr>
        <div class="form-group" style="margin-bottom: 30px">
            @if(file_exists(public_path() . $place->img) && is_file(public_path() . $place->img))
                <img src="{{ asset($place->img) }}" width="300">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-danger tour-delete-btn" data-remove-place-img="{{action('AdminController@placesRemoveImg', ["id" => $place->id]) }}">
                    <span class="glyphicon glyphicon-remove"></span>&nbsp;წაშლა
                </button>
            @else
                <b><h4>სურათი</h4></b>&nbsp;&nbsp;
                <input type='file' id="inputFile" name="img" />
            @endif
        </div>
        <h4 class="text-center">აღწერა ქართულად</h4>
        <hr>
        <div class="form-group">
            <b>დასახელება:</b>
            <input type="text" name="ge_title" class="form-control" value="{{ $place->place_trans[0]->title or null }}">
        </div>
        <hr>
        <div class="form-group">
            <b>აღწერა:</b>
            <textarea name="ge_body" id="" cols="30" rows="10" class="form-control">{{ $place->place_trans[0]->body or null }}</textarea>
        </div>
        <hr>
        <h4 class="text-center">Description In English</h4>
        <hr>
        <div class="form-group">
            <b>Title:</b>
            <input type="text" name="en_title" class="form-control" value="{{ $place->place_trans[1]->title or null }}">
        </div>
        <hr>
        <div class="form-group">
            <b>Description:</b>
            <textarea name="en_body" id="" cols="30" rows="10" class="form-control">{{ $place->place_trans[1]->body or null }}</textarea>
        </div>
        <hr>
        <h4 class="text-center">Описание по русски</h4>
        <hr>
        <div class="form-group">
            <b>название:</b>
            <input type="text" name="ru_title" class="form-control" value="{{ $place->place_trans[2]->title or null }}">
        </div>
        <hr>
        <div class="form-group">
            <b>описание:</b>
            <textarea name="ru_body" id="" cols="30" rows="10" class="form-control">{{ $place->place_trans[2]->body or null }}</textarea>
        </div>
        <div class="form-group">
            {!! Form::submit('განახლება', ["class" => "btn btn-primary btn-lg btn-block"]) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection

@section("script")
<script>
    $(document).on("click", "button[data-remove-place-img]", function(e) {
        var delLink = $(this).attr("data-remove-place-img");
        bootbox.confirm({
            message: "გსურთ სურათის წაშლა?",
            callback: function(result){ }
        });
        $("button[data-bb-handler='confirm']").on("click",function(){
            $.ajax({
                headers: {'X-CSRF-Token': $('meta[name="csrf_token"]').attr('content')},
                url: delLink,
                data: {id : "{{ $place->id }}" },
            }).done(function() {
                window.location.reload();
            });
        });
    });
</script>
@endsection
