@extends("admin/admin-app")

@section("css")

@endsection

@section("content")
    <h2 class="text-center">მთავარი გვერდი</h2>
    <h4><a href="{{ action("AdminController@mainTexts") }}"><u>მთავარი გვერდის ტექსტები</u></a></h4>
    <hr>
    {!! Form::open(["method" => "POST", 'enctype' => 'multipart/form-data', 'action' => "AdminController@addSliderImage"]) !!}
    @if(session('msg'))
        <div class="alert alert-success text-center"><h4>{{session('msg')}}</h4></div>
    @endif
    @if(session('bad_msg'))
        <div class="alert alert-warning text-center"><h4>{{session('bad_msg')}}</h4></div>
    @endif
    <h3 class="text-center" style="padding:20px ">სლაიდერის სურათები</h3>
    {!! Form::file('slider-pic', ['class' => 'field']) !!}
    {!! Form::submit('ატვირთვა', ["class" => "btn btn-primary btn-lg sld-btn"]) !!}
    {!! Form::close() !!}
    <div class="container-fluid">
            @if(count($pictures) > 0)
                @foreach($pictures as $pic)
                <div class="row">
                    <div class="col-lg-10">
                        <img src="{{ asset($pic->path) }}" alt="" class="img-responsive"/>
                    </div>
                    <div class="col-lg-2">
                        <div class="btn-group tour-btn-holder">
                            <a href="#" type="button" class="btn btn-danger tour-delete-btn" data-remove-pic="{{action('AdminController@removeSliderPic', ['id' => $pic->id]) }}">
                                <span class="glyphicon glyphicon-remove"></span>&nbsp;წაშლა
                            </a>
                        </div>
                    </div>
                </div>
                <hr>
                @endforeach
            @endif
    </div>
    <br>
@endsection

@section("script")
<script>

    $(document).on("click", "a[data-remove-pic]", function(e) {
            var delLink = $(this).attr("data-remove-pic");
            bootbox.confirm({
                message: "გსურთ აღნიშნული სურათის წაშლა?",
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
