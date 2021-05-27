<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Вход</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <form method="post" action="{{route('login')}}" class="card" style="width: 18rem;">
            @csrf
            <div class="card-body">
                <h1 class="card-title">Вход</h1>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Login</label>
                    <input type="text" class="form-control" required name="login">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Password</label>
                    <input type="password" class="form-control" required name="password">
                </div>
                <button type="submit" class="btn btn-outline-primary">Войти</button>
            </div>
        </form>
    </div>
</body>
</html>
