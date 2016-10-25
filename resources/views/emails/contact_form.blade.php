<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <h4>{{ $data["username"] or null }}</h4>
    <p>{{ $data["email"] or null }}</p>
    <p>{{ $data["subject"] or null }}</p>
    <p>{{ $data["mail_text"] or null }}</p><br>
</body>
</html>