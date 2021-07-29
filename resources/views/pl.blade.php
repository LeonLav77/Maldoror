<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="{{ url('/css/nyes.css') }}" rel="stylesheet">
    <title>Please authenticate</title>
    <style>
        html {
            height: 100%;
            width: 100%;
        }
        body {
            height: 100%;
            width: 100%;
        }
    </style>
</head>
<body>
    @include('navbar')
<div id="cont">
    <div id="box">
        <h1 id="naslov">Please login or sign up before continuing</h1>
        <a href="/login"><button>Login</button></a>
        <a href="/register"><button>Sign up</button></a>
    </div>
</div>
</body>
</html>