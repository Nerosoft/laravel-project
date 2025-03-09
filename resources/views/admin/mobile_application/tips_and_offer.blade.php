@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/mobile_application/tips_and_offer.css')}}">
@section('containt')
@extends('layout.nav_admin')
<div class="space-page container">
    <h1>tips_and_offer</h1>
</div>
<script src="{{asset('js/admin/mobile_application/tips_and_offer.js')}}" type="text/javascript"></script>
@endsection