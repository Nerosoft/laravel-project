@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/inventory/suppliers.css')}}">
@section('containt')
@extends('layout.nav_admin')
<div class="space-page container">
    <h1>suppliers</h1>
</div>
<script src="{{asset('js/admin/inventory/suppliers.js')}}" type="text/javascript"></script>
@endsection