<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <script src="{{asset('js/app.js')}}"></script>
</head>
<body>


<section class="fixed-top w-100" style="background: rgba(255,255,255,0.3)">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-auto">
                <img style="height: 50px;" src="/img/log.png" alt="">
            </div>
            <div class="col-auto row align-items-center">
                <a href="/" class="col mr-1 ml-1 btn btn-outline-dark">Фото</a>
                <a href="/" class="col mr-1 ml-1 btn btn-outline-dark">О нас</a>
                <a href="/" class="col mr-1 ml-1 btn btn-outline-dark">О нас</a>
            </div>
        </div>
    </div>
</section>

<section>
    <div style="position: fixed;z-index: -1">
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel" style="z-index: -3">
            <div class="carousel-inner">
                @foreach($photos as $url)
                    <div class="carousel-item @if($loop->first) active @endif" data-bs-interval="2000">
                        <img src="{{$url}}" class="d-block w-100" alt="...">
                    </div>
                @endforeach
            </div>
        </div>
        <div class="top-0 absolute w-100 h-100" style="background: rgba(0,0,0,0.4);z-index: -2"></div>
    </div>
    <div style="height: 50vw;">

    </div>
</section>
<section style="height: 1000px;background: white" class="container">

    <div class="p-4 d-flex flex-column align-items-center">
        <div style="font-size: 30px;" class="font-bold">Кто мы?!</div>
        <hr class="w-25 m-4">
        <div class="text-center">
            <div class="card-title" style="font-size: 25px">Мы дружный коллектив "Октава"!</div>
            <div class="card-text">
                Здесь все о нашей театральной жизни: <br>наших наставниках, новых постановках, участиях в фестивалях
                <br> и многом-многом другом.
            </div>

        </div>
    </div>




</section>
</body>
</html>
