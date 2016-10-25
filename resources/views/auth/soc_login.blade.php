@extends("ancestor")

@section("title") {{ trans("main.login") }} @endsection

@section("css")
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link href="{{ asset('/css/bootstrap-social.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/login.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section("content")
<div class="container login-wr">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
            <div class="form-group">
                <a class="btn btn-social btn-facebook" data-soc="fb" data-type="soc-link" href="{{ action("Auth\AuthController@redirectToProvider") }}">
                    <span class="fa fa-facebook"></span>
                    Sign in with Facebook
                </a>&nbsp;&nbsp;&nbsp;
                <?php $href = "https://oauth.vk.com/authorize?client_id=5304987&display=page&redirect_uri=http://geotourist.ge/".App::getLocale()."/vk-callback&scope=friends&response_type=code&v=5.45"; ?>
                <a href="{{ $href }}" class="btn btn-social btn-vk" data-soc="vk" data-type="soc-link">
                    <span class="fa fa-vk"></span>
                    Sign in with Vkontakte
                </a>
            </div>
        </div>
        @include("ad")
    </div>
</div>
@endsection