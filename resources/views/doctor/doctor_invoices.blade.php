@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/doctor/doctor_invoices.css')}}">
@extends('layout.nav_admin')
@section('containt')
<div class="space-page container">
    <h1>welcom in home invoices</h1>
</div>
<script src="{{asset('js/doctor/doctor_invoices.js')}}" type="text/javascript"></script>
@endsection

