@extends("admin/admin-app")

@section("css")

@endsection

@section("content")
        {!! Form::open(["method" => "POST", 'enctype' => 'multipart/form-data', 'action' => ['AdminEventsController@catAdd']]) !!}
        @if(session('msg'))
            <div class="alert alert-success text-center"><h4>{{session('msg')}}</h4></div>
        @endif
        <h2 class="text-center">კატეგორიები</h2>
        <h3 class="text-center">კატეგორიის დამატება</h3>
        <hr>
            <div class="form-group">
                <p><b>კატეგორიის დასახელენა ქართულად</b></p>
                <input type="text" name="ge_title" value="" class="form-control" />
            </div>
            <div class="form-group">
                <p><b>Category title in English</b></p>
                <input type="text" name="en_title" value="" class="form-control" />
            </div>
            <div class="form-group">
                <p><b>название категории по русски</b></p>
                <input type="text" name="ru_title" value="" class="form-control" />
            </div>
            <hr>
        <div class="container-fluid">
            <div class="row">
                <b>სურათი</b>&nbsp;&nbsp;
                <div class="btn-group cropbox">
                <span class="btn btn-primary btn-file">
                    <i class="glyphicon glyphicon-folder-open"></i>
                    <input type="file" id="imagePick"/>
                    &nbsp;Browse
                </span>
                </div>
                <hr class="tour-hr"/>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <canvas id="panel" width="360" height="300"></canvas>
                </div>
                <div class="col-lg-5">
                    <img id="crop_result" />
                </div>
            </div>
            <div class="row zoom-bar">
                <br>
                <span style="font-size:1.6">Zoom it: </span><input id='scaleSlider' type='range' min='.3' max='3.0' step='0.01' value='1.0' />
                <br>
                <button id="cropImgButtn" type="button" role="button" class="btn btn-success">Crop It!</button>
            </div>
        </div>
        <div class="hidden-img">
            <input type="hidden" value="" name="list_img" class="hidden-list-img" />
        </div>
        <hr>
        <div class="form-group sub-but">
            {!! Form::submit('დამატება', ["class" => "btn btn-primary btn-lg btn-block"]) !!}
        </div>
        {!! Form::close() !!}
        <h3 class="text-center" style="margin-top: 80px;">კატეგორიის განახლება</h3>
        @if(isset($cat) && count($cat) > 0)
            <table class="table">
                <thead>
                <tr>
                    <th>სათაური</th>
                    <th>Title</th>
                    <th>Название</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($cat as $c)
                <tr>
                    @foreach($c->event_cat_trans as $title)
                    <td>{{ $title->title }}</td>
                    @endforeach
                    <td>
                        <a href="{{action('AdminEventsController@catShow', ["id" => $c->id])}}" type="button" class="btn btn-info">
                            <span class="glyphicon glyphicon-edit"></span>&nbsp;განახლება
                        </a>
                        <a href="#" type="button" class="delete-cat-ev btn btn-danger" title="წაშლა"
                           data-del-link="{{action('AdminEventsController@catDelete', ['id' => $c->id])}}">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        @endif
@endsection

@section("script")
<script src="{{ asset('/js/cropp.js') }}"></script>
<script>
    $(document).on("click", "a.delete-cat-ev", function(e) {
        var delLink = $(this).attr("data-del-link");
        bootbox.confirm({
            message: "გსურთ აღნიშნული კატეგორის წაშლა?",
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
