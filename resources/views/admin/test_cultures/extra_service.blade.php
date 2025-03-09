@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/test_cultures/extra_service.css')}}">
@section('containt')
@extends('layout.nav_admin')
<div class="space-page container">
    <h1>extra service</h1>
</div>
<script src="{{asset('js/admin/test_cultures/extra_service.js')}}" type="text/javascript"></script>
@endsection