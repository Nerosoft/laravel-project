@extends('layout.app')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/patent/dashboard.css')}}">
@section('containt')
@extends('layout.nav_admin')
<div class="space-page container">
    <h1>welcom in home patent</h1>
</div>
<script src="{{asset('js/patent/dashboard.js')}}" type="text/javascript"></script>
@endsection
