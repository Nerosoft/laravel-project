@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/test_cultures/antibiotics.css')}}">
@section('containt')
@extends('layout.nav_admin')
<div class="space-page container">
    <h1>antibiotics</h1>
</div>
<script src="{{asset('js/admin/test_cultures/antibiotics.js')}}" type="text/javascript"></script>
@endsection