@extends('layout.app')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/doctor/the_doctor_report.css')}}">
@section('containt')
@extends('layout.nav')
<div class="space-page container">
    <h1>welcom in home the doctor report</h1>
</div>
<script src="{{asset('js/doctor/the_doctor_report.js')}}" type="text/javascript"></script>
@endsection
