@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/contracts/labs_out.css')}}">
@extends('layout.nav_admin')
@section('branch')
@include('layout.branch_button')
@endsection
@section('containt')
<div class="space-page container">
    <h1>labs_out</h1>
</div>
<script src="{{asset('js/admin/contracts/labs_out.js')}}" type="text/javascript"></script>
@endsection