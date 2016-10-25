@extends("admin/admin-app")

@section("css")
@endsection

@section("content")
    {!! Form::open(["method" => "POST", 'enctype' => 'multipart/form-data', 'action' => ["AdminCarsController@update", "id" => $car->id], "class" => "car-add-form"]) !!}
    <div class="container-fluid">
        @include("errors/errors")
        @if(session('msg'))
            <div class="alert alert-success text-center"><h4>{{session('msg')}}</h4></div>
        @endif
        <ul class="nav nav-pills" style="font-size: 1.3em;">
            <li class="active"><a data-toggle="tab" href="#section_ge">აღწერა ქართულად</a></li>
            <li><a data-toggle="tab" href="#section_en">Description In English</a></li>
            <li><a data-toggle="tab" href="#section_ru">Oписание По Pусски</a></li>
        </ul>
        <div class="tab-content">
            <div id="section_ge" class="tab-pane fade in active tab-pane-holder">
                @include("admin/partials/edit-car-form-lang", ["lang" => "ge", "car" => $car->car_trans[0]])
            </div>
            <div id="section_en" class="tab-pane fade">
                @include("admin/partials/edit-car-form-lang", ["lang" => "en", "car" => $car->car_trans[1]])
            </div>
            <div id="section_ru" class="tab-pane fade">
                @include("admin/partials/edit-car-form-lang", ["lang" => "ru", "car" => $car->car_trans[2]])
            </div>
        </div>
        @if(isset($cat))
            <div class="form-group">
                <label for="sel1">აირჩიეთ კატეგორია:</label>
                <select class="form-control" id="sel1" name="category">
                    @foreach($cat->all() as $c)
                        @if(isset($car->car_cat->title) && $car->car_cat->title == $c->title)
                            <option selected="selected">{{ $c->title }}</option>
                        @else
                            <option>{{ $c->title }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <hr>
        @endif
        <div class="form-group">
            {!! Form::label('price','ღირებულება: ') !!}
            {!! Form::text('price', $car->price, ["class" => "form-control", "placeholder" => "მაგ. $ 1000"]) !!}
        </div>
        <hr class="tour-hr"/>
        <b>სურათი</b>&nbsp;&nbsp;

        @if($car->img == '' || $car->img == '0' || !file_exists(public_path() . $car->img))
            <div class="btn-group cropbox">
                <span class="btn btn-primary btn-file">
                    <i class="glyphicon glyphicon-folder-open"></i>
                    &nbsp;Browse <input type='file' class="inputFile" id="inputFile" name="img" />
                </span>
            </div>
            <div class="col-lg-12">
                <img id="image_upload_preview" class="img-responsive" src=""/>
                <hr class="tour-hr">
            </div>
        @else
            <div class="col-lg-12">
                <img class="image_upload" src="{{asset($car->img)}}" alt="აირჩიეთ ფონური სურათი">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-danger tour-delete-btn" data-remove-car-img="{{action('AdminCarsController@removeCarImage', ["id" => $car->id]) }}">
                    <span class="glyphicon glyphicon-remove"></span>&nbsp;წაშლა
                </button>
                <hr class="tour-hr">
            </div>
        @endif
        <hr class="tour-hr">
        <div class="container-fluid">
            <div class="row" style="margin: 50px 0">
                <h3>სურათების გალერეა</h3>
                @if(count($car->car_gallery) > 0)
                    @foreach($car->car_gallery as $pic)
                        @if(file_exists(public_path() . $pic->path))
                            <div style="display:inline-block; position: relative" class="gallery-images-holder">
                                <input type="checkbox" data-car-img-id="{{ $pic->id }}" class="checkbox" style="position: absolute; top:0;">
                                <img  src="{{ asset($pic->path) }}" style="width:160px; border:1px solid #333" />
                            </div>
                        @endif
                    @endforeach
                    @if(file_exists(public_path() . $pic->path))
                        <div style="padding: 40px;">
                            <button type="button" class="btn btn-danger tour-delete-btn"  data-img-gal-rem="gallery">
                                <span class="glyphicon glyphicon-remove"></span>&nbsp;აღნიშნული სურათების წაშლა
                            </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                        <hr>
                    @endif
                @endif

                <hr class="tour-hr">
                <p><b>ჩაყარეთ სურეთები (ან დააკლიკეთ)</b></p>
                <div id="dropZone" class="text-center dropzone needsclick dz-clickable dz-started">
                    <h3>Drop files here or click to upload</h3>
                    <div class="dz-preview dz-processing dz-image-preview dz-success dz-complete">
                        <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress="" style="width: 100%;"></span></div>
                        <div class="dz-error-message"><span data-dz-errormessage=""></span></div>
                        <div class="dz-error-mark">
                            <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                                <title>error</title>
                                <desc>Created with Sketch.</desc>
                                <defs></defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                                    <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">
                                        <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                    </div>
                    <div class="dz-preview dz-processing dz-image-preview dz-success dz-complete">
                        <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress="" style="width: 100%;"></span></div>
                        <div class="dz-error-message"><span data-dz-errormessage=""></span></div>
                        <div class="dz-error-mark">
                            <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                                <title>error</title>
                                <desc>Created with Sketch.</desc>
                                <defs></defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                                    <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">
                                        <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <hr class="tour-hr"/>
                <div class="form-group sub-but">
                    {!! Form::submit('შენახვა', ["class" => "btn btn-primary btn-lg car-add-btn btn-block"]) !!}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection

@section("script")
<script src="{{ asset('/js/dropzone.js') }}"></script>
<script>

$(document).on("click", "button[data-remove-car-img]", function(e) {
    var delLink = $(this).attr("data-remove-car-img");
    bootbox.confirm({
        message: "გსურთ სურათის წაშლა?",
        callback: function(result){ }
    });
    $("button[data-bb-handler='confirm']").on("click",function(){
        $.ajax({
            headers: {'X-CSRF-Token': $('meta[name="csrf_token"]').attr('content')},
            url: delLink,
            data: {id : "{{ $car->id }}" },
        }).done(function() {
            window.location.reload();
        });
    });
});

$(document).on("click", "button[data-img-gal-rem]", function(e) {
    var car_id = {{ $car->id }};
    var gallery = {};
    $("input:checkbox[class = checkbox]:checked").each(function(k){
        gallery[k] = $(this).attr("data-car-img-id");
    });
    gallery = JSON.stringify(gallery);
    bootbox.confirm({
        message: "გსურთ აღნიშნული სურათების წაშლა?",
        callback: function(result){ }
    });
    $("button[data-bb-handler='confirm']").on("click",function(){
        $.ajax({
            headers: {'X-CSRF-Token': $('meta[name="csrf_token"]').attr('content')},
            url: "/{lang}/admin/cars/"+ car_id +"/edit/removeGalleryPic/"+ gallery,
            data : { id: car_id, pics: gallery },
        }).done(function() {
            window.location.reload();
        });
    });
});


Dropzone.autoDiscover = false;
var myDropzone = new Dropzone("div#dropZone",  { url: "{{action('AdminCarsController@storeImage')}}",
    addRemoveLinks : true
} );
myDropzone.on('sending', function(file, xhr, formData){
    formData.append("_token", $('meta[name="csrf_token"]').attr('content'));

});
var i = 1;
myDropzone.on('complete', function(a, b, c){
    var src = JSON.parse(a.xhr.responseText).uploaded_path;
    $("<input type='hidden' name='gallery-img-" + i++ + "' value='"+ src + "'/>").appendTo('.car-add-form');
    addRemoveLinks : true;
});
</script>
@endsection
