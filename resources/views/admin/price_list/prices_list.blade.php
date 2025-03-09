@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/price_list/prices_list.css')}}">
@section('containt')
@extends('layout.nav_admin')
<div class="space-page container">
    <h1>prices_list</h1>
</div>
<script src="{{asset('js/admin/price_list/prices_list.js')}}" type="text/javascript"></script>
@endsection