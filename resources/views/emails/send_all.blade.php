<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<p>{{ $data["subject"] or null }}</p>
<p>{!! $data["mail_text"] or null !!}</p><br>
</body>
</html>