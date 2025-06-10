@extends('layout.app')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/login/user-register.css')}}">
@section('containt')
<div class="container">

<div class="user-register">
        <form id="form_data" action="{{route('register.registerUser')}}" method="POST" onsubmit="return validateFormRegisterAdmin()">
        @csrf
            @include('layout.email_password')
            <div class="form-group">
                <label for="password_confirmation">{{$lang->labelUserRepeatPassword}}</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                 placeholder="{{$lang->hintUserRepeatPassword}}">
            </div>
            <div class="form-group">
                <label for="codePassword">{{$lang->labelUserCodePassword}}</label>
                <input type="password" class="form-control" id="codePassword" name="codePassword"
                 value="{{old('codePassword')}}" placeholder="{{$lang->hintUserCodePassword}}">
            </div>
        </form>
        @include('layout.all_models.auth.language')
    </div>
</div>
@endsection
<!-- Toast Container -->
<div style="position: fixed; top: 10px; right: 10px;">
    @include('layout.error_email_password')
    <div id="myToast5" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error7 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast6" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->UserRepeatPasswordRequired }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast7" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->UserRepeatPassword }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast8" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error8 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast9" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error9 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
<script src="{{asset('js/login/user-login.js')}}" type="text/javascript"></script>
<script src="{{asset('js/login/user-register.js')}}" type="text/javascript"></script>
