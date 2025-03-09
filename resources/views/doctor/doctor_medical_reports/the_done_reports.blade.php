@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/doctor/doctor_medical_reports/the_done_reports.css')}}">
@section('containt')
@extends('layout.nav')
<div class="space-page container">
    <h1>welcom in home the_done_reports</h1>
</div>
<script src="{{asset('js/doctor/doctor_medical_reports/the_done_reports.js')}}" type="text/javascript"></script>
@endsection


