@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/medical_reports/sampleStatus.css')}}">
@section('containt')
@extends('layout.nav_admin')
<div class="space-page container">
    <h1>sampleStatus</h1>
</div>
<script src="{{asset('js/admin/medical_reports/sampleStatus.js')}}" type="text/javascript"></script>
@endsection