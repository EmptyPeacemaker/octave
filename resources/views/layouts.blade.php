<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Октава</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">
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
                <a href="{{asset('photos')}}" class="col mr-1 ml-1 btn btn-outline-dark">Фото</a>
                <a href="{{asset('spectacle')}}" class="col mr-1 ml-1 btn btn-outline-dark">Спектакли</a>
                <div class="col mr-1 ml-1 btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#search">Поиск</div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="search" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                    <input type="text" class="form-control" name="search" id="recipient-name" placeholder="Поиск...">
            </div>
            <div class="modal-body">

                <div id="result"></div>
            </div>
        </div>
    </div>
</div>

@yield('body')
<script src="{{asset('js/app.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
<script>
    $('input[name=search]').change(function () {
        window.location='/spectacle/'+$(this).val();
    })
</script>
@yield('script')
</body>
</html>
