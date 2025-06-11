<!-- Modal -->
<div class="modal fade" id="{{ isset($index) ? 'editModel'.$index : 'createModel' }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="SettingLanguage">{{isset($index) ? $lang->title3 : $lang->title2}}</h5>
        <button type="button" onclick="closeForm('{{isset($index) ? "editModel".$index : "createModel"}}')" class="btn btn-dark">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="{{ isset($index) ? 'editForm'.$index : 'createForm' }}" action="{{ isset($index) ? route('editPatent') : route('createPatent') }}" method="POST" onsubmit="return validatePatent($(this).find('#patent-name'), $(this).find('#patent-nationality'), $(this).find('#patent-gender'), $(this).find('#patent-contracting'), $(this).find('#patent-national-id'), $(this).find('#patent-passport-no'), $(this).find('#patent-email'), $(this).find('#patent-phone'), $(this).find('#patent-phone2'), $(this).find('#patent-address'), $(this).find('#patent-hours'), $(this).find('#patent-other'), $(this).find('input[type=checkbox]').filter(':checked').length, $(this).find('#last-period-date'), $(this).find('#date-birth'), $(this).find('#avatar')[0].files[0], $(this).find('#preview'))" enctype="multipart/form-data">
            @csrf
            @isset($index)
                @include('layout.my_id', ['myId'=>$index])
            @endisset   
                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col-md-auto">
                            <input onchange="changeImage(this.files[0], $('#{{isset($index) ? "editForm".$index : "createForm"}}').find('#preview'))" type="file" id="avatar" name="avatar" class="d-none avatar" accept="image/*"/>
                            <div class="pt-2 form-group">
                            <h5>{{ $lang->label3 }}</h5>
                            <img id="preview" src="{{ isset($index) ? ($patent->getAvatar() !== null ? $patent->getAvatar() : asset('img/admin/avatar1.png')) : asset('img/admin/avatar1.png')}}" alt="Avatar Preview" class="avatar preview">
                            <button type="button" class="upload-btn" onclick="openImage($('#{{isset($index) ? "editForm".$index : "createForm"}}').find('#avatar'))" id="uploadBtn">{{$lang->button1}}</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-auto">
                            <div class="pt-2 form-group">
                                <label for="patent-nationality">
                                    <i class="bi bi-globe2"></i>
                                    {{$lang->label4}}
                                </label>
                                <select class="form-select" id="patent-nationality" name="patent-nationality" aria-label="Default select example">
                                    <option selected disabled>{{$lang->selectBox1}}</option>
                                    @foreach($lang->nationality as $key=>$nat)
                                    <option {{ isset($index) ? ($patent->getNationalityId() === $nat ? 'selected' : '') : (old('patent-nationality') === $key ? 'selected' : '')  }} value="{{$key}}">{{$nat}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-auto">
                            <div class="pt-2 form-group">
                                <label for="patent-gender">
                                    <i class="bi bi-gender-trans"></i>
                                    {{$lang->label9}}
                                </label>
                                <select class="form-select" id="patent-gender" name="patent-gender" aria-label="Default select example">
                                    <option selected disabled>{{$lang->selectBox2}}</option>
                                    @foreach($lang->gender as $key=>$gender)
                                    <option {{isset($index) ? ($patent->getGenderId() === $gender ? 'selected' : '') : (old('patent-gender') === $key ? 'selected' : '')}} value="{{$key}}">{{$gender}}</option>            
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-auto">
                            <div class="pt-2 form-group">
                                <label for="patent-contracting">
                                    <i class="bi bi-pencil-square"></i>
                                    {{$lang->label13}}
                                </label>
                                <select class="form-select" id="patent-contracting" name="patent-contracting" aria-label="Default select example">
                                    <option selected disabled>{{$lang->selectBox5}}</option>
                                    @foreach($lang->myContract as $key=>$contract)
                                    <option {{isset($index) ? ($patent->getContractingId() === $contract->getName() ? 'selected' : '') : (old('patent-contracting') === $key ? 'selected' : '')}} value="{{$key}}">{{$contract->getName()}}</option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>
                    </div>
                    @include('layout.patient_information',['state'=>'enable'])
                </div>
            
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="{{ isset($index) ? 'editForm'.$index : 'createForm' }}" class="btn btn-primary">{{isset($index) ? $lang->button4 : $lang->button2}}</button>
      </div>
    </div>
  </div>
</div>