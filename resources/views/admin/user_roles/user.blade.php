@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/user_roles/user.css')}}">
@extends('layout.nav_admin')
@section('branch')
@include('layout.branch_button')
@endsection
@section('containt')
<div class="space-page container">
    <h1>user</h1>
</div>
<script src="{{asset('js/admin/user_roles/user.js')}}" type="text/javascript"></script>
@endsection