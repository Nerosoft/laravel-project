@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/test_cultures/categories.css')}}">
@extends('layout.nav_admin')
@section('branch')
@include('layout.branch_button')
@endsection
@section('containt')
<div class="space-page container">
    <h1>categories</h1>
</div>
<script src="{{asset('js/admin/test_cultures/categories.js')}}" type="text/javascript"></script>
@endsection