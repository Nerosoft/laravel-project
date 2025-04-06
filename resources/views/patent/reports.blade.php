@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/patent/reports.css')}}">
@section('containt')
@extends('layout.nav_admin')
<div class="space-page container">
    <h1>welcom in home reports</h1>
</div>
<script src="{{asset('js/patent/reports.js')}}" type="text/javascript"></script>
@endsection


