@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/safe_transfers/transfer_to_owner.css')}}">
@extends('layout.nav_admin')
@section('branch')
@include('layout.branch_button')
@endsection
@section('containt')
<div class="space-page container">
    <h1>transfer_to_owner</h1>
</div>
<script src="{{asset('js/admin/safe_transfers/transfer_to_owner.js')}}" type="text/javascript"></script>
@endsection