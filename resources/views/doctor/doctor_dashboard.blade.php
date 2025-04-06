@extends('layout.app')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/doctor/doctor_dashboard.css')}}">
@extends('layout.nav_admin')
@section('containt')
<div class="space-page container">
    <h1>welcom in home dashboard</h1>
</div>
<script src="{{asset('js/doctor/doctor_dashboard.js')}}" type="text/javascript"></script>
@endsection
