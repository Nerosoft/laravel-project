@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/reception/invoices.css')}}">
@section('containt')
@extends('layout.nav_admin')
<div class="space-page container">
    <h1>Invoices</h1>
</div>
<script src="{{asset('js/admin/reception/invoices.js')}}" type="text/javascript"></script>
@endsection