@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/test_cultures/all_test_cultures.css')}}">
@extends('layout.nav_admin')
@section('branch')
@include('layout.branch_button')
@endsection
@section('containt')
<div class="space-page container">
<button class="btn btn-primary" onClick="openForm('createModel')">{{$lang->button1}}</button>
@include('layout.all_models.all_tests.create_edit_tests')
<table id="example" class="table table-striped">
    <thead>
            <tr>
                <th>{{$lang->table7}}</th>
                <th>{{$lang->table8}}</th>
                <th>{{$lang->table12}}</th>
                <th>{{$lang->table9}}</th>
                <th>{{$lang->table10}}</th>
                <th>{{$lang->table11}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach(array_reverse($lang->arr1) as $index=>$test)
            <tr>
                <th>{{$loop->index+1}}</th>
                <th>{{$test->getName()}}</th>
                <th>{{$test->getShortcut()}}</th>
                <th>{{$test->getPrice()}}</th>
                <th>{{$test->getInputOutputLabId()}}</th>
                <th>
                @include('layout.model_delete', ['name'=>$test->getName()])
                <i class="bi bi-wrench-adjustable edit" onclick="displayEditForm('editModel{{$index}}', $('#editForm{{$index}}').find('#name'), $('#editForm{{$index}}').find('#shortcut'), $('#editForm{{$index}}').find('#price'), $('#editForm{{$index}}').find('#input-output-lab option'), '{{$test->getName()}}', '{{$test->getShortcut()}}', '{{$test->getPrice()}}', '{{$test->getInputOutputLabId()}}')"></i>
                @include('layout.all_models.all_tests.create_edit_tests')
                </th>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
             <tr>
                <th>{{$lang->table7}}</th>
                <th>{{$lang->table8}}</th>
                <th>{{$lang->table12}}</th>
                <th>{{$lang->table9}}</th>
                <th>{{$lang->table10}}</th>
                <th>{{$lang->table11}}</th>
            </tr>
        </tfoot>
        
</table>
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
    <div id="myToast3" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error9 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast4" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error10 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast5" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error3 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast6" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error4 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
<script src="{{asset('js/admin/test_cultures/all_test_cultures.js')}}" type="text/javascript"></script>
@extends('layout.table_setting')
@endsection
