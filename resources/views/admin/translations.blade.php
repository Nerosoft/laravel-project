@extends('layout.app')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/translations.css')}}">
@section('containt')
@extends('layout.nav_admin')
<div class="space-page container">
    <h1>welcom in home translations</h1>
</div>
<script src="{{asset('js/admin/translations.js')}}" type="text/javascript"></script>
@endsection
