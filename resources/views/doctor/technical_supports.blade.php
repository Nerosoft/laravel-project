@extends('layout.app')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/doctor/technical_supports.css')}}">
@extends('layout.nav_admin')
@section('containt')
<div class="space-page container">
    <h1>welcom in home technical supports</h1>
</div>
<script src="{{asset('js/doctor/technical_supports.js')}}" type="text/javascript"></script>
@endsection
