@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/reporting/workload_daily.css')}}">
@section('containt')
@extends('layout.nav_admin')
<div class="space-page container">
    <h1>workload_daily</h1>
</div>
<script src="{{asset('js/admin/reporting/workload_daily.js')}}" type="text/javascript"></script>
@endsection