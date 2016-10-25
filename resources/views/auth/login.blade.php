<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('/img/favicon.ico') }}">
    <title>ავტორიზაცია</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #eee;
        }

        .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }
        .form-signin .form-signin-heading,
        .form-signin .checkbox {
            margin-bottom: 10px;
        }
        .form-signin .checkbox {
            font-weight: normal;
        }
        .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
        }
        .form-signin .form-control:focus {
            z-index: 2;
        }
        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
</head>

<body>

<div class="container">
    @include("errors/errors")
    @if($errors->any())
       <div class="alert-danger">
           <ul>
               @foreach($errors as $error)
                    <li>{{ $error }}</li>
               @endforeach
           </ul>
       </div>
    @endif
    <form class="form-signin" method="POST" action="{{ action('Auth\AuthController@postLogin') }}">
        {!! csrf_field() !!}
        <h3 class="form-signin-heading text-center">გაიარეთ ავტორიზაცია</h3>
        
        <label for="email" class="sr-only"></label>
        <input type="text" name="email" id="email" class="form-control" placeholder="მეილი" required autofocus><br>
        <label for="password" class="sr-only"></label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="პაროლი" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">შესვლა</button>
    </form>

</div> <!-- /container -->


<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
