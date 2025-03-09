@extends('layout.app')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/patent/our_branches.css')}}">
@section('containt')
@extends('layout.nav')
<div class="space-page container">
    <h1>welcom in home our branch</h1>
</div>
<script src="{{asset('js/patent/our_branches.js')}}" type="text/javascript"></script>
@endsection
