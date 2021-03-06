<html>
<head>
    <title>@yield('title', 'Larabbs') - Laravel </title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/style.css">

    <script src="/js/app.js"></script>
</head>
<body>
@include('layouts._header')
<div class="container" style="margin-top:100px;">
    <div class="col-md-offset-1 col-md-10">
        @include('shared._messages')
        @yield('content')
        @include('layouts._footer')
    </div>
</div>
</body>
</html>