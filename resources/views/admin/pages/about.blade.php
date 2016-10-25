@extends("admin/admin-app")

@section("content")
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                {!! Form::open(["method" => "POST", 'enctype' => 'multipart/form-data', 'action' => "AdminController@updateAboutText"]) !!}
                @if(session('msg'))
                    <div class="alert alert-success text-center"><h4>{{session('msg')}}</h4></div>
                @endif
                @if(session('bad_msg'))
                    <div class="alert alert-warning text-center"><h4>{{session('bad_msg')}}</h4></div>
                @endif
                <h3 class="text-center" style="padding:20px ">ჩვენ შესახებ ტესტი</h3>
                <div class="form-group"><span style="font-weight: bold"></span>
                    <h3>ტესტი ქართულად</h3>
                    <div class="row">
                        {!! Form::textarea('ge_body', (isset($texts[0]->ge_body) ? $texts[0]->ge_body : ''), ["class" => "form-control summernote"]) !!}
                    </div>
                </div>
                <div class="form-group"><span style="font-weight: bold"></span>
                    <h3>Text in English</h3>
                    <div class="row">
                        {!! Form::textarea('en_body', (isset($texts[0]->en_body) ? $texts[0]->en_body : ''), ["class" => "form-control summernote"]) !!}
                    </div>
                </div>
                <div class="form-group"><span style="font-weight: bold"></span>
                    <h3>текст по русски</h3>
                    <div class="row">
                        {!! Form::textarea('ru_body', (isset($texts[0]->ru_body) ? $texts[0]->ru_body : ''), ["class" => "form-control summernote"]) !!}
                    </div>
                </div>
                <div style="margin-bottom: 60px">
                    {!! Form::submit('შენახვა', ["class" => "btn btn-primary btn-lg btn-block"]) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

