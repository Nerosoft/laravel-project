<button form="form_data" type="submit" class="btn btn-primary">{{$lang->button3}}</button>
<button type="button" onClick="openForm('exampleModal')" class="btn btn-success">{{$lang->button1}}</button>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="SettingLanguage">{{$lang->label4}}</h5>
        <button type="button" onClick="closeModel('{{ $lang->language }}', 'exampleModal')" class="btn btn-dark">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="myForm" action="{{route('language.changeLanguage')}}" method="POST">
        @csrf
        <input type="hidden" name="userId" value = "{{$lang->RaysId}}">
            @foreach ($lang->myRadios as $key =>$radios)
            <div class="form-check">
            <input name="mylanguage" class="flexCheck form-check-input" value="{{$key}}" onClick="setLanguage(this)" {{$key === $lang->language ? 'checked' : ''}} type="checkbox">
            <label  class="form-check-label">
            {{$radios->getName()}}
            </label>
            </div>
            @endforeach
        </form>
      </div>
      <div class="modal-footer">
      <button type="submit" form="myForm" class="btn btn-primary">{{$lang->button2}}</button>
      </div>
    </div>
  </div>
</div>