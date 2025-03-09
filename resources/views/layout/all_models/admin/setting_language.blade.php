<div class="modal fade" id="editModel{{$index}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ isset($type) ? $lang->model1 : $lang->model2 }}</h5>
            <button type="button" onclick="closeForm('editModel{{$index}}')" class="btn btn-dark">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

            <div class="modal-body">
                    @if(isset($type))
                    <form id="editForm{{$index}}" action="{{isset($type) ? route('edit.editAllLanguage', $data['id'] != 'Menu' || $data['id'] ==='Menu' && !isset($data['item']) ? ['lang'=>$data['lang'], 'id'=>$data['id'], 'name'=>$data['myName']] : ['lang'=>$data['lang'], 'id'=>$data['id'], 'name'=>$data['myName'], 'item'=>$data['item']]) : route('edit.editAllLanguage', ['lang'=>$data['lang'], 'id'=>$data['id'], 'name'=>$data['myName']])}}" method="POST" onsubmit="return save(this)">
                    @else
                    <form id="editForm{{$index}}" action="{{isset($type) ? route('edit.editAllLanguage', $data['id'] != 'Menu' || $data['id'] ==='Menu' && !isset($data['item']) ? ['lang'=>$data['lang'], 'id'=>$data['id'], 'name'=>$data['myName']] : ['lang'=>$data['lang'], 'id'=>$data['id'], 'name'=>$data['myName'], 'item'=>$data['item']]) : route('edit.editAllLanguage', ['lang'=>$data['lang'], 'id'=>$data['id'], 'name'=>$data['myName']])}}" method="POST">
                    @endif

                    @csrf
                    @if(isset($type))
                    <div class="input-group input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-lg">{{$lang->label3}}</span>
                    </div>
                        <input type="text" name="word" id="word" value="{{$data['name']}}" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
                    </div>
                    @else
                    <h3>{{$lang->label4}} <span id="label" class="badge text-bg-secondary"></span></h3>
                    <select id="mySelectBox" name="dir" class="form-select" aria-label="Default select example">
                    @foreach($data['direction'] as $key =>$dir)
                    <option class="dropdown-item" {{strtolower($key) === strtolower($data['name']) ? 'selected':''}} value="{{strtolower($key)}}">{{$dir}}</option>
                    @endforeach
                    </select>
                    @endif
                </form>
            </div>

          <div class="modal-footer">
            <button type="submit" form="editForm{{$index}}" class="btn-save btn btn-primary">{{$lang->button3}}</button>
          </div> 

        </div>
      </div>
    </div>