@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/change_language.css')}}">
@extends('layout.nav_admin')
@section('containt')
    <div class="space-page container">   
        <div class="text-left"> 
            <button class="btn btn-primary" onClick="openForm('createModel')">{{$lang->button1}}</button>
        <div>
        @include('layout.all_models.admin.change_language')
        <div class="text-center"> 
            <h1 id="greeting">{{$lang->label3}}</h1>
            <p id="description">{{$lang->label4}}</p>
        <div>
        <table id="example" class="table table-striped">
            <thead>
                <tr>
                    <th>{{$lang->table7}}</th>
                    <th>{{$lang->NameLangaue}}</th>
                    <th>{{$lang->table11}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lang->tableData as $index=>$myLang)
                <tr>
                    <th>{{$loop->index+1}}</th>
                    <th>{{$myLang->getName()}}</th>
                    <th>
                        <i class="bi bi-copy edit" onclick="openForm('copyModel{{$index}}')"></i>
                        @include('layout.all_models.admin.change_language')
                        <i class="{{$index === $lang->language ? 'bi bi-lightbulb-fill' : 'bi bi-lightbulb'}} edit" onclick="openForm('selectLanguage{{$index}}')"></i>
                        <div class="modal" id="selectLanguage{{$index}}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{$lang->title2}}</h5>
                                        <button type="button" onclick="closeForm('selectLanguage{{$index}}')" class="btn btn-dark">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{route('language.change')}}" method="POST" onsubmit="return validName($(this).find('#lang_name'))">
                                        <div class="modal-body">
                                            @csrf
                                            @include('layout.my_id', ['myId'=>$index])
                                            {{$lang->label5}}<spam>-{{$myLang->getName()}}</spam>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger">{{$lang->button4}}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @if($loop->index < (count($lang->tableData) - 2))
                        @include('layout.model_delete', ['name'=>$myLang->getName()])
                        @endif
                    </th>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>{{$lang->table7}}</th>
                    <th>{{$lang->NameLangaue}}</th>
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
</div> 
<script src="{{asset('js/admin/change_language.js')}}" type="text/javascript"></script>
@extends('layout.table_setting')
@endsection
