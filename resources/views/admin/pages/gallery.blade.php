@extends("admin/admin-app")

@section("css")

@endsection

@section("content")
<ul>
    <li><h3><a href="{{ action('AdminController@showToursGallery') }}">ტურების გალერეა</a></h3></li>
    <li><h3><a href="{{ action('AdminController@showEventsGallery') }}">ივენთების გალერეა</a></h3></li>
</ul>
@endsection

@section("script")

@endsection
