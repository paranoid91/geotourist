var subAdd;

$(document).ready(function() {

    //preview image before upload
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image_upload_preview').attr('src', e.target.result).css({width: 600, margin: 40});
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#inputFile").change(function () {
        readURL(this);
    });

    //refresh divs
    $(document).on("click", "button[data-remove]", function(e) {
        var delLink = $(this).attr("data-remove");
        var img = $(this).attr("data-name");
        bootbox.confirm({
            message: "გსურთ აღნიშნული სურათის წაშლა?",
            callback: function(result){ }
        });
        $("button[data-bb-handler='confirm']").on("click",function(){
            $.ajax({
                headers: {'X-CSRF-Token': $('meta[name="csrf_token"]').attr('content')},
                url: delLink,
                data: {id : "{{ $tour->id }}", img : img},
            }).done(function() {
                window.location.reload();
            });
        });
    });

    //create input dinamiclly
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        x++; //text box increment
        $(wrapper).append('<div style="margin-top: 10px"><input type="text" data-type="videos" /><a href="#" class="remove_field"><img src="/img/remove-sign.png" alt="" width="20"></a></div>'); //add input box
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    });


    //get values from videos fields
    $(".tour-add-btn").click(function(e) {
        e.preventDefault();
        $("input[data-type=videos]").each(function(){
            if($(this).val() && $.trim($(this).val()) != "") {
                var iframe = $(this).val();
                $(iframe).css({display: "none"}).addClass("added-iframe").appendTo("body");
            }
        });
        if($("iframe.added-iframe")){
            $("iframe.added-iframe").each(function(){
                var val = $(this).attr('src');
                $("<input type='hidden' name='videos[]' value='"+ val +"' />").appendTo("form");
            });
        }
        $('.tour-add-form').submit();
    });


    //get values from videos fields(events)
    $(".event-add-btn").click(function(e) {
        e.preventDefault();
        $("input[data-type=videos]").each(function(){
            if($(this).val() && $.trim($(this).val()) != "") {
                var iframe = $(this).val();
                $(iframe).css({display: "none"}).addClass("added-iframe").appendTo("body");
            }
        });
        if($("iframe.added-iframe")){
            $("iframe.added-iframe").each(function(){
                var val = $(this).attr('src');
                $("<input type='hidden' name='videos[]' value='"+ val +"' />").appendTo("form");
            });
        }
        $('.event-add-form').submit();
    });


    //add photos/videos to gallery
    $(document).on("click", "button[data-name]", function(e) {
        var tour_id = $("form").attr("data-tour-id");
        var data_type = $(this).attr("data-name");
        var gallery = {};
        if(data_type == "add-picture"){
            $("input:checkbox[class = checkbox]:checked").each(function(k){
                gallery[k] = $(this).attr("data-gallery-id");
            });
            gallery = JSON.stringify(gallery);
            bootbox.confirm({
                message: "გსურთ აღნიშნული სურათების გალერეაში დამატება?",
                callback: function(result){ }
            });
        }else if(data_type == "add-video"){
            $("input:checkbox[class = checkbox-links]:checked").each(function(k){
                gallery[k] = $(this).attr("data-video-id");
            });
            gallery = JSON.stringify(gallery);
            bootbox.confirm({
                message: "გსურთ აღნიშნული ვიდეობის გალერეაში დამატება?",
                callback: function(result){ }
            });
        }
        $("button[data-bb-handler='confirm']").on("click",function(){
            $.ajax({
                headers: {'X-CSRF-Token': $('meta[name="csrf_token"]').attr('content')},
                url: "/{lang}/admin/tours/"+ tour_id +"/edit/addToGallery/"+ gallery + "/" + data_type,
                data : { id: tour_id, pics: gallery },
            }).done(function() {
                window.location.reload();
            });
        });
    });

    //Trumbowyg editor
    /*if($('.trumbowyg-demo').length > 0){
        $('.trumbowyg-demo').trumbowyg({
            fullscreenable: false,
            btns: ['viewHTML',
                '|', 'formatting',
                '|', 'btnGrp-design',
                '|', 'link',
                '|', 'insertImage',
                '|', 'btnGrp-justify',
                '|', 'btnGrp-lists',
                '|', 'horizontalRule'],
           btnsAdd: ['|', 'foreColor', 'backColor']
        });
    }*/

    if( $('.summernote').length > 0 ){

        $('.summernote').summernote({
		  fontNames: ['Arial', 'Helvetica', 'Courier New', "Times", 'Roboto Regular', 'Thai Sans Neue Regular', "Georgia", "Calibri", "Verdana", "Tahoma", "Times New Roman"],

          fontNamesIgnoreCheck: ['Arial', 'Helvetica', 'Courier New', "Times", 'Roboto Regular', 'Thai Sans Neue Regular', "Georgia", "Calibri", "Verdana", "Tahoma", "Times New Roman"],

  toolbar: [
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontname', ['fontname']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']],
    ["picture", ["picture"]],
    ["link", ["link"]],
    ["video", ["video"]],
    ["table", ["table"]],
    ["codeview", ["codeview"]],
    ["misc", ["undo", "redo", "he"]]
  ]

		});
	

    }



});