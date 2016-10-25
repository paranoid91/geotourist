@extends("admin/admin-app")

@section("css")

@endsection

@section("content")

<h2 class="text-center">მთავარი გვერდის ტექსტები</h2>
<hr>
{!! Form::open(["method" => "POST", 'enctype' => 'multipart/form-data', 'action' => "AdminController@updateTexts"]) !!}
@if(session('msg'))
    <div class="alert alert-success text-center"><h4>{{session('msg')}}</h4></div>
@endif
@if(session('bad_msg'))
    <div class="alert alert-warning text-center"><h4>{{session('bad_msg')}}</h4></div>
@endif
    <div class="form-group">
        <b>Title In English</b>
        <input type="text" name="en_headline" value="{{ $texts[0]->en_headline or null}}" class="form-control">
    </div>
    <div class="form-group">
        <b>სათაური ქართულად</b>
        <input type="text" name="ge_headline" value="{{ $texts[0]->ge_headline or null}}" class="form-control">
    </div>
    <div class="form-group">
        <b>заголовок по русски</b>
        <input type="text" name="ru_headline" value="{{ $texts[0]->ru_headline or null}}" class="form-control">
    </div>
    <h3 class="text-center" style="margin:30px 0">არ უნდა აღემატებოდეს 250 სიმბოლოს</h3>
    <div class="form-group">
        <b>Main Text In English</b>
        <textarea name="en_main_text" class="form-control" cols="50" rows="10">{{ $texts[0]->en_main_text or null }}</textarea>
    </div>
    <div class="form-group">
        <b>ქვეტექსტი ქართულად</b>
        <textarea name="ge_main_text" class="form-control" cols="50" rows="10">{{ $texts[0]->ge_main_text or null }}</textarea>
    </div>
    <div class="form-group">
        <b>текст по русски</b>
        <textarea name="ru_main_text" class="form-control" cols="50" rows="10">{{ $texts[0]->ru_main_text or null }}</textarea>
    </div>
{!! Form::submit('განახლება', ["class" => "btn btn-primary btn-lg sld-btn"]) !!}
{!! Form::close() !!}
<div class="container-fluid">

</div>
<br>

@endsection

@section("script")

@endsection
