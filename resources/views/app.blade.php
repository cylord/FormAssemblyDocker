<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{ asset('css/bootstrap-responsive.min.css')}}" rel="stylesheet">
        <title>Laravel</title>
    </head>
    <body>
        <div id="root">

        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
