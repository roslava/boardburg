@section('head')
    <head>
         <meta charset="UTF-8">
         <meta name="viewport"
               content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
         <meta http-equiv="X-UA-Compatible" content="ie=edge">
         <link rel="stylesheet" href="{{ asset("css/index.css") }}">
        <script src="{{mix('/js/app.js')}}" defer></script>
        <script
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Document</title>
    </head>
