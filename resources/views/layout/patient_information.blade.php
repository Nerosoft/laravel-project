<div class="row">
    <div class="col-12">
        <div class="pt-2 form-group text-center">
        <h5>{{ $lang->labelPatient }}</h5>
        <img id="preview" src="{{isset($index) && $patent->getAvatar() !== null ? $patent->getAvatar() : asset('img/admin/avatar1.png')}}" class="avatar preview">
        </div>
    </div>
    <div class="col-md-auto">
        <div class="pt-2 form-group">
            <label for="patent-name">
                <i class="bi bi-person"></i>
                {{$lang->label16}}
            </label>
            <input {{$state}} id="patent-name" type="text" class="form-control" value="{{isset($index) ? $patent->getName() : ''}}" name="patent-name" placeholder="{{$lang->hint1}}">
        </div>
    </div>
    
    <div class="col-md-auto">
        <div class="pt-2 form-group">
            <label for="patent-national-id">
                <i class="bi bi-person-video"></i>
                {{$lang->label5}}
            </label>
            <input {{$state}} id="patent-national-id" type="text" class="form-control" value="{{ isset($index) ? $patent->getNationalId() : '' }}" name="patent-national-id" placeholder="{{$lang->hint4}}">
        </div>
    </div>
    <div class="col-md-auto">
        <div class="pt-2 form-group">
            <label for="patent-passport-no">
                <i class="bi bi-globe-americas"></i>
                {{$lang->label6}}
            </label>
            <input {{$state}} id="patent-passport-no" type="text" class="form-control" value="{{isset($index) ? $patent->getPassportNo() : ''}}" name="patent-passport-no" placeholder="{{$lang->hint5}}">
        </div>
    </div>
    <div class="col-md-auto">
        <div class="pt-2 form-group">
            <label for="patent-email">
                <i class="bi bi-envelope"></i>
                {{$lang->label17}}
            </label>
            <input {{$state}} id="patent-email" type="text" class="form-control" value="{{isset($index) ? $patent->getEmail() : ''}}" name="patent-email" placeholder="{{$lang->hint2}}">
        </div>
    </div>
    <div class="col-md-auto">
        <div class="pt-2 form-group">
            <label for="patent-phone">
                <i class="bi bi-telephone"></i>
                {{$lang->label7}}
            </label>
            <input {{$state}} id="patent-phone" type="text" class="form-control" value="{{isset($index) ? $patent->getPhone() : ''}}" name="patent-phone" placeholder="{{$lang->hint6}}">
        </div>
    </div>
    <div class="col-md-auto">
        <div class="pt-2 form-group">
            <label for="patent-phone2">
                <i class="bi bi-telephone"></i>
                {{$lang->label8}}
            </label>
            <input {{$state}} id="patent-phone2" type="text" class="form-control" value="{{isset($index) ? $patent->getPhone2() : ''}}" name="patent-phone2" placeholder="{{$lang->hint7}}">
        </div>
    </div>
    
    <div class="col-md-auto">
        <div class="pt-2 form-group">
            <label for="last-period-date">
                <i class="bi bi-clock-history"></i>
                {{$lang->label10}}
            </label>
            <input {{$state}} onclick="openDatePicker(this)" id="last-period-date" type="date" title="{{$lang->hint9}}" class="form-control myNewDatelast-period-date" value="{{isset($index) ? $patent->getLastPeriodDate() : ''}}" name="last-period-date">  
        </div>
    </div>
    <div class="col-md-auto">
        <div class="pt-2 form-group">
            <label for="date-birth">
                <i class="bi bi-cake2"></i>
                {{$lang->label11}}
            </label>
            <input {{$state}} onclick="openDatePicker(this)" id="date-birth"  type="date" title="{{$lang->hint10}}" class="form-control myNewDate-birth" value="{{isset($index) ? $patent->getDateBirth() : ''}}" name="date-birth">
        </div>
    </div>
    <div class="col-md-auto">
        <div class="pt-2 form-group">
            <label for="patent-address">
                <i class="bi bi-geo-alt"></i>
                {{$lang->label12}}
            </label>
            <input {{$state}} id="patent-address" type="text" class="form-control" value="{{isset($index) ? $patent->getAddress() : ''}}" name="patent-address" placeholder="{{$lang->hint11}}">
        </div>
    </div>
    <div class="col-md-auto">
        <div class="pt-2 form-group">
            <label for="patent-gours">
                <i class="bi bi-clock"></i>
                {{$lang->label14}}
            </label>
            <input {{$state}} id="patent-hours" type="number" class="form-control" value="{{isset($index) ? $patent->getHours() : ''}}" name="patent-hours" placeholder="{{$lang->hint3}}">
        </div>
    </div>
</div> 
<div class="row pt-2">
    @foreach($lang->dis as $key=>$option)
        <div class="col-md-auto">
            <div class="form-group">
                <div class="form-check">
                    <input {{$state}} type="checkbox" id="choices[]" class="form-check-input" name="choices[]" value="{{$key}}"
                    {{isset($index) && isset($patent->getDiseaseId()[$key]) ? 'checked' : '' }}>
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
            <input {{$state}}  id="patent-other" type="text" class="form-control" value="{{isset($index) && is_string($patent->getDiseaseId()) ? $patent->getDiseaseId() : ''}}" name="patent-other" placeholder="{{$lang->hint8}}">
        </div>
    </div>
</div>