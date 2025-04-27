@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/inventory/transfers.css')}}">
@extends('layout.nav_admin')
@section('branch')
@include('layout.branch_button')
@endsection
@section('containt')
<div class="space-page container">
    <h1>transfers</h1>
</div>
<script src="{{asset('js/admin/inventory/transfers.js')}}" type="text/javascript"></script>
@endsection