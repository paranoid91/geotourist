@extends("admin/admin-app")

@section("content")
    @if(session('msg'))
        <div class="alert alert-success text-center"><h4>{{session('msg')}}</h4></div>
    @endif
    {!! Form::open(["method" => "POST", 'enctype' => 'multipart/form-data', 'action' => ['AdminController@sendMessage']]) !!}
    <div class="form-group" style="margin-top: 50px">
        <h3 style="margin-bottom: 50px">მეილის გაგზავნა</h3>
        <b>სათაური:</b><br>
        <input type="text" class="form-control sec-input" name="subject"/>
    </div>
    <textarea class="form-control textar summernote" rows="10" name="mail_text"></textarea>
    <div class="form-group" style="margin-top: 30px">
        <input type="submit" class="btn btn-primary btn-lg btn-block" value="{{ trans('contact.submit') }}"/>
    </div>
    {!! Form::close() !!}
@endsection
