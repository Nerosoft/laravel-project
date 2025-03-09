@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/reception/vault.css')}}">
@section('containt')
@extends('layout.nav_admin')
<div class="space-page container">
    <h1>vault</h1>
</div>
<script src="{{asset('js/admin/reception/vault.js')}}" type="text/javascript"></script>
@endsection