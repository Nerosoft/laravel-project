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
        <form id="{{isset($index) ? 'editForm'.$index : 'createForm'}}" onsubmit="return validateT2($(this).find('#test-select'), $(this).find('#tests-name').val(), $(this).find('#selectPatient'), $(this).find('#know'), $(this).find('#payment-date'), $(this).find('#payment-amount'), $(this).find('#payment-method'), $(this).find('#patent-code').val(), $(this).find('#discount').val(), $(this).find('#delayedMoney').val(), '{{isset($index) ? $index : "myArray"}}', '{{ isset($index) ? route('editPatientServices') : route('createPatientServices')}}', '{{ route('Reception', 'PatientRegisteration') }}', '{{isset($index) ? "edit" : "create"}}')">
            @isset($index)
                <input type="hidden" value="{{$index}}" name="id">
            @endisset   
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-md-auto">
                        <div class="pt-2 form-group">
                        <h5>{{ $lang->label45 }}</h5>
                        <img id="preview" src="{{isset($index) ? ($receipt->getMyPatient()->getAvatar() !== null ? $receipt->getMyPatient()->getAvatar() : asset('img/admin/avatar1.png')) : asset('img/admin/avatar1.png')}}" class="avatar preview">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                            <div class="pt-2 form-group">
                                <label for="patent-nationality">
                                    <i class="bi bi-globe2"></i>
                                  {{$lang->label17}}
                                </label>
                                <select class="form-select" onchange="initPatient(this, $('{{isset($index) ? "#editForm".$index : "#createForm"}}'), '{{asset("img/admin/avatar1.png")}}')" id="selectPatient">
                                    <option selected disabled>{{$lang->selectBox2}}</option>
                                    @foreach($lang->myPatent as $key=>$patient)
                                    <option {{isset($index) ? ($receipt->getMyPatient()->getPatentCode() === $patient->getPatentCode() ? 'selected' : '') : ''}} value="{{json_encode($lang->myPatent[$key]->getObject2())}}">{{$patient->getName()}}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="col-md-auto">
                        <div class="pt-2 form-group">
                            <label for="patent-code">
                                <i class="bi bi-person"></i>
                                {{$lang->label16}}
                            </label>
                            <input id="patent-code" disabled type="text" class="form-control" value="{{isset($index) ? $receipt->getMyPatient()->getPatentCode() : ''}}" placeholder="{{$lang->hint12}}">
                        </div>
                    </div>
                    <div class="col-md-auto">
                        <div class="pt-2 form-group">
                            <label for="patent-name">
                                <i class="bi bi-person"></i>
                                {{$lang->label44}}
                            </label>
                            <input id="patent-name" type="text" class="form-control" disabled value="{{isset($index) ? $receipt->getMyPatient()->getName() : ''}}" placeholder="{{$lang->hint1}}">
                        </div>
                    </div>
                    <div class="col-md-auto">
                        <div class="pt-2 form-group">
                            <label for="patent-nationality">
                                <i class="bi bi-globe2"></i>
                                {{$lang->label3}}
                            </label>
                            <input id="patent-nationality" type="text" class="form-control" disabled value="{{isset($index) ? $receipt->getMyPatient()->getNationality() : ''}}" placeholder="{{$lang->hint13}}">
                            
                        </div>
                    </div>   
                    <div class="col-md-auto">
                        <div class="pt-2 form-group">
                            <label for="patent-national-id">
                                <i class="bi bi-person-video"></i>
                                {{$lang->label4}}
                            </label>
                            <input id="patent-national-id" type="text" class="form-control" disabled value="{{isset($index) ? $receipt->getMyPatient()->getNationalId() : ''}}" placeholder="{{$lang->hint2}}">
                        </div>
                    </div>
                    <div class="col-md-auto">
                        <div class="pt-2 form-group">
                            <label for="patent-passport-no">
                                <i class="bi bi-globe-americas"></i>
                                {{$lang->label5}}
                            </label>
                            <input id="patent-passport-no" type="text" class="form-control" disabled value="{{isset($index) ? $receipt->getMyPatient()->getPassportNo() : ''}}" placeholder="{{$lang->hint3}}">
                        </div>
                    </div>
                    <div class="col-md-auto">
                        <div class="pt-2 form-group">
                            <label for="patent-email">
                                <i class="bi bi-envelope"></i>
                                {{$lang->label6}}
                            </label>
                            <input id="patent-email" type="text" class="form-control" disabled value="{{isset($index) ? $receipt->getMyPatient()->getEmail() : ''}}" placeholder="{{$lang->hint4}}">
                        </div>
                    </div>
                    <div class="col-md-auto">
                        <div class="pt-2 form-group">
                            <label for="patent-phone">
                                <i class="bi bi-telephone"></i>
                                {{$lang->label7}}
                            </label>
                            <input id="patent-phone" type="text" class="form-control" disabled value="{{isset($index) ? $receipt->getMyPatient()->getPhone() : ''}}" placeholder="{{$lang->hint5}}">
                        </div>
                    </div>
                    <div class="col-md-auto">
                        <div class="pt-2 form-group">
                            <label for="patent-phone2">
                                <i class="bi bi-telephone"></i>
                                {{$lang->label8}}
                            </label>
                            <input id="patent-phone2" type="text" class="form-control" disabled value="{{isset($index) ? $receipt->getMyPatient()->getPhone2() : ''}}" placeholder="{{$lang->hint6}}">
                        </div>
                    </div>
                    <div class="col-md-auto">
                        <div class="pt-2 form-group">
                            <label for="patent-gender">
                                <i class="bi bi-gender-trans"></i>
                                {{$lang->label9}}
                            </label>
                            <input id="patent-gender" type="text" class="form-control" disabled value="{{isset($index) ? $receipt->getMyPatient()->getGender() : ''}}" placeholder="{{$lang->hint14}}">
                        </div>
                    </div>
                    <div class="col-md-auto">
                        <div class="pt-2 form-group">
                            <label for="last-period-date">
                                <i class="bi bi-clock-history"></i>
                                {{$lang->label10}}
                            </label>
                            <input id="last-period-date" type="date" class="form-control" disabled value="{{isset($index) ? $receipt->getMyPatient()->getLastPeriodDate() : ''}}" placeholder="{{$lang->hint7}}">
                        </div>
                    </div>
                    <div class="col-md-auto">
                        <div class="pt-2 form-group">
                            <label for="date-birth">
                                <i class="bi bi-cake2"></i>
                                {{$lang->label11}}
                            </label>
                            <input id="date-birth" type="date" class="form-control" disabled value="{{isset($index) ? $receipt->getMyPatient()->getDateBirth() : ''}}" placeholder="{{$lang->hint8}}">
                        </div>
                    </div>
                    <div class="col-md-auto">
                        <div class="pt-2 form-group">
                            <label for="patent-address">
                                <i class="bi bi-geo-alt"></i>
                                {{$lang->label12}}
                            </label>
                            <input id="patent-address" type="text" class="form-control" disabled value="{{isset($index) ? $receipt->getMyPatient()->getAddress() : ''}}" placeholder="{{$lang->hint9}}">
                        </div>
                    </div>
                    <div class="col-md-auto">
                        <div class="pt-2 form-group">
                            <label for="patent-contracting">
                                <i class="bi bi-pencil-square"></i>
                                {{$lang->label13}}
                            </label>
                            <input id="patent-contracting" type="text" class="form-control" disabled value="{{isset($index) ? $receipt->getMyPatient()->getContracting() : ''}}" placeholder="{{$lang->hint15}}">
                        </div>
                    </div>
                    <div class="col-md-auto">
                        <div class="pt-2 form-group">
                            <label for="patent-gours">
                                <i class="bi bi-clock"></i>
                                {{$lang->label14}}
                            </label>
                            <input id="patent-hours" type="number" class="form-control" disabled value="{{isset($index) ? $receipt->getMyPatient()->getHours() : ''}}" placeholder="{{$lang->hint10}}">
                        </div>
                    </div>
                </div> 
                <div class="row pt-2">
                    @foreach($lang->dis as $key=>$option)
                        <div class="col-md-auto">
                            <div class="form-group">
                                <div class="form-check">
                                    <!-- check valid in pation -->
                                    <input type="checkbox" id="choices[]" class="form-check-input" disabled value="{{$key}}"
                                    {{isset($index) ? ( is_array($receipt->getMyPatient()->getDiseaseId()) ? (in_array($key, $receipt->getMyPatient()->getDiseaseId()) ? 'checked' : '') : '' ) : ''}}>
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
                            <input id="patent-other" type="text" class="form-control" value="{{isset($index) ? (is_array($receipt->getMyPatient()->getDisease()) ? '' : $receipt->getMyPatient()->getDisease()) : ''}}" disabled placeholder="{{$lang->hint11}}">
                        </div>
                    </div>
                </div>
                <div class="row pt-2">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header text-center">
                                <h3 class="mb-0">{{$lang->label18}}</h3>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{$lang->label19}}</p>
                                <select class="form-select" aria-label="Knowed Us By" id="know">
                                <option selected disabled>{{$lang->selectBox5}}</option>
                                @foreach($lang->arr1 as $key=>$know)
                                <option {{isset($index) ? ($receipt->getKnowId() === $key ? 'selected' : '') : ''}} value="{{$key}}">{{$know->getName()}}</option>
                                @endforeach
                                </select>
                                <!-- Add New Item Form -->
                                <div class="mb-4 pt-2">
                                    <h6>{{$lang->label20}}</h6>
                                    <div class="row g-3 align-items-center">
                                        <div class="col-md-4">
                                        <!-- Item Name with Icon -->
                                        <label for="item-name" class="form-label"><i class="bi bi-clipboard2-check"></i>{{$lang->label21}}</label>
                                        <select onchange="handleChange2($('{{isset($index) ? "#editForm".$index : "#createForm"}}').find('#allName'), $('{{isset($index) ? "#editForm".$index : "#createForm"}}').find('#tests-name'), event, {{json_encode($lang->arr2)}}, {{json_encode($lang->arr3)}}, {{json_encode($lang->arr4)}}, {{json_encode($lang->arr5)}})" class="form-select" id="test-select">
                                        <option selected disabled>{{$lang->selectBox6}}</option>
                                        @foreach($lang->allTests as $key=>$test)
                                        <option value="{{$key}}">{{$test}}</option>
                                        @endforeach
                                        </select>
                                        </div>
                                        <div id="allName" class="col-md-4 d-none">
                                        <!-- Quantity with Icon -->
                                        <label for="item-quantity" class="form-label"><i class="bi bi-clipboard2-check"></i>{{$lang->label22}}</label>
                                        <select class="form-select" id="tests-name">
                                        </select>
                                        </div>
                                        <div class="col-md-4">
                                        <!-- Add Item Button -->
                                        <button type="button" class="btn btn-primary btn-sm mt-4" onclick="addItem3($('{{isset($index) ? "#editForm".$index : "#createForm"}}').find('#test-select'), $('{{isset($index) ? "#editForm".$index : "#createForm"}}').find('#tests-name'), $('{{isset($index) ? "#editForm".$index : "#createForm"}}').find('#test-select').val() === '{{$lang->name1}}' ? $('{{isset($index) ? "#editForm".$index : "#createForm"}}').find('#items-table2 tbody'):$('{{isset($index) ? "#editForm".$index : "#createForm"}}').find('#items-table tbody'), $('{{isset($index) ? "#editForm".$index : "#createForm"}}').find('#subtotal'), $('{{isset($index) ? "#editForm".$index : "#createForm"}}').find('#totalDiscount'), $('{{isset($index) ? "#editForm".$index : "#createForm"}}').find('#discount').val(), $('{{isset($index) ? "#editForm".$index : "#createForm"}}').find('#total'), $('{{isset($index) ? "#editForm".$index : "#createForm"}}').find('#due'), $('{{isset($index) ? "#editForm".$index : "#createForm"}}').find('#payment-amount').val(), $('{{isset($index) ? "#editForm".$index : "#createForm"}}').find('#dueUser'), $('{{isset($index) ? "#editForm".$index : "#createForm"}}').find('#test-select').val() === '{{$lang->name1}}' ? 'itemsOffers': 'itemsTest', '{{isset($index) ? $index : "myArray"}}', '{{$lang->table26}}', '{{$lang->button4}}')">
                                            <i class="bi bi-clipboard2-check"></i> {{$lang->button5}}
                                        </button>
                                        </div>
                                    </div>

                                </div>

                                <div class="table-responsive">
                                <!-- table2 -->
                                <table class="table table-bordered custom" id="items-table2">
                                    <thead class="table-light">
                                        <tr>
                                        <th scope="col">{{$lang->table28}}</th>
                                        <th scope="col">{{$lang->table8}}</th>
                                        <th scope="col">{{$lang->table9}}</th>
                                        <th scope="col">{{$lang->table10}}</th>
                                        <th scope="col">{{$lang->table45}}</th>
                                        <th scope="col">{{$lang->table12}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($index)
                                        @foreach($receipt->getCurrentOffers() as $currentOffers)
                                            <tr>
                                                <td>{{$currentOffers->getName()}}</td>
                                                <td>{{$currentOffers->getShortcut()}}</td>
                                                <td>{{$currentOffers->getState()}}</td>
                                                <td>{{$currentOffers->getPrice()}}</td>
                                                <td>{{$currentOffers->getDisplayPrice()}}</td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm delete-item" type="button" onclick="deleteRowTable('{{$index}}', 'itemsOffers', '{{$loop->index}}', '{{$lang->table26}}', '{{$lang->button4}}', $('#editForm{{$index}}').find('#items-table2 tbody'), $('#editForm{{$index}}').find('#subtotal'), $('#editForm{{$index}}').find('#totalDiscount'), $('#editForm{{$index}}').find('#discount').val(), $('#editForm{{$index}}').find('#total'), $('#editForm{{$index}}').find('#due'), $('#editForm{{$index}}').find('#payment-amount').val(), $('#editForm{{$index}}').find('#dueUser'))">
                                                        <i class="bi bi-trash"></i> {{$lang->button4}}
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @endisset
                                    </tbody>
                                </table>
                                </div>
                                <!-- Table of Items -->
                                <div class="table-responsive">
                                <table class="table table-bordered custom" id="items-table">
                                    <thead>
                                    <tr class="table-light">
                                        <th>{{$lang->table13}}</th>
                                        <th>{{$lang->table16}}</th>
                                        <th>{{$lang->table14}}</th>
                                        <th>{{$lang->table15}}</th>
                                        <th>{{$lang->table17}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @isset($index)
                                        @foreach($receipt->getTest() as $test)
                                            <tr>
                                                <td>{{$test->getName()}}</td>
                                                <td>{{$test->getShortcut()}}</td>
                                                <td>{{$test->getPrice()}}</td>
                                                <td>{{$test->getInputOutputLab()}}</td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm delete-item" type="button" onclick="deleteRowTable('{{$index}}', 'itemsTest', '{{$loop->index}}', '{{$lang->table26}}', '{{$lang->button4}}', $('#editForm{{$index}}').find('#items-table tbody'), $('#editForm{{$index}}').find('#subtotal'), $('#editForm{{$index}}').find('#totalDiscount'), $('#editForm{{$index}}').find('#discount').val(), $('#editForm{{$index}}').find('#total'), $('#editForm{{$index}}').find('#due'), $('#editForm{{$index}}').find('#payment-amount').val(), $('#editForm{{$index}}').find('#dueUser'))">
                                                        <i class="bi bi-trash"></i> {{$lang->button4}}
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @endisset
                                    </tbody>
                                    <tfoot>
                                    <tr class="table-light">
                                        <td colspan="4" class="text-end"><strong>{{$lang->table18}}</strong></td>
                                        <td id="subtotal">{{isset($index) ? $lang->table26.' '.$receipt->getSubtotal() :  $lang->table26.' 0.00'}}</td>
                                    </tr>
                                    <tr class="table-light">
                                        <td colspan="4" class="text-end"><strong>{{$lang->table19}}</strong></td>
                                        <td>
                                        <div class="input-group">
                                        <span class="input-group-text discount-size" id="basic-addon1">{{$lang->table27}}</span>
                                        <input type="number" id="discount" min="0" max="100" value="{{isset($index) ? $receipt->getDiscount() : 0}}" class="form-control form-control-sm" onchange="myUpdateReceipt($('{{isset($index) ? "#editForm".$index : "#createForm"}}').find('#subtotal'), $('{{isset($index) ? "#editForm".$index : "#createForm"}}').find('#totalDiscount'), $('{{isset($index) ? "#editForm".$index : "#createForm"}}').find('#discount').val(), $('{{isset($index) ? "#editForm".$index : "#createForm"}}').find('#total'), $('{{isset($index) ? "#editForm".$index : "#createForm"}}').find('#due'), $('{{isset($index) ? "#editForm".$index : "#createForm"}}').find('#payment-amount').val(), $('{{isset($index) ? "#editForm".$index : "#createForm"}}').find('#dueUser'), '{{$lang->table26}}', keyValueMap.get('{{isset($index) ? $index : "myArray"}}').itemsTest.concat(keyValueMap.get('{{isset($index) ? $index : "myArray"}}').itemsOffers))" />
                                        </div>
                                        </td>
                                    </tr>
                                    <tr class="table-light">
                                        <td colspan="4" class="text-end"><strong>{{$lang->table20}}</strong></td>
                                        <td id="totalDiscount">{{isset($index) ? $lang->table26.' '.$receipt->getTotalDiscount() : $lang->table26.' 0.00'}}</td>
                                    </tr>
                                    <tr class="table-light">
                                        <td colspan="4" class="text-end"><strong>{{$lang->table21}}</strong></td>
                                        <td id="total"><strong>{{isset($index) ? $lang->table26.' '.$receipt->getTotal() : $lang->table26.' 0.00'}} </strong></td>
                                    </tr>
                                    <tr class="table-light">
                                        <td colspan="4" class="text-end"><strong>{{$lang->table22}}</strong></td>
                                        <td id="paid"><strong>{{isset($index) ? $lang->table26.' '.$receipt->getAmountPaid() : $lang->table26.' 0.00'}} </strong></td>
                                    </tr>
                                    <tr class="table-light">
                                        <td colspan="4" class="text-end"><strong>{{$lang->table23}}</strong></td>
                                        <td id="due"><strong>{{isset($index) ? $lang->table26.' '.$receipt->getDue() : $lang->table26.' 0.00'}} </strong></td>
                                    </tr>
                                    <tr class="table-light">
                                        <td colspan="4" class="text-end"><strong>{{$lang->table24}}</strong></td>
                                        <td>
                                        <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">{{$lang->table26}}</span>
                                        <input type="number" id="delayedMoney" min="0" class="form-control form-control-sm" value="{{isset($index) ? $receipt->getDelayedMoney() : 0}}"/>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr class="table-light">
                                        <td colspan="4" class="text-end"><strong>{{$lang->table25}}</strong></td>
                                        <td id="dueUser"><strong>{{isset($index) ? $lang->table26.' '.$receipt->getDueUser() : $lang->table26.' 0.00'}}</strong></td>
                                    </tr>
                                    </tfoot>
                                </table>
                                </div>

                                <!-- Payment Section -->
                            <div class="mt-4">
                            <h6>{{$lang->label23}}</h6>
                            <div class="row">
                                <div class="col-md-4">
                                <!-- Date Input with Icon -->
                                <label for="payment-date" class="form-label"><i class="bi bi-clipboard2-check"></i>{{$lang->label24}}</label>
                                <input type="date" id="payment-date" value="{{isset($index) ? $receipt->getPaymentDate() : ''}}" class="form-control"/>
                                </div>
                                <div class="col-md-4">
                                <!-- Amount Paid Input with Icon -->
                                <label for="payment-amount" class="form-label"><i class="bi bi-clipboard2-check"></i>{{$lang->label25}}</label>
                                <input type="number" id="payment-amount" min="0" value="{{isset($index) ? $receipt->getAmountPaid() : ''}}" class="form-control" placeholder="{{$lang->hint16}}" onchange="myUpdatePrice(this.value, '{{$lang->table26}}', $('{{isset($index) ? "#editForm".$index : "#createForm"}}').find('#paid'), $('{{isset($index) ? "#editForm".$index : "#createForm"}}').find('#discount').val(), $('{{isset($index) ? "#editForm".$index : "#createForm"}}').find('#due'), $('{{isset($index) ? "#editForm".$index : "#createForm"}}').find('#dueUser'), keyValueMap.get('{{isset($index) ? $index : "myArray"}}').itemsTest.concat(keyValueMap.get('{{isset($index) ? $index : "myArray"}}').itemsOffers))" />
                                </div>
                                <div class="col-md-4">
                                <!-- Payment Method Select with Icon -->
                                <label for="payment-method" class="form-label"><i class="bi bi-clipboard2-check"></i>{{$lang->label26}}</label>
                                <select id="payment-method" class="form-select">
                                    <option selected disabled>{{$lang->selectBox1}}</option>
                                    @foreach($lang->payment as $key=>$pay)
                                    <option {{isset($index) ? ($receipt->getPaymentMethodId() === $key ? 'selected' : '') : ''}} value="{{$key}}">{{$pay}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            </div>

                            </div>
                            <div class="card-footer text-center">
                                <p class="mb-0">{{$lang->label27}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="{{isset($index) ? 'editForm'.$index : 'createForm'}}" class="btn btn-primary">{{isset($index) ? $lang->button3 : $lang->button2}}</button>
      </div>
    </div>
  </div>
</div>