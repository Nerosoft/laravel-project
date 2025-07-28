<!DOCTYPE html>
<html dir="{{$lang->direction}}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- all css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{asset('css/rays.css')}}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap5.css" rel="stylesheet">
    <!-- all script -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script defer src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
    <script defer src="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap5.js"></script>
    <script src="{{asset('js/rays.js')}}" type="text/javascript"></script> -->
    
    <link href="{{asset('lib/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('lib/dataTables.bootstrap5.css')}}" rel="stylesheet">
    <link href="{{asset('lib/twitter-bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/rays.css')}}" rel="stylesheet">

    <script src="{{asset('lib/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('lib/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('lib/dataTables.js')}}" type="text/javascript"></script>
    <script src="{{asset('lib/dataTables.bootstrap5.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/rays.js')}}" type="text/javascript"></script>

    @extends('layout.display_error')
  </head>
  <body>
  @yield('containt')
</body>
</html>