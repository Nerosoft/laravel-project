@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/reporting/supplier_report.css')}}">
@extends('layout.nav_admin')
@section('branch')
@include('layout.branch_button')
@endsection
@section('containt')
<div class="space-page container">
    <h1>supplier_report</h1>
</div>
<script src="{{asset('js/admin/reporting/supplier_report.js')}}" type="text/javascript"></script>
@endsection