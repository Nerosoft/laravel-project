@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/reporting/inventory_report.css')}}">
@section('containt')
@extends('layout.nav_admin')
<div class="space-page container">
    <h1>inventory_report</h1>
</div>
<script src="{{asset('js/admin/reporting/inventory_report.js')}}" type="text/javascript"></script>
@endsection