@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/salary_details/th_suppliers.css')}}">
@section('containt')
@extends('layout.nav_admin')
<div class="space-page container">
    <h1>th_suppliers</h1>
</div>
<script src="{{asset('js/admin/salary_details/th_suppliers.js')}}" type="text/javascript"></script>
@endsection