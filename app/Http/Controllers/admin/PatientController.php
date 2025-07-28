<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\interface\LangObject;
use App\language\share\PatientInfo;
use App\instance\admin\contracts\Contracts;
use App\instance\admin\reception\Patent;
use App\Models\Rays;
use Illuminate\Support\Facades\Route;
use App\Http\interface\ValidRule;
use App\Http\interface\PageTable;

class PatientController extends PatientInfo implements LangObject, ValidRule, PageTable
{
    
    public function getTableData(){
        $this->myContract = isset($this->getDataBase()['Contracts'])?Contracts::fromArray($this->getDataBase()['Contracts']):array();                
        return $this->myPat?Patent::fromArray(array_reverse($this->myPat), $this->myContract, $this->getDataBase()[$this->language]['SelectGenderBox'], $this->getDataBase()[$this->language]['SelectNationalityBox'], $this->dis):array();     
    }
    public function getRouteDelete(){
        return route('deleteItem', 'Patent');
    }
     public function getValidRule(){
        array_push($this->roll['id'], Rule::in($this->myPat?array_keys($this->myPat):null));
        $this->initValid();
    }
    public function initView(){
        $this->callConst('Patent');
        $this->title5 = $this->getDataBase()[$this->language]['Patent']['PatentIamge'];
        $this->ButtonImage = $this->getDataBase()[$this->language]['Patent']['ButtonImage'];
        //init table
        $this->table24 = $this->getDataBase()[$this->language]['Patent']['TablePatentCode'];
        $this->table8 = $this->getDataBase()[$this->language]['Patent']['TablePatentAvatar'];
        $this->table9 = $this->getDataBase()[$this->language]['Patent']['TablePatentName'];
        $this->table10 = $this->getDataBase()[$this->language]['Patent']['TablePatentNationality'];
        $this->table22 = $this->getDataBase()[$this->language]['Patent']['TablePatentNationalId'];
        $this->table12 = $this->getDataBase()[$this->language]['Patent']['TablePatentPassportNo'];
        $this->table13 = $this->getDataBase()[$this->language]['Patent']['TablePatentEmail'];
        $this->table14 = $this->getDataBase()[$this->language]['Patent']['TablePatentPhone'];
        $this->table15 = $this->getDataBase()[$this->language]['Patent']['TablePatentPhone2'];
        $this->table16 = $this->getDataBase()[$this->language]['Patent']['TablePatentGender'];
        $this->table17 = $this->getDataBase()[$this->language]['Patent']['TablePatentLastPeriodDate'];
        $this->table18 = $this->getDataBase()[$this->language]['Patent']['TablePatentDateBirth'];
        $this->table19 = $this->getDataBase()[$this->language]['Patent']['TablePatentContracting'];
        $this->table20 = $this->getDataBase()[$this->language]['Patent']['TablePatentHours'];
        $this->table21 = $this->getDataBase()[$this->language]['Patent']['TablePatentDisease'];
        $this->table23 = $this->getDataBase()[$this->language]['Patent']['TablePatentAddress'];
        //init label
        $this->label4 = $this->getDataBase()[$this->language]['Patent']['LabelPatentNationality'];
        $this->label9 = $this->getDataBase()[$this->language]['Patent']['LabelPatentGender'];
        $this->label13 = $this->getDataBase()[$this->language]['Patent']['LabelPatentContracting'];
        $this->selectBox1 = $this->getDataBase()[$this->language]['Patent']['SelectBoxPatentNationality'];
        $this->selectBox2 = $this->getDataBase()[$this->language]['Patent']['SelectBoxPatentGender'];
        $this->selectBox5 = $this->getDataBase()[$this->language]['Patent']['SelectBoxPatentContracting'];
    }
    public function initValid(){
        $this->roll['avatar' ] = ['image', 'mimes:jpg,png', 'max:1024', 'dimensions:min_width=300,min_height=300'];
        $this->roll['patent-name' ] = ['required', 'min:3'];
        $this->roll['patent-nationality' ] = ['required', Rule::in(array_keys($this->nationality))];
        $this->roll['patent-national-id' ] = ['required', 'min:3'];
        $this->roll['patent-passport-no' ] = ['required', 'min:3'];
        $this->roll['patent-email' ] = ['required', 'email'];
        $this->roll['patent-phone' ] = ['required', 'regex:/^[0-9]{11}$/'];
        $this->roll['patent-phone2' ] = ['required', 'regex:/^[0-9]{11}$/'];
        $this->roll['patent-gender' ] = ['required', Rule::in(array_keys($this->gender))];
        $this->roll['last-period-date' ] = ['required', 'date'];
        $this->roll['date-birth' ] = ['required', 'date'];
        $this->roll['patent-address' ] = ['required', 'min:3'];
        $this->roll['patent-contracting' ] = ['required', Rule::in(isset($this->getDataBase()['Contracts'])?array_keys($this->getDataBase()['Contracts']):null)];
        $this->roll['patent-hours' ] = ['required', 'integer'];
        $this->roll['choices' ] = ['required_without:patent-other', 'array']; // Ensure at least one checkbox is selected
        $this->roll['choices.*'] = [Rule::in(array_keys($this->dis))];
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
        $this->message['patent-hours.integer' ] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentFastingHoursInvalid'];
        $this->message['avatar.dimensions' ] = $this->PatentAvatarDimensions;
        $this->message['patent-nationality.required'] =$this->error17;
        $this->message['patent-nationality.in'] =$this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentNationalityInvalid'];
        $this->message['patent-gender.required'] =$this->error18;
        $this->message['patent-gender.in'] =$this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentGenderInvalid'];
        $this->message['last-period-date.required'] =$this->error19;
        $this->message['last-period-date.date' ] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentLastPeriodDateInvalid'];
        $this->message['date-birth.required'] =$this->error20;
        $this->message['date-birth.date' ] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentDateBirthInvalid'];
        $this->message['patent-contracting.required'] =$this->error21;
        $this->message['patent-contracting.in' ] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentContractingInvalid']; 
        $this->message['choices.array' ] =$this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentDiseaseInvalid'];
        $this->message['choices.*.in' ] =$this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentDiseaseInvalid'];
        $this->message['patent-other.min'] =$this->error22;
        $this->message['avatar.image'] = $this->error23;
        $this->message['avatar.mimes'] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentAvatarMimes'];
        $this->message['avatar.max'] = $this->error32;
        $this->message['avatar.uploaded'] =$this->error23;
        $this->message['choices.required_without'] =$this->error16;
        $this->message['patent-other.required_without'] =$this->error16;
    }
    public function __construct(){
        $this->ob = Rays::find(request()->session()->get('userId'));
        $this->error1 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentNameRequired'];
        $this->error2 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentNameInvalid'];
        $this->error3 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentNationalIdRequired'];
        $this->error4 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentNationalIdInvalid'];
        $this->error5 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentPassportNoRequired'];
        $this->error6 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentPassportNoInvalid'];
        $this->error7 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentEmailRequired'];
        $this->error8 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentEmailInvalid'];
        $this->error9 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentPhoneRequired'];
        $this->error10 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentPhoneInvalid'];
        $this->error11 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentPhone2Required'];
        $this->error12 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentPhone2Invalid'];
        $this->error13 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentAddressRequired'];
        $this->error14 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentAddressInvalid'];
        $this->error15 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentFastingHoursRequired'];
        $this->error16 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentDiseaseRequired'];
        $this->error17 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentNationalityRequired'];
        $this->error18 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentGenderRequired'];
        $this->error19 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentLastPeriodDateRequired'];
        $this->error20 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentDateBirthRequired'];
        $this->error21 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentContractingRequired'];
        $this->error22 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentDiseasOtherInvalid'];
        $this->error23 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentAvatarImage'];
        $this->error32 = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentAvatarMax'];
        $this->PatentAvatarDimensions = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['PatentAvatarDimensions'];
        $this->gender = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['SelectGenderBox'];
        $this->nationality = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['SelectNationalityBox'];
        parent::__construct($this, 'Patent');
    }
    public function index(){
        return view('admin.reception.patients', [
            'lang'=> $this,
            'active'=>'Patent',
        ]);
    }
    public function makeAddPatent(){
        $this->getCreateDataBase($this->getDataBase(), 'Patent', $this->generateUniqueIdentifier(), $this);
        return back()->with('success', $this->successfulyMessage);
    }
    public function makeEditPatent(){
        $this->getEditDataBase($this->getDataBase(), 'Patent', $this);
        return back()->with('success', $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Patent']['MessageModelEdit']);
    }
    private function setupImage(){
        return 'data:' . request()->file('avatar')->getClientMimeType() . ';base64,' . base64_encode(file_get_contents(request()->file('avatar')));
    }
    public function getMyObject($myDbId = null){
        request()->validate($this->roll, $this->message);
        return array('PatentCode'=>$myDbId?$myDbId:request()->input('id'), 'Avatar'=>request()->file('avatar') ? $this->setupImage():(isset($this->myPat[request()->input('id')]['Avatar'])?$this->myPat[request()->input('id')]['Avatar']:null),'Name'=>request()->input('patent-name'), 'Nationality'=>request()->input('patent-nationality'), 'NationalId'=>request()->input('patent-national-id'), 'PassportNo'=>request()->input('patent-passport-no'), 'Email'=>request()->input('patent-email'), 'Phone'=>request()->input('patent-phone'), 'Phone2'=>request()->input('patent-phone2'), 'Gender'=>request()->input('patent-gender'), 'LastPeriodDate'=>request()->input('last-period-date'), 'DateBirth'=>request()->input('date-birth'), 'Address'=>request()->input('patent-address'), 'Contracting'=>request()->input('patent-contracting'), 'Hours'=>request()->input('patent-hours'), 'Disease'=>request()->input('patent-other') ? request()->input('patent-other'): request()->input('choices'));
    }
}
