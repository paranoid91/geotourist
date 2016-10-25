@extends("admin/admin-app")

@section("css")

@endsection

@section("content")
    <div class="container-fluid">
        <h2 class="text-center">ადგილების დამატება</h2>
        @include("errors/errors")
        @if(session('msg'))
            <div class="alert alert-success text-center"><h4>{{session('msg')}}</h4></div>
        @endif
        {!! Form::open(["method" => "POST", 'enctype' => 'multipart/form-data', 'action' => "AdminController@placesStore"]) !!}
        <hr>
        <div class="form-group" style="margin-bottom: 30px">
            <b><h4>სურათი</h4></b>&nbsp;&nbsp;<br>
            <input type='file' id="inputFile" name="img" />
        </div>
        <h4 class="text-center">აღწერა ქართულად</h4>
        <hr>
        <div class="form-group">
            <b>დასახელება:</b>
            <input type="text" name="ge_title" class="form-control">
        </div>
        <hr>
        <div class="form-group">
            <b>აღწერა:</b>
            <textarea name="ge_body" id="" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <hr>
        <h4 class="text-center">Description In English</h4>
        <hr>
        <div class="form-group">
            <b>Title:</b>
            <input type="text" name="en_title" class="form-control">
        </div>
        <hr>
        <div class="form-group">
            <b>Description:</b>
            <textarea name="en_body" id="" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <hr>
        <h4 class="text-center">Описание по русски</h4>
        <hr>
        <div class="form-group">
            <b>название:</b>
            <input type="text" name="ru_title" class="form-control">
        </div>
        <hr>
        <div class="form-group">
            <b>описание:</b>
            <textarea name="ru_body" id="" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div class="form-group">
            {!! Form::submit('შენახვა', ["class" => "btn btn-primary btn-lg btn-block"]) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection

@section("script")
<script>

</script>
@endsection
