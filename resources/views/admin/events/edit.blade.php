@extends("admin/admin-app")

@section("css")
    <link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
@endsection

@section("content")
{!! Form::open(["method" => "POST", 'enctype' => 'multipart/form-data', 'action' => ['AdminEventsController@update', $event->id], "class" => "event-add-form", "data-tour-id" => $event->id]) !!}
<div class="container-fluid">
    @include("errors/errors")
    @if(session('msg'))
        <div class="alert alert-success text-center"><h4>{{session('msg')}}</h4></div>
    @endif
    <ul class="nav nav-pills" style="font-size: 1.3em;">
        <li class="active"><a data-toggle="tab" href="#section_ge">ივენთის აღწერა ქართულად</a></li>
        <li><a data-toggle="tab" href="#section_en">Event Description In English</a></li>
        <li><a data-toggle="tab" href="#section_ru">Oписание Мероприятия По Pусски</a></li>
    </ul>
    <div class="tab-content">
        <div id="section_ge" class="tab-pane fade in active tab-pane-holder">
            @include("admin/partials/edit-event-form-lang", ["lang" => "ge", "event" => $event->event_trans[0]])
        </div>
        <div id="section_en" class="tab-pane fade">
            @include("admin/partials/edit-event-form-lang", ["lang" => "en", "event" => $event->event_trans[1]])
        </div>
        <div id="section_ru" class="tab-pane fade">
            @include("admin/partials/edit-event-form-lang", ["lang" => "ru", "event" => $event->event_trans[2]])
        </div>
    </div>
    <div class="form-group">
        <b>რეკლმაში დამატება</b><br>
        @if(isset($event->add_to_ad) && $event->add_to_ad == 1)
            {!! Form::checkbox('add_to_ad', 1, true) !!}
        @else
            {!! Form::checkbox('add_to_ad') !!}
        @endif
    </div>
    <div class="form-group" style="margin-top: 30px">
        <b>Upcoming Event( მონიშნეთ იმ შემთხვევაში თუ ივენთი არის 'upcomig')</b><br>
        @if($event->upcoming == '1')
            <input  name="upcoming" type="checkbox" value="1" class="inp-check-event-add" checked>
        @else
            <input  name="upcoming" type="checkbox" value="1" class="inp-check-event-add">
        @endif
    </div>
    <div class="form-group">
        <label for="sel1">აირჩიეთ ივენთის კატეგორია:</label>
        <select class="form-control" id="sel1" name="category">
        @foreach($cat as $c)
            @if(isset($event->cat->category) && $event->cat->category == $c->category)
                <option selected="selected">{{ $c->category }}</option>
            @else
                    <option>{{ $c->category }}</option>
            @endif
        @endforeach
        </select>
    </div>
    <hr>
    <div class="form-group">
        {!! Form::label('price','ტურის ღირებულება: ') !!}
        {!! Form::text('price', $event->price, ["class" => "form-control"]) !!}
    </div>
    <div class="form-group">
        <b>Google map: (ჩააკოპირეთ ლინკი)</b>
        @if($event->google_map != '')
            <input type="text" name="google_map" class="form-control" value="{{ $event->google_map }}">
        @else
            <input type="text" name="google_map" class="form-control">
        @endif
    </div>
    <hr class="tour-hr"/>
 <div class="form-group">
            <b>სტიკერი</b>
            @if($event->sticker == 1)
               {!! Form::select('sticker', array('0' => 'არ გააჩნია', '1' => 'upcoming', '2' => 'for_sale'), '1') !!}
            @elseif($event->sticker == 2)
               {!! Form::select('sticker', array('0' => 'არ გააჩნია', '1' => 'upcoming', '2' => 'for_sale'), '2') !!}
            @else
              {!! Form::select('sticker', array('0' => 'არ გააჩნია', '1' => 'upcoming', '2' => 'for_sale'), '0') !!}
            @endif
        </div>
    <div id="paralax-row">
        <b>ფონური სურათი</b>
        @if($event->paralax_img == '' || $event->paralax_img == '0' || !file_exists(public_path() . $event->paralax_img))
            <div class="btn-group cropbox">
          <span class="btn btn-primary btn-file">
            <i class="glyphicon glyphicon-folder-open"></i>
            &nbsp;Browse <input type='file' class="inputFile" id="inputFile" name="paralax_img" />
        </span>
            </div>
            <div class="col-lg-12">
                <img id="image_upload_preview" class="img-responsive" src=""/>
                <hr class="tour-hr">
            </div>
        @else
            <div class="col-lg-12">
                <img class="image_upload" src="{{asset($event->paralax_img)}}" alt="აირჩიეთ ფონური სურათი">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-danger tour-delete-btn" data-name="paralax" data-remove="{{action('AdminEventsController@removeTourImage', ["id" => $event->id,  "img" => "paralax"]) }}">
                    <span class="glyphicon glyphicon-remove"></span>&nbsp;წაშლა
                </button>
                <hr class="tour-hr">
            </div>
        @endif
    </div>
    <hr class="tour-hr">
    <div class="container-fluid">
        <div class="row" id="list-row">
            @if($event->list_img != '' && $event->list_img != '0' && file_exists(public_path() . $event->list_img))
                <b>ჩამონათვალის სურათი</b>
                <div class="col-lg-12">
                    <img src="{{ asset($event->list_img) }}" alt="აირჩიეთ სურათი">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-danger tour-delete-btn" data-name="list" data-remove="{{action('AdminEventsController@removeTourImage', ["id" => $event->id, "img" => "list"]) }}">
                        <span class="glyphicon glyphicon-remove"></span>&nbsp;წაშლა
                    </button>
                </div>
            @else
                <div class="row">
                    <b>ჩამონათვალის სურათი</b>&nbsp;&nbsp;
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
                        <canvas id="panel" width="390" height="250"></canvas>
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
        <div class="row" style="margin: 50px 0">
            <h3>გალერეა</h3>
            <hr class="tour-hr">
            @if(count($event->event_gallery) > 0)
                @foreach($event->event_gallery as $pic)
                    @if(file_exists(public_path() . $pic->path))
                        <div style="display:inline-block; position: relative" class="gallery-images-holder">
                            <input type="checkbox" data-gallery-id="{{ $pic->id }}" class="checkbox" style="position: absolute; top:0;">
                            <img  src="{{ asset($pic->path) }}" style="width:160px; border:1px solid #333" />
                        </div>
                    @endif
                @endforeach
                @if(file_exists(public_path() . $pic->path))
                    <div style="padding: 40px;">
                        <button type="button" class="btn btn-danger tour-delete-btn"  data-delete="gallery">
                            <span class="glyphicon glyphicon-remove"></span>&nbsp;აღნიშნული სურათების წაშლა
                        </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="button" class="btn btn-info" data-add-to="add-picture">
                            <span class="glyphicon glyphicon-plus-sign"></span>&nbsp;აღნიშნული სურათების დამატება გალერეაში
                        </button>
                    </div>
                    <hr>
                @endif
            @endif
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
           <div class="container-fluid">
               <hr class="tour-hr"/>
               <h3>ვიდეო გალერეა</h3>
               @if(count($event->event_videos) > 0)
                   <hr class="tour-hr"/>
                   <div style="margin-top: 40px;" class="iframes-holder">
                       @foreach($event->event_videos->all() as $video)
                           <div style="display: inline-block; position: relative">
                               <input type="checkbox" data-video-id="{{ $video->id }}" class="checkbox-links" style="position: absolute; top:0;">
                               <iframe src="{{ $video->src }}" frameborder="0" class="iframe-block" width="250" height="200" allowfullscreen></iframe>
                           </div>
                       @endforeach
                       <div style="margin-top: 40px;">
                           <button type="button" class="btn btn-danger tour-delete-btn"  data-delete-video="video">
                               <span class="glyphicon glyphicon-remove"></span>&nbsp;აღნიშნული ვიდეოების წაშლა
                           </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <button type="button" class="btn btn-info" data-add-to="add-video">
                               <span class="glyphicon glyphicon-plus-sign"></span>&nbsp;აღნიშნული ვიდეოების დამატება გალერეაში
                           </button>
                       </div>
                   </div>
               @endif
               <div class="input_fields_wrap">
                   <button class="add_field_button btn" type="button" role="button">ლინკის დამატება</button>
               </div>
           </div>
            <hr class="tour-hr"/>
            <div class="form-group sub-but">
                {!! Form::submit('განახლება', ["class" => "btn btn-primary btn-lg event-add-btn btn-block"]) !!}
            </div>
        </div>
</div>

{!! Form::close() !!}
@endsection

@section("script")
<script src="{{ asset('/js/crop.js') }}"></script>
<script src="{{ asset('/js/dropzone.js') }}"></script>
<script src="{{ asset('/js/event_lib.js') }}"></script>
<script>
    $(document).on("click", "button[data-delete-video]", function(e) {
        var tour_id = $("form").attr("data-tour-id");
        var links = {};
        $("input:checkbox[class = checkbox-links]:checked").each(function(k){
            links[k] = $(this).attr("data-video-id");
        });
        links = JSON.stringify(links);
        bootbox.confirm({
            message: "გსურთ აღნიშნული ვიდეოს წაშლა?",
            callback: function(result){ }
        });
        $("button[data-bb-handler='confirm']").on("click",function(){
            $.ajax({
                headers: {'X-CSRF-Token': $('meta[name="csrf_token"]').attr('content')},
                url: "/{lang}/admin/events/"+ tour_id +"/edit/removeVideo/"+ links,
                data : { id: tour_id, videos: links },
            }).done(function() {
                window.location.reload();
            });
        });
    });


    $(document).on("click", "button[data-delete]", function(e) {
        var tour_id = $("form").attr("data-tour-id");
        var gallery = {};
        $("input:checkbox[class = checkbox]:checked").each(function(k){
            gallery[k] = $(this).attr("data-gallery-id");
        });
        gallery = JSON.stringify(gallery);
        bootbox.confirm({
            message: "გსურთ აღნიშნული სურათის წაშლა?",
            callback: function(result){ }
        });
        $("button[data-bb-handler='confirm']").on("click",function(){
            $.ajax({
                headers: {'X-CSRF-Token': $('meta[name="csrf_token"]').attr('content')},
                url: "/{lang}/admin/events/"+ tour_id +"/edit/removeGalleryPic/"+ gallery,
                data : { id: tour_id, pics: gallery },
            }).done(function() {
                window.location.reload();
            });
        });
    });

    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("div#dropZone",  { url: "{{action('AdminEventsController@storeImagez')}}",
        addRemoveLinks : true
    } );
    myDropzone.on('sending', function(file, xhr, formData){
        formData.append("_token", $('meta[name="csrf_token"]').attr('content'));

    });
    var i = 1;
    myDropzone.on('complete', function(a, b, c){
        var src = JSON.parse(a.xhr.responseText).uploaded_path;
        $("<input type='hidden' name='gallery-img-" + i++ + "' value='"+ src + "'/>").appendTo('.event-add-form');
        addRemoveLinks : true;
    });

</script>
@endsection
