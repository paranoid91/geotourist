@extends("admin/admin-app")

@section("css")

@endsection

@section("content")
   <div class="container-fluid">
       <h2 class="text-center">მანქანები</h2>
       @if(isset($car_img[0]) && !is_null($car_img[0]))
           <div class="row">
               <div style="margin-bottom: 40px" class="col-sm-10 col-md-10 col-lg-10">
                   <img class="img-responsive" src="{{ asset($car_img[0]->path) }}">
               </div>
               <div class="col-sm-2 col-md-2 col-lg-2" style="margin:40px 0">
                   <button href="#" type="button" class="btn btn-danger tour-delete-btn del-car-bg" data-bg-car-link="{{action('AdminCarsController@removeBG') }}">
                       <span class="glyphicon glyphicon-remove"></span>&nbsp;წაშლა
                   </button>
               </div>
           </div>
       @else
           {!! Form::open(["method" => "POST", 'enctype' => 'multipart/form-data', 'action' => "AdminCarsController@updateBG"]) !!}
           <div class="btn-group cropbox">
            <span class="btn btn-primary btn-file">
                <i class="glyphicon glyphicon-folder-open"></i>
                &nbsp;Browse <input type='file' name="path" />
            </span>
           </div>
           <hr class="tour-hr"/>
           <div class="form-group sub-but">
               {!! Form::submit('ატვირთვა', ["class" => "btn btn-primary btn-lg"]) !!}
           </div>
           {!! Form::close() !!}
           <hr>
       @endif
       <div class="row">
           <img src="{{ asset('/img/add-sign.png') }}" alt="" class="plus-sign-img">&nbsp;&nbsp;
           <a href="{{ action('AdminCarsController@categories') }}" type="button" class="btn btn-info">კატეგორიის დამატება/განახლება</a>
       </div>
       @if(isset($cat) && count($cat) > 0)
           <div class="row" style="margin-top:30px;">
               <img src="{{ asset('/img/add-sign.png') }}" alt="" class="plus-sign-img">&nbsp;&nbsp;
               <a href="{{ action("AdminCarsController@create") }}" type="button" class="btn btn-success">მანქანის დამატება</a>
           </div>
       @endif
       <hr>
       @if(isset($cars))
           @foreach($cars as $car)
               <div class="row" style="padding-left: 10px">
                   <div class="col-lg-10">
                       <div class="row" style="margin-top:10px">
                           <div class="col-sm-12 col-md-12 col-lg-12 tour-wrapper">
                               <div class="col-sm-4 col-md-4 col-lg-6 tour-wrapper-image no-padding">
                                   <a href="{{action('AdminCarsController@edit', ['id' => $car->id])}}">
                                       <img src="{{ asset($car->img) }}" style="border:2px solid #f1f1f1" height="200" width="320" />
                                   </a>
                               </div>
                               <div class="col-sm-5 col-md-5 col-lg-3 tour-wrapper-text">
                                   @if(!empty($car->car_trans[2]->title))
                                       <h3>{{$car->car_trans[2]->title}}</h3>
                                   @elseif(!empty($car->car_trans[1]->title))
                                       <h3>{{$car->car_trans[1]->title}}</h3>
                                   @elseif(!empty($car->car_trans[0]->title))
                                       <h3>{{$car->car_trans[0]->title}}</h3>
                                   @endif
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-lg-2">
                       <div class="btn-group tour-btn-holder">
                           <a href="{{action('AdminCarsController@edit', ['id' => $car->id])}}" type="button" class="btn btn-info tour-edit-btn">
                               <span class="glyphicon glyphicon-edit"></span>&nbsp;განახლება
                           </a>
                       </div>
                       <div class="btn-group tour-btn-holder">
                           <a href="#" type="button" class="btn btn-danger tour-delete-btn del-car" data-del-car-link="{{action('AdminCarsController@destroy', ['id' => $car->id]) }}">
                               <span class="glyphicon glyphicon-remove"></span>&nbsp;წაშლა
                           </a>
                       </div>
                   </div>
               </div>
               <hr>
           @endforeach
       @endif
   </div>
@endsection

@section("script")
<script>
    $(document).on("click", "a.del-car", function(e) {
        var delLink = $(this).attr("data-del-car-link");
        bootbox.confirm({
            message: "გსურთ აღნიშნული მანქანის წაშლა?",
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
<script>
    $(document).on("click", "button.del-car-bg", function(e) {
        var delLink = $(this).attr("data-bg-car-link");
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
