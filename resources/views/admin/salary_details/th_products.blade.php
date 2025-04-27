@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/salary_details/th_products.css')}}">
@extends('layout.nav_admin')
@section('branch')
@include('layout.branch_button')
@endsection
@section('containt')
<div class="space-page container">
    <h1>th_products</h1>
</div>
<script src="{{asset('js/admin/salary_details/th_products.js')}}" type="text/javascript"></script>
@endsection