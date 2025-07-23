<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\interface\LangObject;
use App\language\share\PatientInfo;
use App\instance\admin\contracts\Contracts;
use App\Http\interface\ActionInit;
use App\Http\interface\ValidRull;
use App\instance\admin\reception\Patent;
use App\Models\Rays;

class PatientController extends PatientInfo implements LangObject, ActionInit, ValidRull
{
    public function getData(){
        $this->myContract = isset($this->ob['Contracts'])?Contracts::fromArray($this->ob['Contracts']):array();            
        return $this->ob['Patent']?Patent::fromArray(array_reverse($this->ob['Patent']), $this->myContract, $this->ob[$this->language]['SelectGenderBox'], $this->ob[$this->language]['SelectNationalityBox'], $this->ob[$this->language]['CheckBox']):array();    
    }
    public function initView(){
        $this->title5 = $this->ob[$this->language]['Patent']['PatentIamge'];
        $this->ButtonImage = $this->ob[$this->language]['Patent']['ButtonImage'];
        //init table
        $this->table24 = $this->ob[$this->language]['Patent']['TablePatentCode'];
        $this->table8 = $this->ob[$this->language]['Patent']['TablePatentAvatar'];
        $this->table9 = $this->ob[$this->language]['Patent']['TablePatentName'];
        $this->table10 = $this->ob[$this->language]['Patent']['TablePatentNationality'];
        $this->table22 = $this->ob[$this->language]['Patent']['TablePatentNationalId'];
        $this->table12 = $this->ob[$this->language]['Patent']['TablePatentPassportNo'];
        $this->table13 = $this->ob[$this->language]['Patent']['TablePatentEmail'];
        $this->table14 = $this->ob[$this->language]['Patent']['TablePatentPhone'];
        $this->table15 = $this->ob[$this->language]['Patent']['TablePatentPhone2'];
        $this->table16 = $this->ob[$this->language]['Patent']['TablePatentGender'];
        $this->table17 = $this->ob[$this->language]['Patent']['TablePatentLastPeriodDate'];
        $this->table18 = $this->ob[$this->language]['Patent']['TablePatentDateBirth'];
        $this->table19 = $this->ob[$this->language]['Patent']['TablePatentContracting'];
        $this->table20 = $this->ob[$this->language]['Patent']['TablePatentHours'];
        $this->table21 = $this->ob[$this->language]['Patent']['TablePatentDisease'];
        $this->table23 = $this->ob[$this->language]['Patent']['TablePatentAddress'];
        //init label
        $this->label4 = $this->ob[$this->language]['Patent']['LabelPatentNationality'];
        $this->label9 = $this->ob[$this->language]['Patent']['LabelPatentGender'];
        $this->label13 = $this->ob[$this->language]['Patent']['LabelPatentContracting'];
        $this->nationality = $this->ob[$this->language]['SelectNationalityBox'];
        $this->gender = $this->ob[$this->language]['SelectGenderBox'];
        $this->selectBox1 = $this->ob[$this->language]['Patent']['SelectBoxPatentNationality'];
        $this->selectBox2 = $this->ob[$this->language]['Patent']['SelectBoxPatentGender'];
        $this->selectBox5 = $this->ob[$this->language]['Patent']['SelectBoxPatentContracting'];
    }
    public function initValid(){
        $this->roll['avatar' ] = ['image', 'mimes:jpg,png', 'max:1024', 'dimensions:min_width=300,min_height=300'];
        $this->roll['patent-name' ] = ['required', 'min:3'];
        $this->roll['patent-nationality' ] = ['required', Rule::in(array_keys($this->ob[$this->ob['Setting']['Language']]['SelectNationalityBox']))];
        $this->roll['patent-national-id' ] = ['required', 'min:3'];
        $this->roll['patent-passport-no' ] = ['required', 'min:3'];
        $this->roll['patent-email' ] = ['required', 'email'];
        $this->roll['patent-phone' ] = ['required', 'regex:/^[0-9]{11}$/'];
        $this->roll['patent-phone2' ] = ['required', 'regex:/^[0-9]{11}$/'];
        $this->roll['patent-gender' ] = ['required', Rule::in(array_keys($this->ob[$this->ob['Setting']['Language']]['SelectGenderBox']))];
        $this->roll['last-period-date' ] = ['required', 'date'];
        $this->roll['date-birth' ] = ['required', 'date'];
        $this->roll['patent-address' ] = ['required', 'min:3'];
        $this->roll['patent-contracting' ] = ['required', Rule::in(isset($this->ob['Contracts'])?array_keys($this->ob['Contracts']):null)];
        $this->roll['patent-hours' ] = ['required', 'integer'];
        $this->roll['choices' ] = ['required_without:patent-other', 'array']; // Ensure at least one checkbox is selected
        $this->roll['choices.*'] = [Rule::in(array_keys($this->ob[$this->ob['Setting']['Language']]['CheckBox']))];
        $this->roll['patent-other'] = ['required_without:choices', 'nullable', 'min:3'];
        $this->message['patent-name.required'] = $this->error1;
        $this->message['patent-name.min'] = $this->error2;
        $this->message['patent-national-id.required'] = $this->error3;
        $this->message['patent-national-id.min'] = $this->error4;
        $this->message['patent-passport-no.required'] = $this->error5;
        $this->message['patent-passport-no.min'] = $this->error6;
        $this->message['patent-email.required'] = $this->error7;
        $this->message['patent-email.email'] = $this->error8;
        $this->message['patent-phone.required'] = $this->error9;
        $this->message['patent-phone.regex'] = $this->error10;
        $this->message['patent-phone2.required'] = $this->error11;
        $this->message['patent-phone2.regex'] = $this->error12;
        $this->message['patent-address.required'] =$this->error13;
        $this->message['patent-address.min' ] = $this->error14; 
        $this->message['patent-hours.required'] = $this->error15;
        $this->message['patent-hours.integer' ] = $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentFastingHoursInvalid'];
        $this->message['avatar.dimensions' ] = $this->PatentAvatarDimensions;
        $this->message['patent-nationality.required'] =$this->error17;
        $this->message['patent-nationality.in'] =$this->ob[$this->ob['Setting']['Language']]['Patent']['PatentNationalityInvalid'];
        $this->message['patent-gender.required'] =$this->error18;
        $this->message['patent-gender.in'] =$this->ob[$this->ob['Setting']['Language']]['Patent']['PatentGenderInvalid'];
        $this->message['last-period-date.required'] =$this->error19;
        $this->message['last-period-date.date' ] = $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentLastPeriodDateInvalid'];
        $this->message['date-birth.required'] =$this->error20;
        $this->message['date-birth.date' ] = $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentDateBirthInvalid'];
        $this->message['patent-contracting.required'] =$this->error21;
        $this->message['patent-contracting.in' ] = $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentContractingInvalid']; 
        $this->message['choices.array' ] =$this->ob[$this->ob['Setting']['Language']]['Patent']['PatentDiseaseInvalid'];
        $this->message['choices.*.in' ] =$this->ob[$this->ob['Setting']['Language']]['Patent']['PatentDiseaseInvalid'];
        $this->message['patent-other.min'] =$this->error22;
        $this->message['avatar.image'] = $this->error23;
        $this->message['avatar.mimes'] = $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentAvatarMimes'];
        $this->message['avatar.max'] = $this->error32;
        $this->message['avatar.uploaded'] =$this->error23;
        $this->message['choices.required_without'] =$this->error16;
        $this->message['patent-other.required_without'] =$this->error16;
        $this->avatar = request()->file('avatar') ? $this->setupImage():(isset($this->ob['Patent'][request()->input('id')]['Avatar'])?$this->ob['Patent'][request()->input('id')]['Avatar']:null);

    }
    public function initValidRull(){
        array_push($this->roll['id'], Rule::in($this->ob['Patent']?array_keys($this->ob['Patent']):null));
    }
    public function __construct(){
        $this->ob = Rays::find(request()->session()->get('userId'));
        $this->error1 = $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentNameRequired'];
        $this->error2 = $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentNameInvalid'];
        $this->error3 = $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentNationalIdRequired'];
        $this->error4 = $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentNationalIdInvalid'];
        $this->error5 = $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentPassportNoRequired'];
        $this->error6 = $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentPassportNoInvalid'];
        $this->error7 = $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentEmailRequired'];
        $this->error8 = $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentEmailInvalid'];
        $this->error9 = $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentPhoneRequired'];
        $this->error10 = $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentPhoneInvalid'];
        $this->error11 = $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentPhone2Required'];
        $this->error12 = $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentPhone2Invalid'];
        $this->error13 = $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentAddressRequired'];
        $this->error14 = $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentAddressInvalid'];
        $this->error15 = $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentFastingHoursRequired'];
        $this->error16 = $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentDiseaseRequired'];
        $this->error17 = $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentNationalityRequired'];
        $this->error18 = $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentGenderRequired'];
        $this->error19 = $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentLastPeriodDateRequired'];
        $this->error20 = $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentDateBirthRequired'];
        $this->error21 = $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentContractingRequired'];
        $this->error22 = $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentDiseasOtherInvalid'];
        $this->error23 = $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentAvatarImage'];
        $this->error32 = $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentAvatarMax'];
        $this->PatentAvatarDimensions = $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentAvatarDimensions'];
        parent::__construct($this, 'Patent', $this->ob);
    }
    public function index(){
        return view('admin.reception.patients', [
            'lang'=> $this,
            'active'=>'Patent',
        ]);
    }
    public function makeAddPatent(){
        $this->getCreateDataBase($this->ob, 'Patent', $this->generateUniqueIdentifier(), $this);
        return back()->with('success', $this->successfulyMessage);
    }
    public function makeEditPatent(){
        $this->getEditDataBase($this->ob, 'Patent', $this);
        return back()->with('success', $this->ob[$this->ob['Setting']['Language']]['Patent']['MessageModelEdit']);
    }
    private function setupImage(){
        return 'data:' . request()->file('avatar')->getClientMimeType() . ';base64,' . base64_encode(file_get_contents(request()->file('avatar')));
    }
    public function getMyObject($myDbId = null){
        request()->validate($this->roll, $this->message);
        return array('PatentCode'=>$myDbId?$myDbId:request()->input('id'), 'Avatar'=>$this->avatar, 'Name'=>request()->input('patent-name'), 'Nationality'=>request()->input('patent-nationality'), 'NationalId'=>request()->input('patent-national-id'), 'PassportNo'=>request()->input('patent-passport-no'), 'Email'=>request()->input('patent-email'), 'Phone'=>request()->input('patent-phone'), 'Phone2'=>request()->input('patent-phone2'), 'Gender'=>request()->input('patent-gender'), 'LastPeriodDate'=>request()->input('last-period-date'), 'DateBirth'=>request()->input('date-birth'), 'Address'=>request()->input('patent-address'), 'Contracting'=>request()->input('patent-contracting'), 'Hours'=>request()->input('patent-hours'), 'Disease'=>request()->input('patent-other') ? request()->input('patent-other'): request()->input('choices'));
    }
}
