@extends('layout.app')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/patent/home_visit.css')}}">
@section('containt')
@extends('layout.nav_admin')
<div class="space-page container">
    <h1>welcom in home visit</h1>
</div>
<script src="{{asset('js/patent/home_visit.js')}}" type="text/javascript"></script>
@endsection
