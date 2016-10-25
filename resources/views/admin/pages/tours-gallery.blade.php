@extends("admin/admin-app")

@section("css")

@endsection

@section("content")

<div class="container-fluid">
    <div class="row">
        @if($pics && count($pics) > 0)
            <h3 class="text-center">სურათების გალერეა</h3>
            @foreach($pics->all() as $pic)
                @if($pic->path != '' && $pic->path != '0' && file_exists(public_path() . $pic->path))
                    <div style="display:inline-block; position: relative" class="gallery-images-holder">
                        <input type="checkbox" data-gallery-id="{{ $pic->id }}" class="checkbox" style="position: absolute; top:0;" />
                        <img  src="{{ asset($pic->path) }}" style="width:160px; border:1px solid #333" />
                    </div>
                @endif
            @endforeach
            <div style="margin-top: 30px">
                <button type="button" class="btn btn-danger tour-delete-btn"  data-remove-gal="picture">
                    <span class="glyphicon glyphicon-remove"></span>&nbsp;აღნიშნული სურათების გალერეიდან წაშლა
                </button>&nbsp;
            </div>
        @endif
    </div>
    <div class="row" style="margin-top: 80px">
        @if($videos && count($videos) > 0)
            <h3 class="text-center">ვიდეო გალერეა</h3>
            @foreach($videos->all() as $video)
                @if($video->src != '' && $video->src != '0')
                    <div style="display: inline-block; position: relative">
                        <input type="checkbox" data-video-id="{{ $video->id }}" class="checkbox-links" style="position: absolute; top:0;">
                        <iframe src="{{ $video->src }}" frameborder="0" class="iframe-block" width="250" height="200" allowfullscreen></iframe>
                    </div>
                @endif
            @endforeach
            <div style="margin-top: 30px">
                <button type="button" class="btn btn-danger tour-delete-btn"  data-remove-gal="video">
                    <span class="glyphicon glyphicon-remove"></span>&nbsp;აღნიშნული ვიდეოების გალერეიდან წაშლა
                </button>
            </div>
        @endif
    </div>
</div>

@endsection

@section("script")
<script>
    $(document).on("click", "button[data-remove-gal]", function(e) {
        var data_type = $(this).attr("data-remove-gal");
        var gallery = {};
        if(data_type == "picture"){
            $("input:checkbox[class = checkbox]:checked").each(function(k){
                gallery[k] = $(this).attr("data-gallery-id");
            });
            gallery = JSON.stringify(gallery);
            bootbox.confirm({
                message: "გსურთ აღნიშნული სურათების გალერეიდან წაშლა?",
                callback: function(result){ }
            });
        }else if(data_type == "video"){
            $("input:checkbox[class = checkbox-links]:checked").each(function(k){
                gallery[k] = $(this).attr("data-video-id");
            });
            gallery = JSON.stringify(gallery);
            bootbox.confirm({
                message: "გსურთ აღნიშნული ვიდეობის გალერეიდან წაშლა?",
                callback: function(result){ }
            });
        }
        $("button[data-bb-handler='confirm']").on("click",function(){
            $.ajax({
                headers: {'X-CSRF-Token': $('meta[name="csrf_token"]').attr('content')},
                url: "/{lang}/admin/pages/gallery/tours-gallery/"+ gallery + "/" + data_type,
                data : { gallery: gallery, data_type: data_type },
            }).done(function() {
                window.location.reload();
            });
        });
    });
</script>
@endsection
