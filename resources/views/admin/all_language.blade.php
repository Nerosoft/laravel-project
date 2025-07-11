@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/all_language.css')}}">
@extends('layout.nav_admin')  
@section('containt')
<div class="start_page container">
    <table id="example" class="table table-striped" >
        <thead>
            <tr>
                <th>{{$lang->table9}}</th>
                @if($active === 'SystemLang')
                <th>{{$lang->table10}}</th>
                @endif
                <th>{{$lang->table7}}</th>
                <th>{{$lang->table8}}</th>
            </tr>
        </thead>
        @php
            $index = 1
        @endphp
        <tbody id="table-data">
            @if($active === 'SystemLang')
                @foreach($lang->tableData as $myNameLang=>$data)
                    @foreach($data as $key=>$myData)
                        @if($key === 'Menu')
                            @foreach($myData as $key2=>$menu)      
                                <tr>
                                    <th>{{$index++}}</th>
                                    <th>{{$lang->tableData[$lang->language]['AllNamesLanguage'][$myNameLang]}}</th>
                                    <th>{{is_array($menu) ? $menu['Name'] : $menu}}</th>
                                    <th>
                                        <div class="modal fade" id="editModel{{$index}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">{{$lang->model1}}</h5>
                                                        <button type="button" onclick="closeForm('editModel{{$index}}')" class="btn btn-dark">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                            <form id="editForm{{$index}}" action="{{route('edit.editAllLanguage', ['lang'=>$myNameLang, 'id'=>$key, 'name'=>$key2]) }}" method="POST" onsubmit="return save(this)">
                                                            @csrf
                                                            <div class="input-group input-group-lg">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-lg">{{$lang->label3}}</span>
                                                            </div>
                                                                <input type="text" name="word" id="word" value="{{is_array($menu) ? $menu['Name'] : $menu}}" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
                                                            </div>
                                                        </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" form="editForm{{$index}}" class="btn-save btn btn-primary">{{$lang->button3}}</button>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <i class="bi bi-wrench-adjustable edit" onclick="displayEditForm('editModel{{$index}}', $('#editForm{{$index}}').find('#word'), '{{is_array($menu) ? $menu['Name'] : $menu}}')"></i> 
                                    </th>
                                </tr>
                                @if(is_array($menu))
                                    @foreach($menu['Item'] as $key3=>$item)
                                        <tr>
                                            <th>{{$index++}}</th>
                                            <th>{{$lang->tableData[$lang->language]['AllNamesLanguage'][$myNameLang]}}</th>
                                            <th>{{$item}}</th>
                                            <th>
                                                <div class="modal fade" id="editModel{{$index}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">{{$lang->model1}}</h5>
                                                                <button type="button" onclick="closeForm('editModel{{$index}}')" class="btn btn-dark">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                    <form id="editForm{{$index}}" action="{{route('edit.editAllLanguage', ['lang'=>$myNameLang, 'id'=>$key, 'name'=>$key2, 'item'=>$key3]) }}" method="POST" onsubmit="return save(this)">
                                                                    @csrf
                                                                    <div class="input-group input-group-lg">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text" id="inputGroup-sizing-lg">{{$lang->label3}}</span>
                                                                    </div>
                                                                        <input type="text" name="word" id="word" value="{{$item}}" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
                                                                    </div>
                                                                </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" form="editForm{{$index}}" class="btn-save btn btn-primary">{{$lang->button3}}</button>
                                                                </div> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <i class="bi bi-wrench-adjustable edit" onclick="displayEditForm('editModel{{$index}}', $('#editForm{{$index}}').find('#word'), '{{$item}}')"></i> 
                                            </th>
                                        </tr>
                                    @endforeach
                                @endif
                            @endforeach
                        @else
                        @foreach($myData as $key2=>$item)
                            <tr>
                                <th>{{$index++}}</th>
                                <th>{{$lang->tableData[$lang->language]['AllNamesLanguage'][$myNameLang]}}</th>
                                <th>{{$item}}</th>
                                <th>
                                    @if($key !== 'Html')
                                        <div class="modal fade" id="editModel{{$index}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">{{$lang->model1}}</h5>
                                                        <button type="button" onclick="closeForm('editModel{{$index}}')" class="btn btn-dark">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                            <form id="editForm{{$index}}" action="{{route('edit.editAllLanguage', ['lang'=>$myNameLang, 'id'=>$key, 'name'=>$key2]) }}" method="POST" onsubmit="return save(this)">
                                                            @csrf
                                                            <div class="input-group input-group-lg">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroup-sizing-lg">{{$lang->label3}}</span>
                                                            </div>
                                                                <input type="text" name="word" id="word" value="{{$item}}" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
                                                            </div>
                                                        </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" form="editForm{{$index}}" class="btn-save btn btn-primary">{{$lang->button3}}</button>
                                                        </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <i class="bi bi-wrench-adjustable edit" onclick="displayEditForm('editModel{{$index}}', $('#editForm{{$index}}').find('#word'), '{{$item}}')"></i>
                                    @else
                                        <div class="modal fade" id="editModel{{$index}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">{{$lang->model2}}</h5>
                                                        <button type="button" onclick="closeForm('editModel{{$index}}')" class="btn btn-dark">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                            <form id="editForm{{$index}}" action="{{route('edit.editAllLanguage', ['lang'=>$myNameLang, 'id'=>$key, 'name'=>$key2]) }}" method="POST">
                                                            @csrf
                                                            <h3>{{$lang->label4}} <span id="label" class="badge text-bg-secondary"></span></h3>
                                                            <select id="mySelectBox" name="word" class="form-select" aria-label="Default select example">
                                                            <option class="dropdown-item" {{$item === 'ltr'? 'selected':''}} value="ltr">{{$lang->Left}}</option>
                                                            <option class="dropdown-item" {{$item === 'rtl'? 'selected':''}} value="rtl">{{$lang->Right}}</option>
                                                            </select>
                                                        </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" form="editForm{{$index}}" class="btn-save btn btn-primary">{{$lang->button3}}</button>
                                                        </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <i class="bi bi-wrench-adjustable edit" onclick="displayEditForm2('editModel{{$index}}', $('#editForm{{$index}}').find('#mySelectBox option'), '{{$item}}')"></i>
                                    @endif
                                </th>
                            </tr>
                        @endforeach
                        @endif
                    @endforeach
                @endforeach
            @elseif($activeItem === 'Menu')
                @foreach($lang->tableData as $myKeyMenu=>$menu)      
                    <tr>
                        <th>{{$index++}}</th>
                        <th>{{is_array($menu) ? $menu['Name'] : $menu}}</th>
                        <th>
                            <div class="modal fade" id="editModel{{$index}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{$lang->model1}}</h5>
                                            <button type="button" onclick="closeForm('editModel{{$index}}')" class="btn btn-dark">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                                <form id="editForm{{$index}}" action="{{route('edit.editAllLanguage', ['lang'=>$active, 'id'=>$activeItem, 'name'=>$myKeyMenu]) }}" method="POST" onsubmit="return save(this)">
                                                @csrf
                                                <div class="input-group input-group-lg">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-lg">{{$lang->label3}}</span>
                                                </div>
                                                    <input type="text" name="word" id="word" value="{{is_array($menu) ? $menu['Name'] : $menu}}" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
                                                </div>
                                            </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" form="editForm{{$index}}" class="btn-save btn btn-primary">{{$lang->button3}}</button>
                                            </div> 
                                    </div>
                                </div>
                            </div>
                            <i class="bi bi-wrench-adjustable edit" onclick="displayEditForm('editModel{{$index}}', $('#editForm{{$index}}').find('#word'), '{{is_array($menu) ? $menu['Name'] : $menu}}')"></i> 
                        </th>
                    </tr>
                    @if(is_array($menu))
                        @foreach($menu['Item'] as $key3=>$item)
                            <tr>
                                <th>{{$index++}}</th>
                                <th>{{$item}}</th>
                                <th>
                                    <div class="modal fade" id="editModel{{$index}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{$lang->model1}}</h5>
                                                    <button type="button" onclick="closeForm('editModel{{$index}}')" class="btn btn-dark">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                        <form id="editForm{{$index}}" action="{{route('edit.editAllLanguage', ['lang'=>$active, 'id'=>$activeItem, 'name'=>$myKeyMenu, 'item'=>$key3]) }}" method="POST" onsubmit="return save(this)">
                                                        @csrf
                                                        <div class="input-group input-group-lg">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroup-sizing-lg">{{$lang->label3}}</span>
                                                        </div>
                                                            <input type="text" name="word" id="word" value="{{$item}}" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
                                                        </div>
                                                    </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" form="editForm{{$index}}" class="btn-save btn btn-primary">{{$lang->button3}}</button>
                                                    </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <i class="bi bi-wrench-adjustable edit" onclick="displayEditForm('editModel{{$index}}', $('#editForm{{$index}}').find('#word'), '{{$item}}')"></i> 
                                </th>
                            </tr>
                        @endforeach
                    @endif
                @endforeach
            @elseif($activeItem === 'Html')
                @foreach($lang->tableData as $key=>$data)
                    <tr>
                        <th>{{$index++}}</th>
                        <th>{{$data}}</th>
                        <th>
                            <div class="modal fade" id="editModel{{$index}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{$lang->model2}}</h5>
                                            <button type="button" onclick="closeForm('editModel{{$index}}')" class="btn btn-dark">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                                <form id="editForm{{$index}}" action="{{route('edit.editAllLanguage', ['lang'=>$active, 'id'=>$activeItem, 'name'=>$key]) }}" method="POST">
                                                @csrf
                                                <h3>{{$lang->label4}} <span id="label" class="badge text-bg-secondary"></span></h3>
                                                <select id="mySelectBox" name="word" class="form-select" aria-label="Default select example">
                                                <option class="dropdown-item" {{$data === 'ltr'? 'selected':''}} value="ltr">{{$lang->Left}}</option>
                                                <option class="dropdown-item" {{$data === 'rtl'? 'selected':''}} value="rtl">{{$lang->Right}}</option>
                                                </select>
                                            </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" form="editForm{{$index}}" class="btn-save btn btn-primary">{{$lang->button3}}</button>
                                            </div> 
                                    </div>
                                </div>
                            </div>
                            <i class="bi bi-wrench-adjustable edit" onclick="displayEditForm2('editModel{{$index}}', $('#editForm{{$index}}').find('#mySelectBox option'), '{{$data}}')"></i>
                        </th>
                    </tr>
                @endforeach
            @else
                @foreach($lang->tableData as $key=>$data)
                    <tr>
                        <th>{{$index++}}</th>
                        <th>{{$data}}</th>
                        <th>
                            <div class="modal fade" id="editModel{{$index}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{$lang->model1}}</h5>
                                            <button type="button" onclick="closeForm('editModel{{$index}}')" class="btn btn-dark">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                                <form id="editForm{{$index}}" action="{{route('edit.editAllLanguage', ['lang'=>$active, 'id'=>$activeItem, 'name'=>$key]) }}" method="POST" onsubmit="return save(this)">
                                                @csrf
                                                <div class="input-group input-group-lg">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-lg">{{$lang->label3}}</span>
                                                </div>
                                                    <input type="text" name="word" id="word" value="{{$data}}" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
                                                </div>
                                            </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" form="editForm{{$index}}" class="btn-save btn btn-primary">{{$lang->button3}}</button>
                                            </div> 
                                    </div>
                                </div>
                            </div>
                            <i class="bi bi-wrench-adjustable edit" onclick="displayEditForm('editModel{{$index}}', $('#editForm{{$index}}').find('#word'), '{{$data}}')"></i>
                        </th>
                    </tr>
                @endforeach
            @endif
        </tbody>

            
        <tfoot>
            <tr>
                <th>{{$lang->table9}}</th>
                @if($active === 'SystemLang')
                <th>{{$lang->table10}}</th>
                @endif
                <th>{{$lang->table7}}</th>
                <th>{{$lang->table8}}</th>
            </tr>
        </tfoot>
        </table>
</div>
<script type="text/javascript">
    let setting = @json($active === 'SystemLang') ? [
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
</div>
<script src="{{asset('js/admin/all_language.js')}}" type="text/javascript"></script>
@extends('layout.table_setting')
@endsection