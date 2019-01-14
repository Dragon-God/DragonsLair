<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"> --}}
        {!!HTML::style(URL::to('assets/css/app.css'))!!}
        <title>@yield('title')</title>
    </head>
    <body>
        @include('/_resources.includes._header')
        {{-- @include('/_resources.includes._message') --}}
    	<div class="container">
    		@yield('content')
    	</div>
    </body>
</html>
