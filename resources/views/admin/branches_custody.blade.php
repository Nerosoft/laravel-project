@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/branches_custody.css')}}">
@section('containt')
@extends('layout.nav_admin')
<div class="space-page container">
    <h1>welcom in home branches_custody</h1>
</div>
<script src="{{asset('js/admin/branches_custody.js')}}" type="text/javascript"></script>
@endsection

