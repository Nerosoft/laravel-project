@extends('layout.app')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/doctor/doctor_dashboard.css')}}">
@section('containt')
@extends('layout.nav')
<div class="space-page container">
    <h1>welcom in home dashboard</h1>
</div>
<script src="{{asset('js/doctor/doctor_dashboard.js')}}" type="text/javascript"></script>
@endsection
