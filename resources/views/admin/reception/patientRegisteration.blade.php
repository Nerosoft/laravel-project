@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/reception/patientRegisteration.css')}}">
<link rel="stylesheet" href="{{asset('css/admin/reception/sharePatientReg.css')}}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@extends('layout.nav_admin')
@section('containt')
<div class="space-page container">
<button class="btn btn-primary" onClick="openForm('createModel')">{{$lang->button1}}</button>
@include('layout.all_models.admin.reception.patient_register')
<table id="example" class="table table-striped">
        <thead>
            <tr>
                <th>{{$lang->table7}}</th>
                <th>{{$lang->table29}}</th>
                <th>{{$lang->table30}}</th>
                <th>{{$lang->table31}}</th>
                <th>{{$lang->table32}}</th>
                <th>{{$lang->table33}}</th>
                <th>{{$lang->table34}}</th>
                <th>{{$lang->table35}}</th>
                <th>{{$lang->table36}}</th>
                <th>{{$lang->table37}}</th>
                <th>{{$lang->table38}}</th>
                <th>{{$lang->table39}}</th>
                <th>{{$lang->table40}}</th>
                <th>{{$lang->table41}}</th>
                <th>{{$lang->table42}}</th>
                <th>{{$lang->table43}}</th>
                <th>{{$lang->table44}}</th>
                <th>{{$lang->table11}}</th> 
            </tr>
        </thead>
        <tbody>
            @foreach(array_reverse($lang->arr6) as $index=>$patent)
            <tr>
                <th>{{$loop->index + 1}}</th>
                <th>{{$patent->getPatentCode()}}</th>
                <th>{{$patent->getName()}}</th>
                <th>{{$patent->getDateBirth2()}}</th>
                <th>{{$patent->getPhone()}}</th>
                <th>
                    @foreach($patent->getTest() as $test)
                    <h6>{{$test->getShortcut()}}</h6>
                    @endforeach
                </th>
                <th>{{$patent->getSubtotal()}}</th>
                <th>{{$patent->getDiscount()}}</th>
                <th>{{$patent->getTotalDiscount()}}</th>
                <th>{{$patent->getTotal()}}</th>
                <th>{{$patent->getAmountPaid()}}</th>
                <th>{{$patent->getDue()}}</th>
                <th>{{$patent->getDelayedMoney()}}</th>
                <th>{{$patent->getDueUser()}}</th>
                <th>{{$patent->getPaymentDate()}}</th>
                <th>{{$patent->getAmountPaid()}}</th>
                <th>{{$patent->getPaymentMethodId()}}</th>
                <th>
                    @include('layout.model_delete', ['name'=>$patent->getName()])
                    @include('layout.all_models.admin.reception.patient_register')
                     <div class="dropdown">
                        <i class="bi bi-gear edit" id="dropdownMenuButton" data-bs-toggle="dropdown"></i> <!-- Re icon as needed -->
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" onclick="openPDF('{{asset("files/salamtak-care/img/logo.png")}}', '{{$lang->title5}}', '{{$lang->label29}}', '{{$lang->label30}}', '{{$lang->label31}}', '{{$lang->label32}}', '{{$lang->label33}}', '{{$lang->label34}}', '{{$lang->label35}}', '{{$lang->label36}}', '{{$lang->label37}}', '{{$lang->label38}}', '{{$lang->label39}}', '{{$lang->label40}}', '{{$lang->label41}}', '{{$lang->label42}}', '{{$lang->label43}}', '{{$loop->index+1}}', '{{$patent->getPaymentDate()}}', '{{$patent->getName()}}', '{{$patent->getPatentCode()}}', {{json_encode($patent->getTestObject())}}, '{{$lang->table26}}', '{{$patent->getSubtotal()}}', '{{$patent->getTotalDiscount()}}', '{{$patent->getTotal()}}', '{{$patent->getPaymentDate()}}', '{{$patent->getAmountPaid()}}', '{{$patent->getPaymentMethodId()}}', '{{$patent->getDue()}}')">{{$lang->selectBox7}}</a></li>
                        </ul>
                    </div>
                    <i class="bi bi-wrench-adjustable edit" onclick="displayEditForm($('#editForm{{$index}}').find('#test-select'), 
                    $('#editForm{{$index}}').find('#payment-date'), 
                    $('#editForm{{$index}}').find('#payment-amount'), 
                    $('#editForm{{$index}}').find('.form-check-input'), 
                    $('#editForm{{$index}}').find('#patent-other'), 
                    $('#editForm{{$index}}').find('#preview'), 
                    $('#editForm{{$index}}').find('#selectPatient option'), 
                    $('#editForm{{$index}}').find('#patent-code'), 
                    $('#editForm{{$index}}').find('#patent-name'), 
                    $('#editForm{{$index}}').find('#patent-nationality'), 
                    $('#editForm{{$index}}').find('#patent-national-id'), 
                    $('#editForm{{$index}}').find('#patent-passport-no'), 
                    $('#editForm{{$index}}').find('#patent-email'), 
                    $('#editForm{{$index}}').find('#patent-phone'), 
                    $('#editForm{{$index}}').find('#patent-phone2'), 
                    $('#editForm{{$index}}').find('#patent-gender'), 
                    $('#editForm{{$index}}').find('#last-period-date'), 
                    $('#editForm{{$index}}').find('#date-birth'), 
                    $('#editForm{{$index}}').find('#patent-address'), 
                    $('#editForm{{$index}}').find('#patent-contracting'), 
                    $('#editForm{{$index}}').find('#patent-hours'), 
                    $('#editForm{{$index}}').find('#know option'), 
                    $('#editForm{{$index}}').find('#subtotal'), 
                    $('#editForm{{$index}}').find('#discount'), 
                    $('#editForm{{$index}}').find('#totalDiscount'), 
                    $('#editForm{{$index}}').find('#total'), 
                    $('#editForm{{$index}}').find('#paid'), 
                    $('#editForm{{$index}}').find('#due'), 
                    $('#editForm{{$index}}').find('#delayedMoney'), 
                    $('#editForm{{$index}}').find('#dueUser'), 
                    $('#editForm{{$index}}').find('#payment-method option'), 
                    $('#editForm{{$index}}').find('#items-table tbody'), 
                    'editModel{{$index}}', 
                    '{{$index}}', 
                    '{{$lang->button4}}', 
                    '{{$lang->table26}}', 
                    '{{$patent->getAvatar() !== null ? $patent->getAvatar() : asset('img/admin/avatar1.png')}}', 
                    '{{$patent->getName()}}', '{{$patent->getPatentCode()}}', 
                    '{{$patent->getNationalityId()}}', 
                    '{{$patent->getNationalId()}}', 
                    '{{$patent->getPassportNo()}}', 
                    '{{$patent->getEmail()}}', 
                    '{{$patent->getPhone()}}', 
                    '{{$patent->getPhone2()}}', 
                    '{{$patent->getGenderId()}}', 
                    '{{$patent->getLastPeriodDate()}}', 
                    '{{$patent->getDateBirth()}}', 
                    '{{$patent->getAddress()}}', 
                    '{{$patent->getContractingId()}}', 
                    '{{$patent->getHours()}}', 
                    {{json_encode($patent->getDiseaseId())}}, 
                    '{{$patent->getKnowId()}}', 
                    {{json_encode($patent->getTestObject())}}, 
                    '{{$patent->getSubtotal()}}', 
                    '{{$patent->getDiscount()}}', 
                    '{{$patent->getTotalDiscount()}}', 
                    '{{$patent->getTotal()}}', 
                    '{{$patent->getAmountPaid()}}', 
                    '{{$patent->getDue()}}', 
                    '{{$patent->getDelayedMoney()}}', 
                    '{{$patent->getDueUser()}}', 
                    '{{$patent->getPaymentDate()}}', 
                    '{{$patent->getPaymentMethodId()}}')"></i>
                </th>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
             <tr>
                <th>{{$lang->table7}}</th>
                <th>{{$lang->table29}}</th>
                <th>{{$lang->table30}}</th>
                <th>{{$lang->table31}}</th>
                <th>{{$lang->table32}}</th>
                <th>{{$lang->table33}}</th>
                <th>{{$lang->table34}}</th>
                <th>{{$lang->table35}}</th>
                <th>{{$lang->table36}}</th>
                <th>{{$lang->table37}}</th>
                <th>{{$lang->table38}}</th>
                <th>{{$lang->table39}}</th>
                <th>{{$lang->table40}}</th>
                <th>{{$lang->table41}}</th>
                <th>{{$lang->table42}}</th>
                <th>{{$lang->table43}}</th>
                <th>{{$lang->table44}}</th>
                <th>{{$lang->table11}}</th> 
            </tr>
        </tfoot>
        
</table>
</div>
<script type="text/javascript">
const keyValueMap = new Map();
let res = @json(array_map(function($res) {
return $res->getTestObject();
}, $lang->arr6));
keyValueMap.set("myArray", []);
for(let key in res)
    keyValueMap.set(key, res[key]);
$(document).ready(function () {
    $('.myDatePayment-date').on('input', function () {
        this.setCustomValidity('');
        this.classList.remove('error-message');
      if (!this.checkValidity()) {
        this.setCustomValidity(@json($lang->error6));
        this.classList.add('error-message');
      }
    });
});

</script>
<!-- Toast Container -->
<div id="toastContainer" style="position: fixed; top: 10px; right: 10px; z-index: 9999; max-height: 95vh; overflow-y: auto;">
    <div id="myToast1" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error1 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast2" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error8 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast3" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error3 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast4" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error4 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast5" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error5 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast6" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error6 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast7" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error7 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToast8" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">{{ $lang->error2 }}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="myToastAction" class="toast align-items-center text-bg-success border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div id="myToastActionBody" class="toast-body"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
<script src="{{asset('js/admin/reception/patientRegisteration.js')}}" type="text/javascript"></script>
@extends('layout.table_setting')

@endsection