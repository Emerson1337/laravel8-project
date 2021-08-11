<!DOCTYPE html>
<html lang="{{config('app.local')}}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{config('app.name')}}</title>
</head>

<body>
    <header>
    </header>
    <div class="content">
        @yield('content')
    </div>
</body>

</html>
