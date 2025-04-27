@extends('layout.app')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/whatsapp.css')}}">
@extends('layout.nav_admin')
@section('branch')
@include('layout.branch_button')
@endsection
@section('containt')
<div class="space-page container">
    <h1>welcom in home whatsapp</h1>
</div>
<script src="{{asset('js/admin/whatsapp.js')}}" type="text/javascript"></script>
@endsection
