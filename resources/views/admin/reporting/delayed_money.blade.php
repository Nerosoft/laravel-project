@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/reporting/delayed_money.css')}}">
@section('containt')
@extends('layout.nav_admin')
<div class="space-page container">
    <h1>delayed_money</h1>
</div>
<script src="{{asset('js/admin/reporting/delayed_money.js')}}" type="text/javascript"></script>
@endsection