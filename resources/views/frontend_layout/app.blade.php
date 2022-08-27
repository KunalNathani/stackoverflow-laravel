<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/css/bootstrap.min.css"/>
    <title>@yield('title', 'Stackoverflow')</title>
    @yield('page-level-styles')
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('frontend_layout.partials._message')
            </div>
        </div>
    </div>
    @yield('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/js/bootstrap.min.js"></script>
    @yield('page-level-scripts')
</body>
</html>
