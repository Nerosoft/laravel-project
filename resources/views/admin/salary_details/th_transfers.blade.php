@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/salary_details/th_transfers.css')}}">
@section('containt')
@extends('layout.nav_admin')
<div class="space-page container">
    <h1>th_transfers</h1>
</div>
<script src="{{asset('js/admin/salary_details/th_transfers.js')}}" type="text/javascript"></script>
@endsection