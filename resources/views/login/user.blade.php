@extends('layout.app')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/login/user-login.css')}}">
@section('containt')
<div class="container">
<div class="user-login">
        <form id="form_data" action="{{route('loginUser.loginUser')}}" method="POST" onsubmit="return validateFormLoginAdmin()">
        @csrf
            @include('layout.email_password')
        </form>
        @include('layout.all_models.auth.language')
    </div>
</div>
<!-- Toast Container -->
<div style="position: fixed; top: 10px; right: 10px;">
    @include('layout.error_email_password')
</div>
<script src="{{asset('js/login/user-login.js')}}" type="text/javascript"></script>
@endsection