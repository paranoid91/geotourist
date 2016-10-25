@extends("admin/admin-app")

@section("css")

@endsection

@section("content")
    <div class="container-fluid">
        <div class="row">
            @if(isset($mails) && count($mails) > 0)
                <table class="table">
                    <h3 style="padding: 20px 0"><a href="{{ action("AdminController@sendMail") }}" class="btn btn-info" type="button" role="button">მეილის გაგზავნა</a></h3>
                    @foreach($mails as $mail)
                        <tr>
                            <td style="width:260px">{{ $mail->email }}</td>
                            <td>
                                <button href="#" type="button" class="btn btn-danger delete-del-mail" title="წაშლა"
                                   data-del-mail="{{ action('AdminController@removeMail', ["id" => $mail->id]) }}">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>
@endsection

@section("script")
    <script>
        $(document).on("click", "button.delete-del-mail", function(e) {
            var delLink = $(this).attr("data-del-mail");
            bootbox.confirm({
                message: "გსურთ აღნიშნული მეილის წაშლა?",
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
