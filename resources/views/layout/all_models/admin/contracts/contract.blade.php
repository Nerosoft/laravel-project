<!-- Modal -->
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
        <form id="{{isset($index) ? 'editForm'.$index : 'createForm'}}" action="{{isset($index) ? route('editContract') : route('createContract')}}" method="POST" onsubmit="return validateContract($(this).find('#name'), $(this).find('#governorate'), $(this).find('#area'))">
            @csrf
                @isset($index)
                  @include('layout.my_id')
                @endisset   
                <div class="mb-3">
                    <label for="name" class="form-label">{{$lang->label3}}</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{isset($index) ? $contract->getName() : old('name')}}" placeholder="{{$lang->hint1}}">
                </div>
                <div class="mb-3">
                    <label for="governorate" class="form-label">{{$lang->label4}}</label>
                    <input type="text" class="form-control" id="governorate" name="governorate" value="{{isset($index) ? $contract->getGovernorate() : old('governorate')}}" placeholder="{{$lang->hint2}}">
                </div>
                <div class="mb-3">
                    <label for="area" class="form-label">{{$lang->label5}}</label>
                    <input type="text" class="form-control" id="area" name="area" value="{{isset($index) ? $contract->getArea() : old('area')}}" placeholder="{{$lang->hint3}}">
                </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="{{isset($index) ? 'editForm'.$index : 'createForm'}}" class="btn btn-primary">{{isset($index) ? $lang->button3 : $lang->button2}}</button>
      </div>
    </div>
  </div>
</div>