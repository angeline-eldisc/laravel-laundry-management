<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | Laundry Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('auth/css/auth.css') }}">
    <style>
        .auth-link:hover{
            color: rgb(216, 215, 215)
        }
    </style>
</head>
<body>
    <div class="mx-4 mt-4" style="text-align: right;">
        <a href="{{ route('home') }}" class="auth-link" style="text-decoration: none;">
            <span style="margin-left: 1rem;" class="text-white">Home</span>
        </a>
        <span style="margin-left: 1rem;" class="text-white">|</span>
        <a href="{{ route('login') }}" class="auth-link" style="text-decoration: none;">
            <span style="margin-left: 1rem;" class="text-white">Login</span>
        </a>
    </div>
    <div class="center">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
