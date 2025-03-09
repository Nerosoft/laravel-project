@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/accounting/expense_categories.css')}}">
@section('containt')
@extends('layout.nav_admin')
<div class="space-page container">
    <h1>expense_categories</h1>
</div>
<script src="{{asset('js/admin/accounting/expense_categories.js')}}" type="text/javascript"></script>
@endsection