@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/reporting/safe_transfer_report.css')}}">
@section('containt')
@extends('layout.nav_admin')
<div class="space-page container">
    <h1>safe_transfer_report</h1>
</div>
<script src="{{asset('js/admin/reporting/safe_transfer_report.js')}}" type="text/javascript"></script>
@endsection