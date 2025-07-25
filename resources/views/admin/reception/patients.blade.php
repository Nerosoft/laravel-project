@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/reception/patients.css')}}">
<link rel="stylesheet" href="{{asset('css/admin/reception/sharePatientReg.css')}}">
@extends('layout.nav_admin')
@section('containt')
<div class="space-page container">
<button class="btn btn-primary" onClick="openForm('createModel')">{{$lang->button1}}</button>
@include('layout.all_models.admin.reception.patients')
<table id="example" class="table table-striped">
        <thead>
            <tr>
                <th>{{$lang->table11}}</th>
                <th>{{$lang->table24}}</th>
                <th>{{$lang->table8}}</th>
                <th>{{$lang->table9}}</th>
                <th>{{$lang->table10}}</th>
                <th>{{$lang->table22}}</th>
                <th>{{$lang->table12}}</th>
                <th>{{$lang->table13}}</th>
                <th>{{$lang->table14}}</th>
                <th>{{$lang->table15}}</th>
                <th>{{$lang->table16}}</th>
                <th>{{$lang->table17}}</th>
                <th>{{$lang->table18}}</th>
                <th>{{$lang->table23}}</th>
                <th>{{$lang->table19}}</th>
                <th>{{$lang->table20}}</th>
                <th>{{$lang->table21}}</th>
                <th>{{$lang->table7}}</th>
            </tr>
        </thead>
        <tbody>
          @foreach($lang->tableData as $index=>$patent)
            <tr>
              <td>{{$loop->index+1}}</td>
              <!-- patient code -->
              <td>{{$index}}</td>
              <td><img id="preview" src="{{$patent->getAvatar() != null ? $patent->getAvatar() : asset('img/admin/avatar1.png')}}" alt="Avatar Preview" class="avatar2 preview"></td>
              <td>{{$patent->getName()}}</td>
              <td>{{$patent->getNationalityId()}}</td>
              <td>{{$patent->getNationalId()}}</td>
              <td>{{$patent->getPassportNo()}}</td>
              <td>{{$patent->getEmail()}}</td>
              <td>{{$patent->getPhone()}}</td>
              <td>{{$patent->getPhone2()}}</td>
              <td>{{$patent->getGenderId()}}</td>
              <td>{{$patent->getLastPeriodDate()}}</td>
              <td>{{$patent->getDateBirth()}}</td>
              <td>{{$patent->getAddress()}}</td>
              <td>{{$patent->getContractingId()}}</td>
              <td>{{$patent->getHours()}}</td>
              <td>
                @if(is_array($patent->getDiseaseId()))
                @foreach($patent->getDiseaseId() as $dis)
                <spam>{{$dis}}</spam>
                @endforeach
                @else
                {{$patent->getDiseaseId()}}
                @endif
              </td>
              <td>
                @include('layout.model_delete', ['name'=>$patent->getName()])
                @include('layout.all_models.admin.reception.patients')
                <i class="bi bi-wrench-adjustable edit" onclick="displayEditForm($('#editForm{{$index}}').find('#patent-name'), $('#editForm{{$index}}').find('#patent-nationality'), $('#editForm{{$index}}').find('#patent-gender'), $('#editForm{{$index}}').find('#patent-contracting'), $('#editForm{{$index}}').find('#patent-national-id'), $('#editForm{{$index}}').find('#patent-passport-no'), $('#editForm{{$index}}').find('#patent-email'), $('#editForm{{$index}}').find('#patent-phone'), $('#editForm{{$index}}').find('#patent-phone2'), $('#editForm{{$index}}').find('#patent-address'), $('#editForm{{$index}}').find('#patent-hours'), $('#editForm{{$index}}').find('#patent-other'), $('#editForm{{$index}}').find('#last-period-date'), $('#editForm{{$index}}').find('#date-birth'), $('#editForm{{$index}}').find('#preview'), $('#editForm{{$index}}').find('.form-check-input'), $('#editForm{{$index}}').find('#avatar'), 'editModel{{$index}}', {{json_encode($patent->getDiseaseId())}}, '{{$patent->getAvatar() !== null ? $patent->getAvatar() : asset('img/admin/avatar1.png')}}', '{{$patent->getName()}}', '{{$patent->getNationalityId()}}', '{{$patent->getNationalId()}}', '{{$patent->getPassportNo()}}', '{{$patent->getEmail()}}', '{{$patent->getPhone()}}', '{{$patent->getPhone2()}}', '{{$patent->getGenderId()}}', '{{$patent->getLastPeriodDate()}}', '{{$patent->getDateBirth()}}', '{{$patent->getAddress()}}', '{{$patent->getContractingId()}}', '{{$patent->getHours()}}')"></i>
                @if($patent->getAvatar() != null)
                    <div class="modal" id="imageModel{{$index}}" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $lang->title5 }}</h5>
                                <button type="button" onClick="closeForm('imageModel{{$index}}')" class="btn btn-dark">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                                <div class="modal-body">
                                <img id="imagePatient" src="{{$patent->getAvatar()}}" alt="Avatar Preview" class="avatar3">
                                </div>
                            </div>
                        </div>
                    </div>
                    <i class="bi bi-card-image edit" onclick="displayImage('imageModel{{$index}}')"></i>
                @endif
              </td>
            </tr>
          @endforeach
        
        </tbody>
        <tfoot>
             <tr>
                <th>{{$lang->table11}}</th>
                <th>{{$lang->table24}}</th>
                <th>{{$lang->table8}}</th>
                <th>{{$lang->table9}}</th>
                <th>{{$lang->table10}}</th>
                <th>{{$lang->table22}}</th>
                <th>{{$lang->table12}}</th>
                <th>{{$lang->table13}}</th>
                <th>{{$lang->table14}}</th>
                <th>{{$lang->table15}}</th>
                <th>{{$lang->table16}}</th>
                <th>{{$lang->table17}}</th>
                <th>{{$lang->table18}}</th>
                <th>{{$lang->table23}}</th>
                <th>{{$lang->table19}}</th>
                <th>{{$lang->table20}}</th>
                <th>{{$lang->table21}}</th>
                <th>{{$lang->table7}}</th>
            </tr>
        </tfoot>
    </table>
</div>

</div>
<!-- Toast Container -->
<div style="position: fixed; top: 10px; right: 10px; z-index: 9999; max-height: 95vh; overflow-y: auto;">
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
    <div id="myToast3" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error17 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast4" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error18 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast5" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error21 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast6" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error3 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast7" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error4 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast8" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error5 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast9" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error6 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast10" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error7 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast11" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error8 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast12" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error9 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast13" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error10 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast14" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error11 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast15" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error12 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast16" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error13 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast17" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error14 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast18" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error15 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast19" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error16 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast20" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error22 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast21" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error19 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast22" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error20 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast23" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error23 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast24" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error32 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast25" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->PatentAvatarDimensions }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function () {
    $('.myNewDatelast-period-date').on('input', function () {
        this.setCustomValidity('');
        this.classList.remove('error-message');
      if (!this.checkValidity()) {
        this.setCustomValidity(@json($lang->error19));
        this.classList.add('error-message');
      }
    });
    $('.myNewDate-birth').on('input', function () {
        this.setCustomValidity('');
        this.classList.remove('error-message');
      if (!this.checkValidity()) {
        this.setCustomValidity(@json($lang->error20));
        this.classList.add('error-message');
      }
    });
});
</script>
<script src="{{asset('js/admin/reception/patients.js')}}" type="text/javascript"></script>
@extends('layout.table_setting')
@endsection