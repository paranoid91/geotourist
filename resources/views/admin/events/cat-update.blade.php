@extends("admin/admin-app")

@section("content")
    @if(isset($cat) && !empty($cat))
        {!! Form::open(["method" => "POST", 'enctype' => 'multipart/form-data', 'action' => ['AdminEventsController@catUpdate', $cat->id ]]) !!}
        @if(session('msg'))
            <div class="alert alert-success text-center"><h4>{{session('msg')}}</h4></div>
        @endif
        <h2 class="text-center">კატეგორიის განახლება</h2>
        <hr>
        <div class="form-group">
            <p><b>კატეგორიის დასახელენა ქართულად</b></p>
            <input type="text" name="ge_title" value="{{ $cat->event_cat_trans[0]->title or '' }}" class="form-control" />
        </div>
        <div class="form-group">
            <p><b>Category title in English</b></p>
            <input type="text" name="en_title" value="{{ $cat->event_cat_trans[1]->title or ''  }}" class="form-control" />
        </div>
        <div class="form-group">
            <p><b>название категории по русски</b></p>
            <input type="text" name="ru_title" value="{{ $cat->event_cat_trans[2]->title or ''  }}" class="form-control" />
        </div>
        <hr>
        <div class="container-fluid">
            <div class="row" id="list-row">
                @if($cat->img != '' && $cat->img != '0' && file_exists(public_path() . $cat->img))
                    <p><b>სურათი:</b></p>
                    <div style="margin: 40px" class="col-sm-10 col-md-10 col-lg-10">
                        <img src="{{ asset($cat->img) }}" alt="აირჩიეთ სურათი">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="button" class="btn btn-danger tour-delete-btn" data-name="{{ $cat->img }}" data-del-cat-img="{{action('AdminEventsController@removeCatImage', ["id" => $cat->id]) }}">
                            <span class="glyphicon glyphicon-remove"></span>&nbsp;წაშლა
                        </button>
                    </div>
                @else
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
                @endif
        </div>

        <div class="form-group sub-but" style="margin-top: 80px">
            {!! Form::submit('განახლება', ["class" => "btn btn-primary btn-lg btn-block"]) !!}
        </div>
        {!! Form::close() !!}
    @endif
@endsection

@section("script")
<script src="{{ asset("/js/cropp.js") }}"></script>
<script>
    $(document).on("click", "button[data-del-cat-img]", function(e) {
        var delLink = $(this).attr("data-del-cat-img");

        bootbox.confirm({
            message: "გსურთ აღნიშნული სურათის წაშლა?",
            callback: function(result){ }
        });
        $("button[data-bb-handler='confirm']").on("click",function(){
            $.ajax({
                headers: {'X-CSRF-Token': $('meta[name="csrf_token"]').attr('content')},
                url: delLink,
                data: {id : "{{ $cat->id }}" },
            }).done(function() {
                window.location.reload();
            });
        });
    });
</script>
@endsection
