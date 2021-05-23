<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Панель админа</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<section class="fixed-top w-100" style="background: rgba(255,255,255,0.3)">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-auto">
                <a href="/">
                    <img style="height: 50px;" src="/img/log.png" alt="">
                </a>
            </div>
            <div class="col-auto row align-items-center">
                <a href="{{route('photo.index')}}" class="mr-1 ml-1 col-auto btn btn-outline-dark">Фото</a>
                <a href="{{route('request.index')}}" class="mr-1 ml-1 col-auto btn btn-outline-dark">Заявки</a>
                <a href="{{route('spectacle.index')}}" class="mr-1 ml-1 col-auto btn btn-outline-dark">Спектакли</a>
                <a href="{{route('logout')}}" class="mr-1 ml-1 col-auto btn btn-outline-dark">Выход</a>
            </div>
        </div>
    </div>
</section>
<div style="margin-top: 60px"></div>

@yield('body')

<script src="{{asset('js/app.js')}}"></script>
@yield('script')

</body>
</html>
