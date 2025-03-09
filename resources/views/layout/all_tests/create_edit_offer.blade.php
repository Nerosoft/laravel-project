<!-- Modal -->
<div class="modal fade" id="{{isset($index) ? 'editModel'.$index : 'createModel'}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="SettingLanguage">{{isset($index) ? $lang->title3 : $lang->title2}}</h5>
        <button type="button" onclick="closeForm('{{isset($index) ? "editModel".$index : 'createModel'}}')" class="btn btn-dark">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="{{isset($index) ? 'editForm'.$index : 'createForm'}}" action="{{isset($index) ? route('editCurrentOffers') : route('createCurrentOffers')}}" method="POST" onsubmit="return validateCurrentOffers($(this).find('#name'), $(this).find('#shortcut'), $(this).find('#price'), $(this).find('#display-price'), $(this).find('#state'))">
                @csrf
                @isset($index)
                  <input type="hidden" value="{{$index}}" name="id">
                @endisset   
                <div class="mb-3">
                    <label for="name" class="form-label">{{$lang->label3}}</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{isset($index) ? $currentOffers->getName() : old('name')}}" placeholder="{{$lang->hint1}}">
                </div>
                <div class="mb-3">
                    <label for="shortcut" class="form-label">{{$lang->label7}}</label>
                    <input type="text" class="form-control" id="shortcut" name="shortcut" value="{{isset($index) ? $currentOffers->getShortcut() : old('shortcut')}}" placeholder="{{$lang->hint3}}">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">{{$lang->label4}}</label>
                    <input type="number" min="0" class="form-control" id="price" name="price" value="{{isset($index) ? $currentOffers->getPrice() : old('price')}}" placeholder="{{$lang->hint2}}">
                </div>
                <div class="mb-3">
                    <label for="display-price" class="form-label">{{$lang->label6}}</label>
                    <input type="number" class="form-control" id="display-price" name="display-price" value="{{isset($index) ? $currentOffers->getDisplayPrice() : old('display-price')}}" placeholder="{{$lang->hint4}}">
                </div>
                <div class="mb-3">
                    <label for="state" class="form-label">{{$lang->label5}}</label>
                    <select class="form-select" id="state" name="state">
                    <option selected disabled>{{$lang->selectBox1}}</option>
                    @foreach($lang->inputOutPut as $key=>$offer)
                    <option {{isset($index) ? ($currentOffers->getStateId() === $key ? 'selected' : '') : (old('state') === $key ? 'selected' : '')}} value="{{$key}}">{{$offer}}</option>
                    @endforeach
                    </select>
                </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="{{isset($index) ? 'editForm'.$index : 'createForm'}}" class="btn btn-primary">{{isset($index) ? $lang->button3 : $lang->button2}}</button>
      </div>
    </div>
  </div>
</div>