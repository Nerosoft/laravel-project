@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/all_language.css')}}">
@extends('layout.nav_admin')
                    
@section('containt')
<div class="start_page container">

    <table id="example" class="table table-striped" >
        <thead>
            <tr>
                <th>{{$lang->table9}}</th>
                @if($state)
                <th>{{$lang->table10}}</th>
                @endif
                <th>{{$lang->table7}}</th>
                <th>{{$lang->table8}}</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($table as $index =>$data)
            <tr>
                <td>#{{$loop->index + 1}}</td>
                @if($state)
                <td>{{$data['languageName']}}</td>
                @endif
                <td>{{$data['name']}}</td>
                <td>
                    @if($data['id'] != 'Html')
                    @include('layout.all_models.admin.setting_language', ['type'=>$data['id']])
                    <i class="bi bi-wrench-adjustable edit" onclick="displayEditForm('editModel{{$index}}', $('#editForm{{$index}}').find('#word'), '{{$data['name']}}')"></i>
                    @else
                    @include('layout.all_models.admin.setting_language')
                    <i class="bi bi-wrench-adjustable edit" onclick="displayEditForm2('editModel{{$index}}', $('#editForm{{$index}}').find('#mySelectBox option'), '{{$data['name']}}')"></i>
                    @endif
                </td>
            </tr>
        @endforeach
            
        </tbody>
        <tfoot>
            <tr>
                <th>{{$lang->table9}}</th>
                @if($state)
                <th>{{$lang->table10}}</th>
                @endif
                <th>{{$lang->table7}}</th>
                <th>{{$lang->table8}}</th>
            </tr>
        </tfoot>
    </table>
</div>
<script type="text/javascript">
let setting = @json($state) ? [
                { 'searchable': true },
                { 'searchable': false },
                { 'searchable': true },
                { 'searchable': false }
            ]:
            [
                { 'searchable': true },
                { 'searchable': true },
                { 'searchable': false }
            ]
</script>
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
<script src="{{asset('js/all_language.js')}}" type="text/javascript"></script>
@extends('layout.table_setting')
@endsection