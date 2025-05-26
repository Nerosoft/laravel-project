@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/change_language.css')}}">
@extends('layout.nav_admin')
@section('branch')
@include('layout.branch_button')
@endsection
@section('containt')
    <div class="space-page container text-center">           
        <h1 id="greeting">{{$lang->label3}}</h1>
        <p id="description">{{$lang->label4}}</p>
        <table id="example" class="table table-striped">
            <thead>
                <tr>
                    <th>{{$lang->IdLangaue}}</th>
                    <th>{{$lang->NameLangaue}}</th>
                    <th>{{$lang->EditLangaue}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach(array_reverse($lang->myRadios) as $index=>$myLang)
                <tr>
                    <th>{{$loop->index+1}}</th>
                    <th>{{$myLang->getName()}}</th>
                    <th>
                    @if($loop->index < (count($lang->myRadios) - 2))
                    @include('layout.model_delete', ['name'=>$myLang->getName()])
                    <i class="bi bi-copy edit" onclick="openForm('LangModel0{{$index}}')"></i>
                    <i class="{{$index === $lang->language ? 'bi bi-lightbulb-fill' : 'bi bi-lightbulb'}} edit" onclick="openForm('LangModel1{{$index}}')"></i>
                    @for ($i = 0; $i < 2; $i++)
                        <div class="modal" id="LangModel{{$i.$index}}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{$i !== 0 ? $lang->title2 : $lang->title3}}</h5>
                                        <button type="button" onclick="closeForm('LangModel{{$i.$index}}')" class="btn btn-dark">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="LangForm{{$i.$index}}" action="{{$i !== 0 ? route('language.change') : route('language.copy')}}" method="POST" onsubmit="return @json($i) !== 0 ? true : validName($(this).find('#lang_name'))">
                                            @csrf
                                            <input type="hidden" id="language-select" name="language-select" value="{{$index}}">
                                            @if($i === 0)
                                            <div class="input-group input-group-lg mt-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-lg">{{$lang->label7}}</span>
                                            </div>
                                                <input type="text" name="lang_name" id="lang_name" value="{{old('lang_name')}}" placeholder='{{$lang->hint1}}' class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
                                            </div>
                                            @endif
                                        </form>
                                        {{$i !== 0 ? $lang->label5 : $lang->label6}}<spam>-{{$myLang->getName()}}</spam>
                                    </div>
                                    <div class="modal-footer">
                                        <button form="LangForm{{$i.$index}}" class="btn btn-danger">{{$i !== 0 ? $lang->button4 : $lang->button5}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                    @else
                    <i class="bi bi-copy edit" onclick="openForm('LangModel0{{$index}}')"></i>
                    <i class="{{$index === $lang->language ? 'bi bi-lightbulb-fill' : 'bi bi-lightbulb'}} edit" onclick="openForm('LangModel1{{$index}}')"></i>
                    @for ($i = 0; $i < 2; $i++)
                        <div class="modal" id="LangModel{{$i.$index}}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{$i !== 0 ? $lang->title2 : $lang->title3}}</h5>
                                        <button type="button" onclick="closeForm('LangModel{{$i.$index}}')" class="btn btn-dark">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="LangForm{{$i.$index}}" action="{{$i !== 0 ? route('language.change') : route('language.copy')}}" method="POST" onsubmit="return @json($i) !== 0 ? true : validName($(this).find('#lang_name'))">
                                            @csrf
                                            <input type="hidden" id="language-select" name="language-select" value="{{$index}}">
                                            @if($i === 0)
                                            <div class="input-group input-group-lg mt-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-lg">{{$lang->label7}}</span>
                                            </div>
                                                <input type="text" name="lang_name" id="lang_name" value="{{old('lang_name')}}" placeholder='{{$lang->hint1}}' class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
                                            </div>
                                            @endif
                                        </form>
                                        {{$i !== 0 ? $lang->label5 : $lang->label6}}<spam>-{{$myLang->getName()}}</spam>
                                    </div>
                                    <div class="modal-footer">
                                        <button form="LangForm{{$i.$index}}" class="btn btn-danger">{{$i !== 0 ? $lang->button4 : $lang->button5}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                    @endif   
                    </th>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>{{$lang->IdLangaue}}</th>
                    <th>{{$lang->NameLangaue}}</th>
                    <th>{{$lang->EditLangaue}}</th>
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
