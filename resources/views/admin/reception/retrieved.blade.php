@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/reception/retrieved.css')}}">
@section('containt')
@extends('layout.nav_admin')
<div class="space-page container">
    <h1>retrieved</h1>
</div>
<script src="{{asset('js/admin/reception/retrieved.js')}}" type="text/javascript"></script>
@endsection