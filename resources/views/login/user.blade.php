@extends('layout.app')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/login/user-login.css')}}">
@section('containt')
<div class="container">

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="SettingLanguage">{{$lang->label4}}</h5>
        <button type="button" onClick="closeModel('{{ $userLanguage }}', 'exampleModal')" class="btn btn-dark">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="myForm" action="{{route('language.changeLanguage','login_admin')}}" method="POST" onsubmit="return validateLanguage('{{ $userLanguage }}')">
        @csrf
        <input type="hidden" name="userId" value = "{{$lang->RaysId}}">
            @foreach ($myRadios as $key =>$radios)
            <div class="form-check">
            <input name="mylanguage" class="flexCheck form-check-input" value="{{$key}}" onClick="setLanguage(this)" {{$key === $userLanguage ? 'checked' : ''}} type="checkbox">
            <label  class="form-check-label">
            {{$radios->Name}}
            </label>
            </div>
            @endforeach
        </form>
      </div>
      <div class="modal-footer">
      <button type="submit" form="myForm" class="btn btn-primary">{{$lang->button2}}</button>
      </div>
    </div>
  </div>
</div>

<div class="user-login">
        <h4>{{$lang->label3}}</h4>
        <form action="{{route('loginUser.loginUser')}}" method="POST" onsubmit="return validateForm()">
        @csrf
            <input type="hidden" name="userId" value = "{{$lang->RaysId}}">
            <div class="form-group">
                <label for="email">{{$lang->label1}}</label>
                <input type="text" class="form-control" id="email" name="email"
                 value="abdullah@rays.com" placeholder="{{$lang->hint1}}">
            </div>
            <div class="form-group">
                <label for="password">{{$lang->label2}}</label>
                <input type="password" class="form-control" value="12345678" id="password" name="password"
                 placeholder="{{$lang->hint2}}">
            </div>
            <button type="submit" class="btn btn-primary">{{$lang->button3}}</button>
            <button type="button" onClick="openForm('exampleModal')" class="btn btn-success">{{$lang->button1}}</button>
        </form>
    </div>
</div>
<!-- Toast Container -->
<div style="position: fixed; top: 10px; right: 10px;">
    <div id="myToast1" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error1 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast2" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error2 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast3" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error3 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast4" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error4 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
<script src="{{asset('js/login/user-login.js')}}" type="text/javascript"></script>
@endsection