@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/inventory/purchases.css')}}">
@section('containt')
@extends('layout.nav_admin')
<div class="space-page container">
    <h1>purchases</h1>
</div>
<script src="{{asset('js/admin/inventory/purchases.js')}}" type="text/javascript"></script>
@endsection