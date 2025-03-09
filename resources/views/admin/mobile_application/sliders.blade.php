@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/mobile_application/sliders.css')}}">
@section('containt')
@extends('layout.nav_admin')
<div class="space-page container">
    <h1>sliders</h1>
</div>
<script src="{{asset('js/admin/mobile_application/sliders.js')}}" type="text/javascript"></script>
@endsection