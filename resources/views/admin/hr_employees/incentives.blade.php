@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/hr_employees/incentives.css')}}">
@section('containt')
@extends('layout.nav_admin')
<div class="space-page container">
    <h1>incentives</h1>
</div>
<script src="{{asset('js/admin/hr_employees/incentives.js')}}" type="text/javascript"></script>
@endsection