@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/safe_transfers/transfer_to_owner.css')}}">
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
    <h1>transfer_to_owner</h1>
</div>
<script src="{{asset('js/admin/safe_transfers/transfer_to_owner.js')}}" type="text/javascript"></script>
@endsection