@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/price_list/packages.css')}}">
@section('containt')
@extends('layout.nav_admin')
<div class="space-page container">
    <h1>packages</h1>
</div>
<script src="{{asset('js/admin/price_list/packages.js')}}" type="text/javascript"></script>
@endsection