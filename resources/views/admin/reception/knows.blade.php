@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/reception/knows.css')}}">
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
<button class="btn btn-primary" onClick="openForm('createModel')">{{$lang->button1}}</button>
@include('layout.all_models.admin.reception.knows')
<table id="example" class="table table-striped">
    <thead>
            <tr>
                <th>{{$lang->table7}}</th>
                <th>{{$lang->table8}}</th>
                <th>{{$lang->table11}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach(array_reverse($lang->knows) as $index=>$know)
            <tr>
                <th>{{$loop->index+1}}</th>
                <th>{{$know->getName()}}</th>
                <th>
                @include('layout.model_delete', ['name'=>$know->getName()])
                <i class="bi bi-wrench-adjustable edit" onclick="displayEditForm($('#editForm{{$index}}').find('#name'), 'editModel{{$index}}', '{{$know->getName()}}' )"></i>
                @include('layout.all_models.admin.reception.knows')
                </th>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
             <tr>
                <th>{{$lang->table7}}</th>
                <th>{{$lang->table8}}</th>
                <th>{{$lang->table11}}</th>
            </tr>
        </tfoot>
        
</table>
</div>
</div>
<!-- Toast Container -->
<div style="position: fixed; top: 70px; right: 10px; z-index: 9999;">
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
</div>
<script src="{{asset('js/admin/reception/knows.js')}}" type="text/javascript"></script>
@extends('layout.table_setting')
@endsection