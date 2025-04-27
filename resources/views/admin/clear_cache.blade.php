@extends('layout.app')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/clear_cache.css')}}">
@extends('layout.nav_admin')
@section('branch')
@include('layout.branch_button')
@endsection
@section('containt')
<div class="space-page container">
    <h1>welcom in home clear_cache</h1>
</div>
<script src="{{asset('js/admin/clear_cache.js')}}" type="text/javascript"></script>
@endsection
