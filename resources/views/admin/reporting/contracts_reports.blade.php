@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/reporting/contracts_reports.css')}}">
@section('containt')
@extends('layout.nav_admin')
<div class="space-page container">
    <h1>contracts_reports</h1>
</div>
<script src="{{asset('js/admin/reporting/contracts_reports.js')}}" type="text/javascript"></script>
@endsection