@extends("admin/admin-app")

@section("css")

@endsection

@section("content")
    {!! Form::open(["method" => "POST", 'enctype' => 'multipart/form-data', 'action' => ['AdminCarsController@catAdd']]) !!}
    @if(session('msg'))
        <div class="alert alert-success text-center"><h4>{{session('msg')}}</h4></div>
    @endif
    <h2 class="text-center">მანქანის კატეგორიები</h2>
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
        <div class="form-group">
            <input type="file" name="img">
        </div>
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
                    @foreach($c->car_cat_trans as $title)
                        <td>{{ $title->title }}</td>
                    @endforeach
                    <td>
                        <a href="{{action('AdminCarsController@catShow', ["id" => $c->id])}}" type="button" class="btn btn-info">
                            <span class="glyphicon glyphicon-edit"></span>&nbsp;განახლება
                        </a>
                        <a href="#" type="button" class="dele-cat btn btn-danger" title="წაშლა"
                           data-rm-cat-link="{{action('AdminCarsController@catDelete', ['id' => $c->id])}}">
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
<script>
$(document).on("click", "a.dele-cat", function(e) {
    var delLink = $(this).attr("data-rm-cat-link");
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
