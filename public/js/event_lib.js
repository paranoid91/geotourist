$(document).ready(function(){$(document).on("click","button[data-name]",function(a){var t=$("form").attr("data-tour-id"),n=$(this).attr("data-name"),e={};"add-picture"==n?($("input:checkbox[class = checkbox]:checked").each(function(a){e[a]=$(this).attr("data-gallery-id")}),e=JSON.stringify(e),bootbox.confirm({message:"გსურთ აღნიშნული სურათების გალერეაში დამატება?",callback:function(a){}})):"add-video"==n&&($("input:checkbox[class = checkbox-links]:checked").each(function(a){e[a]=$(this).attr("data-video-id")}),e=JSON.stringify(e),bootbox.confirm({message:"გსურთ აღნიშნული ვიდეობის გალერეაში დამატება?",callback:function(a){}})),$("button[data-bb-handler='confirm']").on("click",function(){$.ajax({headers:{"X-CSRF-Token":$('meta[name="csrf_token"]').attr("content")},url:"/{lang}/admin/events/"+t+"/edit/addToGallery/"+e+"/"+n,data:{id:t,pics:e}}).done(function(){window.location.reload()})})}),$(".event-add-btn").click(function(a){a.preventDefault(),$("input[data-type=videos]").each(function(){if($(this).val()&&""!=$.trim($(this).val())){var a=$(this).val();$(a).css({display:"none"}).addClass("added-iframe").appendTo("body")}}),$("iframe.added-iframe")&&$("iframe.added-iframe").each(function(){var a=$(this).attr("src");$("<input type='hidden' name='videos[]' value='"+a+"' />").appendTo("form"),console.log(a)})})}),$(document).on("click","button[data-add-to]",function(a){var t=$("form").attr("data-tour-id"),n=$(this).attr("data-add-to"),e={};"add-picture"==n?($("input:checkbox[class = checkbox]:checked").each(function(a){e[a]=$(this).attr("data-gallery-id")}),e=JSON.stringify(e),bootbox.confirm({message:"გსურთ აღნიშნული სურათების გალერეაში დამატება?",callback:function(a){}})):"add-video"==n&&($("input:checkbox[class = checkbox-links]:checked").each(function(a){e[a]=$(this).attr("data-video-id")}),e=JSON.stringify(e),bootbox.confirm({message:"გსურთ აღნიშნული ვიდეობის გალერეაში დამატება?",callback:function(a){}})),$("button[data-bb-handler='confirm']").on("click",function(){$.ajax({headers:{"X-CSRF-Token":$('meta[name="csrf_token"]').attr("content")},url:"/{lang}/admin/events/"+t+"/edit/addToGallery/"+e+"/"+n,data:{id:t,pics:e}}).done(function(){window.location.reload()})})});