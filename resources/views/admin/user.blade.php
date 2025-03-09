@extends('layout.app')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/user-home.css')}}">
@extends('layout.nav_admin')
@section('containt')
<div class="home">   
<!-- Header -->
<div class="header d-flex justify-content-between align-items-center">
        <h1>{{ $lang->label9 }}</h1>
       
</div>
<!-- Main Content -->
<div class="container my-4">
        <div class="row">
            <div class="col-md-4 pt-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-currency-exchange"></i>
                             {{$lang->label3}}
                        </h5>
                        <p class="card-text d-none" id="totalVaul">234</p>
                        <a href="#" class="btn btn-primary" onclick="display('totalVaul')">{{$lang->button1}}</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 pt-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-currency-dollar"></i>
                            {{$lang->label4}}
                        </h5>
                        <p class="card-text d-none" id="receivedCach">5454</p>
                        <a href="#" class="btn btn-primary" onclick="display('receivedCach')">{{$lang->button2}}</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 pt-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-credit-card-fill"></i>
                            {{$lang->label5}}
                        </h5>
                        <p class="card-text d-none" id="receivedVisa">2342</p>
                        <a href="#" class="btn btn-primary" onclick="display('receivedVisa')">{{$lang->button3}}</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 pt-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-currency-euro"></i>
                            {{$lang->label6}}
                        </h5>
                        <p class="card-text d-none" id="custody">542</p>
                        <a href="#" class="btn btn-primary" onclick="display('custody')">{{$lang->button4}}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-currency-dollar"></i>
                            {{$lang->label7}}
                        </h5>
                        <p class="card-text d-none" id="expenses">437643</p>
                        <a href="#" class="btn btn-secondary" onclick="display('expenses')">{{$lang->button5}}</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-safe2"></i>
                            {{$lang->label8}}
                        </h5>
                        <p class="card-text d-none" id="safe">51 --- 80.3%</p>
                        <a href="#" class="btn btn-secondary" onclick="display('safe')">{{$lang->button6}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/admin/dashboard.js')}}" type="text/javascript"></script>
   



</div>
@endsection

