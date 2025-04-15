@extends('layout.app')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/clear_cache.css')}}">
@extends('layout.nav_admin')
@section('branch')
    <div class="dropdown">
        <a class="btn btn-danger dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{$lang->selectBox3}}
        </a>
        <ul class="dropdown-menu">
        <li><a class="dropdown-item {{request()->session()->get('userId') === request()->session()->get('userLogout') ? 'active' : ''}}" href="{{ route('branchMain', request()->session()->get('userLogout')) }}">{{$lang->selectBox4}}</a></li>
        @foreach($lang->MyBranch as $branch)
        <li><a class="dropdown-item {{request()->session()->get('userId') === $branch->getId()? 'active' : ''}}" href="{{ route('branchMain', $branch->getId()) }}">{{$branch->getName()}}</a></li>
        @endforeach
        </ul>
    </div>
@endsection
@section('containt')
<div class="space-page container">
    <h1>welcom in home clear_cache</h1>
</div>
<script src="{{asset('js/admin/clear_cache.js')}}" type="text/javascript"></script>
@endsection
