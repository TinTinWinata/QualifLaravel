<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('bootstrap/js/bootstrap.js') }}">

<style>
    .wrapper {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -60%);
        padding: 10px;
        display: flex;
        flex-direction: row;
    }

    .container {
        width: 600px;
    }

</style>

<body>
    <div class="wrapper">

        <div class="container">

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="./validate-login" method="post" class="form-signin">
                @csrf
                <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
                <input type="text" name="email" class="form-control" placeholder="Email address">
                <input type="password" name="password" class="form-control mt-1" placeholder="Password">
                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" name="remember" value="remember-me"> Remember me
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                <p class="mt-3 mb-3 text-muted">© 2020-2021</p>
            </form>

        </div>
</body>
</div>


</html>
