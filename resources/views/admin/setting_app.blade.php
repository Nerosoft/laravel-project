@extends('layout.app')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/setting_app.css')}}">
@section('containt')
@extends('layout.nav_admin')
<div class="space-page container">
    <h1>welcom in home setting app</h1>
</div>
<script src="{{asset('js/admin/setting_app.js')}}" type="text/javascript"></script>
@endsection
