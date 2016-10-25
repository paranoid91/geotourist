@extends("admin/admin-app")

@section("css")

@endsection

@section("content")
    @if(isset($cat) && !empty($cat))
        {!! Form::open(["method" => "POST", 'enctype' => 'multipart/form-data', 'action' => ['AdminCarsController@catUpdate', $cat->id ]]) !!}
        @if(session('msg'))
            <div class="alert alert-success text-center"><h4>{{session('msg')}}</h4></div>
        @endif
        <h2 class="text-center">კატეგორიის განახლება</h2>
        <hr>
        <div class="form-group">
            <p><b>კატეგორიის დასახელენა ქართულად</b></p>
            <input type="text" name="ge_title" value="{{ $cat->car_cat_trans[0]->title or '' }}" class="form-control" />
        </div>
        <div class="form-group">
            <p><b>Category title in English</b></p>
            <input type="text" name="en_title" value="{{ $cat->car_cat_trans[1]->title or ''  }}" class="form-control" />
        </div>
        <div class="form-group">
            <p><b>название категории по русски</b></p>
            <input type="text" name="ru_title" value="{{ $cat->car_cat_trans[2]->title or ''  }}" class="form-control" />
        </div>
        <hr>
        <div class="container-fluid">
            <div class="row" id="list-row">
                @if($cat->img != '' && $cat->img != '0' && file_exists(public_path() . $cat->img))
                    <p><b>სურათი:</b></p>
                    <div style="margin: 40px" class="col-sm-10 col-md-10 col-lg-10">
                        <img src="{{ asset($cat->img) }}" alt="აირჩიეთ სურათი" width="400">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="button" class="btn btn-danger tour-delete-btn" data-rem-cat-img="{{action('AdminCarsController@removeCatImg', ["id" => $cat->id]) }}">
                            <span class="glyphicon glyphicon-remove"></span>&nbsp;წაშლა
                        </button>
                    </div>
                @else
                    <div class="row">
                        <div class="form-group">
                            <input type="file" name="img">
                        </div>
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
        <script>
            $(document).on("click", "button[data-rem-cat-img]", function(e) {
                var delLink = $(this).attr("data-rem-cat-img");

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
