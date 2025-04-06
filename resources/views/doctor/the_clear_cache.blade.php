@extends('layout.app')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/doctor/the_clear_cache.css')}}">
@extends('layout.nav_admin')
@section('containt')
<div class="space-page container">
    <h1>welcom in home the clear cache</h1>
</div>
<script src="{{asset('js/doctor/the_clear_cache.js')}}" type="text/javascript"></script>
@endsection
