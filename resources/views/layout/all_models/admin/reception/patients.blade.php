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
                <input type="hidden" value="{{$index}}" name="id">
            @endisset   
                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="col-md-auto">
                            <input onchange="changeImage(this, $('#{{isset($index) ? "editForm".$index : "createForm"}}').find('#preview'))" type="file" id="avatar" name="avatar" class="d-none avatar" accept="image/*"/>
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
                                <label for="patent-name">
                                    <i class="bi bi-person"></i>
                                    {{$lang->label16}}
                                </label>
                                <input id="patent-name" type="text" class="form-control" value="{{isset($index) ? $patent->getName() : old('patent-name')}}" name="patent-name" placeholder="{{$lang->hint1}}">
                            </div>
                        </div>
                        <div class="col-md-auto">
                            <div class="pt-2 form-group">
                                <label for="patent-nationality">
                                    <i class="bi bi-globe2"></i>
                                    {{$lang->label4}}
                                </label>
                                <select class="form-select" id="patent-nationality" name="patent-nationality" aria-label="Default select example">
                                    <option selected disabled>{{$lang->selectBox1}}</option>
                                    @foreach($lang->nationality as $key=>$nat)
                                    <option {{ isset($index) ? ($patent->getNationalityId() === $key ? 'selected' : '') : (old('patent-nationality') === $key ? 'selected' : '')  }} value="{{$key}}">{{$nat}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>   
                        <div class="col-md-auto">
                            <div class="pt-2 form-group">
                                <label for="patent-national-id">
                                    <i class="bi bi-person-video"></i>
                                    {{$lang->label5}}
                                </label>
                                <input id="patent-national-id" type="text" class="form-control" value="{{ isset($index) ? $patent->getNationalId() : old('patent-national-id') }}" name="patent-national-id" placeholder="{{$lang->hint4}}">
                            </div>
                        </div>
                        <div class="col-md-auto">
                            <div class="pt-2 form-group">
                                <label for="patent-passport-no">
                                    <i class="bi bi-globe-americas"></i>
                                    {{$lang->label6}}
                                </label>
                                <input id="patent-passport-no" type="text" class="form-control" value="{{isset($index) ? $patent->getPassportNo() : old('patent-passport-no')}}" name="patent-passport-no" placeholder="{{$lang->hint5}}">
                            </div>
                        </div>
                        <div class="col-md-auto">
                            <div class="pt-2 form-group">
                                <label for="patent-email">
                                    <i class="bi bi-envelope"></i>
                                    {{$lang->label17}}
                                </label>
                                <input id="patent-email" type="text" class="form-control" value="{{isset($index) ? $patent->getEmail() : old('patent-email')}}" name="patent-email" placeholder="{{$lang->hint2}}">
                            </div>
                        </div>
                        <div class="col-md-auto">
                            <div class="pt-2 form-group">
                                <label for="patent-phone">
                                    <i class="bi bi-telephone"></i>
                                    {{$lang->label7}}
                                </label>
                                <input id="patent-phone" type="text" class="form-control" value="{{isset($index) ? $patent->getPhone() : old('patent-phone')}}" name="patent-phone" placeholder="{{$lang->hint6}}">
                            </div>
                        </div>
                        <div class="col-md-auto">
                            <div class="pt-2 form-group">
                                <label for="patent-phone2">
                                    <i class="bi bi-telephone"></i>
                                    {{$lang->label8}}
                                </label>
                                <input id="patent-phone2" type="text" class="form-control" value="{{isset($index) ? $patent->getPhone2() : old('patent-phone2')}}" name="patent-phone2" placeholder="{{$lang->hint7}}">
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
                                    <option {{isset($index) ? ($patent->getGenderId() === $key ? 'selected' : '') : (old('patent-gender') === $key ? 'selected' : '')}} value="{{$key}}">{{$gender}}</option>            
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-auto">
                            <div class="pt-2 form-group">
                                <label for="last-period-date">
                                    <i class="bi bi-clock-history"></i>
                                    {{$lang->label10}}
                                </label>
                                <input id="last-period-date" type="date" class="form-control" value="{{isset($index) ? $patent->getLastPeriodDate() : old('last-period-date')}}" name="last-period-date" placeholder="{{$lang->hint9}}">
                            </div>
                        </div>
                        <div class="col-md-auto">
                            <div class="pt-2 form-group">
                                <label for="date-birth">
                                    <i class="bi bi-cake2"></i>
                                    {{$lang->label11}}
                                </label>
                                <input id="date-birth" type="date" class="form-control" value="{{isset($index) ? $patent->getDateBirth() : old('date-birth')}}" name="date-birth" placeholder="{{$lang->hint10}}">
                            </div>
                        </div>
                        <div class="col-md-auto">
                            <div class="pt-2 form-group">
                                <label for="patent-address">
                                    <i class="bi bi-geo-alt"></i>
                                    {{$lang->label12}}
                                </label>
                                <input id="patent-address" type="text" class="form-control" value="{{isset($index) ? $patent->getAddress() : old('patent-address')}}" name="patent-address" placeholder="{{$lang->hint11}}">
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
                                    @foreach($lang->arr1 as $key=>$contract)
                                    <option {{isset($index) ? ($patent->getContractingId() === $key ? 'selected' : '') : (old('patent-contracting') === $key ? 'selected' : '')}} value="{{$key}}">{{$contract->getName()}}</option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>
                        <div class="col-md-auto">
                            <div class="pt-2 form-group">
                                <label for="patent-gours">
                                    <i class="bi bi-clock"></i>
                                    {{$lang->label14}}
                                </label>
                                <input id="patent-hours" type="number" class="form-control" value="{{isset($index) ? $patent->getHours() : old('patent-hours')}}" name="patent-hours" placeholder="{{$lang->hint3}}">
                            </div>
                        </div>
                    </div> 
                    <div class="row pt-2">
                        @foreach($lang->dis as $key=>$option)
                            <div class="col-md-auto">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="checkbox" id="choices[]" class="form-check-input" name="choices[]" value="{{$key}}"
                                        {{isset($index) ? (is_array($patent->getDiseaseId()) ? (in_array($key, $patent->getDiseaseId()) ? 'checked' : '') : '') : (in_array($key, old('choices', [])) ? 'checked' : '')}}>
                                        <label class="form-check-label" for="choices[]">
                                        {{ $option }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-auto">
                            <div class="pt-2 form-group">
                                <label for="patent-other">
                                    <i class="bi bi-list-ul"></i>
                                    {{$lang->label15}}
                                </label>
                                <input id="patent-other" type="text" class="form-control" value="{{isset($index) ? ( is_array($patent->getDiseaseId()) ? '' : $patent->getDisease() ) : old('patent-other')}}" name="patent-other" placeholder="{{$lang->hint8}}">
                            </div>
                        </div>
                    </div>
                </div>
            
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="{{ isset($index) ? 'editForm'.$index : 'createForm' }}" class="btn btn-primary">{{isset($index) ? $lang->button4 : $lang->button2}}</button>
      </div>
    </div>
  </div>
</div>