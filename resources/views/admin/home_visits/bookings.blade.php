@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/home_visits/bookings.css')}}">
@section('containt')
@extends('layout.nav_admin')
<div class="space-page container">
    <h1>bookings</h1>
</div>
<script src="{{asset('js/admin/home_visits/bookings.js')}}" type="text/javascript"></script>
@endsection