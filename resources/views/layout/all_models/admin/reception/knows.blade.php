<div class="modal fade" id="{{isset($index) ? 'editModel'.$index : 'createModel'}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="SettingLanguage">{{isset($index) ? $lang->title3 : $lang->title2}}</h5>
        <button type="button" onclick="closeForm('{{isset($index) ? "editModel".$index : "createModel"}}')" class="btn btn-dark">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="{{isset($index) ? 'editForm'.$index : 'createForm'}}" action="{{isset($index) ? route('editKnows') : route('createKnows')}}" method="POST" onsubmit="return validateKnows($(this).find('#name'))">
            @csrf
            @isset($index)
              <input type="hidden" value="{{$index}}" name="id">
            @endisset   
            <div class="mb-3">
              <label for="name" class="form-label">{{$lang->label3}}</label>
              <input type="text" class="form-control" id="name" value="{{isset($index) ? $know->getName() : old('name')}}" name="name" placeholder="{{$lang->hint1}}">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="{{isset($index) ? 'editForm'.$index : 'createForm'}}" class="btn btn-primary">{{isset($index) ? $lang->button3 : $lang->button2}}</button>
      </div>
    </div>
  </div>
</div>