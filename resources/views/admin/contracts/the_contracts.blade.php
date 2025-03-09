@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/contracts/the_contracts.css')}}">
@section('containt')
@extends('layout.nav_admin')
<div class="space-page container">
    <h1>the_contracts</h1>
</div>
<script src="{{asset('js/admin/contracts/the_contracts.js')}}" type="text/javascript"></script>
@endsection