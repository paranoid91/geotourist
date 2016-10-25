@extends("admin/admin-app")

@section("css")

@endsection

@section("content")
<div class="container-fluid">
    <div class="row">
        <h2 class="text-center">ივენთების ტექსტი</h2>
        {!! Form::open(["method" => "POST", 'enctype' => 'multipart/form-data', 'action' => "AdminEventsController@saveText"]) !!}
            @if(session('msg'))
                <div class="alert alert-success text-center"><h4>{{session('msg')}}</h4></div>
            @endif
            <div class="form-group">
                <b>Text in English</b>
                @if(isset($texts[0]) && isset($texts[0]->en_main_text))
                    <textarea name="en_main_text" class="form-control" cols="50" rows="10">{{ $texts[0]->en_main_text }}</textarea>
                @else
                    <textarea name="en_main_text" class="form-control" cols="50" rows="10"></textarea>
                @endif
            </div>
            <div class="form-group">
                <b>ტექსტი ქართულად</b>
                @if(isset($texts[0]) && isset($texts[0]->ge_main_text))
                    <textarea name="ge_main_text" class="form-control" cols="50" rows="10">{{ $texts[0]->ge_main_text }}</textarea>
                @else
                    <textarea name="ge_main_text" class="form-control" cols="50" rows="10"></textarea>
                @endif
            </div>
            <div class="form-group">
                <b>текст по русски</b>
                @if(isset($texts[0]) && isset($texts[0]->ru_main_text))
                    <textarea name="ru_main_text" class="form-control" cols="50" rows="10">{{ $texts[0]->ru_main_text }}</textarea>
                @else
                    <textarea name="ru_main_text" class="form-control" cols="50" rows="10"></textarea>
                @endif
            </div>
        <div class="form-group ">
            {!! Form::submit('განახლება', ["class" => "btn btn-primary btn-lg  btn-block"]) !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection

@section("script")

@endsection
