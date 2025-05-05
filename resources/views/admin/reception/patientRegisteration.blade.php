@extends('layout.app_table')
@section('title') {{$lang->title1}} @endsection
<link rel="stylesheet" href="{{asset('css/admin/reception/patientRegisteration.css')}}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@extends('layout.nav_admin')
@section('branch')
@include('layout.branch_button')
@endsection
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
            @foreach(array_reverse($lang->arr6) as $index=>$receipt)
            <tr>
                <th>{{$loop->index + 1}}</th>
                <th>{{$receipt->getPatientCode()}}</th>
                <th>{{$receipt->getMyPatient()->getName()}}</th>
                <th>year {{$receipt->getDateBirth()}}</th>
                <th>{{$receipt->getMyPatient()->getPhone()}}</th>
                <th>
                    @foreach(array_merge($receipt->getTest(), $receipt->getCurrentOffers()) as $test)
                    <h6>{{$test->getShortcut()}}</h6>
                    @endforeach
                </th>
                <th>{{$receipt->getSubtotal()}}</th>
                <th>{{$receipt->getDiscount()}}</th>
                <th>{{$receipt->getTotalDiscount()}}</th>
                <th>{{$receipt->getTotal()}}</th>
                <th>{{$receipt->getAmountPaid()}}</th>
                <th>{{$receipt->getDue()}}</th>
                <th>{{$receipt->getDelayedMoney()}}</th>
                <th>{{$receipt->getDueUser()}}</th>
                <th>{{$receipt->getPaymentDate()}}</th>
                <th>{{$receipt->getAmountPaid()}}</th>
                <th>{{$receipt->getPaymentMethod()}}</th>
                <th>
                    @include('layout.model_delete', ['name'=>$receipt->getMyPatient()->getName()])
                    @include('layout.all_models.admin.reception.patient_register')
                    <div class="dropdown">
                        <i class="bi bi-gear edit" id="dropdownMenuButton" data-bs-toggle="dropdown"></i> <!-- Re icon as needed -->
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" onclick="openPDF('{{asset("files/salamtak-care/img/logo.png")}}', '{{$lang->title5}}', '{{$lang->label29}}', '{{$lang->label30}}', '{{$lang->label31}}', '{{$lang->label32}}', '{{$lang->label33}}', '{{$lang->label34}}', '{{$lang->label35}}', '{{$lang->label36}}', '{{$lang->label37}}', '{{$lang->label38}}', '{{$lang->label39}}', '{{$lang->label40}}', '{{$lang->label41}}', '{{$lang->label42}}', '{{$lang->label43}}', '{{$loop->index+1}}', '{{$receipt->getPaymentDate()}}', '{{$receipt->getMyPatient()->getName()}}', '{{$receipt->getMyPatient()->getPatentCode()}}', {{json_encode($receipt->getTestPdf())}}, '{{$lang->table26}}', '{{$receipt->getSubtotal()}}', '{{$receipt->getTotalDiscount()}}', '{{$receipt->getTotal()}}', '{{$receipt->getPaymentDate()}}', '{{$receipt->getAmountPaid()}}', '{{$receipt->getPaymentMethod()}}', '{{$receipt->getDue()}}')">{{$lang->selectBox7}}</a></li>
                        </ul>
                    </div>
                    <i class="bi bi-wrench-adjustable edit" onclick="displayEditForm($('#editForm{{$index}}').find('#test-select'), $('#editForm{{$index}}').find('#payment-date'), $('#editForm{{$index}}').find('#payment-amount'), $('#editForm{{$index}}').find('.form-check-input'), $('#editForm{{$index}}').find('#patent-other'), $('#editForm{{$index}}').find('#preview'), $('#editForm{{$index}}').find('#selectPatient option'), $('#editForm{{$index}}').find('#patent-code'), $('#editForm{{$index}}').find('#patent-name'), $('#editForm{{$index}}').find('#patent-nationality'), $('#editForm{{$index}}').find('#patent-national-id'), $('#editForm{{$index}}').find('#patent-passport-no'), $('#editForm{{$index}}').find('#patent-email'), $('#editForm{{$index}}').find('#patent-phone'), $('#editForm{{$index}}').find('#patent-phone2'), $('#editForm{{$index}}').find('#patent-gender'), $('#editForm{{$index}}').find('#last-period-date'), $('#editForm{{$index}}').find('#date-birth'), $('#editForm{{$index}}').find('#patent-address'), $('#editForm{{$index}}').find('#patent-contracting'), $('#editForm{{$index}}').find('#patent-hours'), $('#editForm{{$index}}').find('#know option'), $('#editForm{{$index}}').find('#subtotal'), $('#editForm{{$index}}').find('#discount'), $('#editForm{{$index}}').find('#totalDiscount'), $('#editForm{{$index}}').find('#total'), $('#editForm{{$index}}').find('#paid'), $('#editForm{{$index}}').find('#due'), $('#editForm{{$index}}').find('#delayedMoney'), $('#editForm{{$index}}').find('#dueUser'), $('#editForm{{$index}}').find('#payment-method option'), $('#editForm{{$index}}').find('#items-table2 tbody'), $('#editForm{{$index}}').find('#items-table tbody'),'editModel{{$index}}', '{{$index}}', '{{$lang->button4}}', '{{$lang->table26}}', '{{$receipt->getMyPatient()->getAvatar() !== null ? $receipt->getMyPatient()->getAvatar() : asset('img/admin/avatar1.png')}}', '{{$receipt->getMyPatient()->getName()}}', '{{$receipt->getMyPatient()->getPatentCode()}}', '{{$receipt->getMyPatient()->getNationality()}}', '{{$receipt->getMyPatient()->getNationalId()}}', '{{$receipt->getMyPatient()->getPassportNo()}}', '{{$receipt->getMyPatient()->getEmail()}}', '{{$receipt->getMyPatient()->getPhone()}}', '{{$receipt->getMyPatient()->getPhone2()}}', '{{$receipt->getMyPatient()->getGender()}}', '{{$receipt->getMyPatient()->getLastPeriodDate()}}', '{{$receipt->getMyPatient()->getDateBirth()}}', '{{$receipt->getMyPatient()->getAddress()}}', '{{$receipt->getMyPatient()->getContracting()}}', '{{$receipt->getMyPatient()->getHours()}}', {{json_encode($receipt->getMyPatient()->getDiseaseId())}}, '{{$receipt->getKnowId()}}', {{json_encode($receipt->getOfferObject())}}, {{json_encode($receipt->getTestObject())}}, '{{$receipt->getSubtotal()}}', '{{$receipt->getDiscount()}}', '{{$receipt->getTotalDiscount()}}', '{{$receipt->getTotal()}}', '{{$receipt->getAmountPaid()}}', '{{$receipt->getDue()}}','{{$receipt->getDelayedMoney()}}', '{{$receipt->getDueUser()}}', '{{$receipt->getPaymentDate()}}', '{{$receipt->getPaymentMethodId()}}')"></i>  
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
    keyValueMap.set("myArray", {
        itemsTest:[],
        itemsOffers:[]
    });
    let allRes = @json($allRes);
    allRes.forEach((element, index) => {
        keyValueMap.set(element[2], {
        itemsOffers:element[0],
        itemsTest:element[1]
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