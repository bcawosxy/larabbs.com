<html>
<head>
    <title>@yield('title', 'Larabbs') - Laravel </title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
@include('layout._header')
<div class="container">
    <div class="col-md-offset-1 col-md-10">
        @yield('content')
        @include('layout._footer')
    </div>
</div>
</body>
</html>