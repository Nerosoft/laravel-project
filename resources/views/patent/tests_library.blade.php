@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/patent/tests_library.css')}}">
@section('containt')
@extends('layout.nav_admin')
<div class="space-page container">
    <h1>welcom in home test libirary</h1>
</div>
<script src="{{asset('js/patent/tests_library.js')}}" type="text/javascript"></script>
@endsection


