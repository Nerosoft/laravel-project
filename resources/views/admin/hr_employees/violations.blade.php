@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/hr_employees/violations.css')}}">
@section('containt')
@extends('layout.nav_admin')
<div class="space-page container">
    <h1>violations</h1>
</div>
<script src="{{asset('js/admin/hr_employees/violations.js')}}" type="text/javascript"></script>
@endsection