@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/notifications/create_notifications.css')}}">
@extends('layout.nav_admin')
@section('branch')
@include('layout.branch_button')
@endsection
@section('containt')
<div class="space-page container">
    <h1>create_notifications</h1>
</div>
<script src="{{asset('js/admin/notifications/create_notifications.js')}}" type="text/javascript"></script>
@endsection