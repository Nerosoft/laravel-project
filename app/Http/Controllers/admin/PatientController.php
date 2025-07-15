<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Rays;
use Illuminate\Validation\Rule;
use App\Http\interface\LangObject;
use App\language\share\PatientInfo;
use App\instance\admin\contracts\Contracts;
use App\instance\admin\reception\Patent;

class PatientController extends PatientInfo implements LangObject
{
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
        if(Route::currentRouteName() === 'createPatent' || Route::currentRouteName() === 'editPatent'){
            $this->roll = [
                'avatar' => ['image', 'mimes:jpg,png', 'max:1024', 'dimensions:min_width=300,min_height=300'],
                'patent-name' => ['required', 'min:3'],
                'patent-nationality' => ['required', Rule::in(array_keys($this->ob[$this->ob['Setting']['Language']]['SelectNationalityBox']))],
                'patent-national-id' => ['required', 'min:3'],
                'patent-passport-no' => ['required', 'min:3'],
                'patent-email' => ['required', 'email'],
                'patent-phone' => ['required', 'regex:/^[0-9]{11}$/'],
                'patent-phone2' => ['required', 'regex:/^[0-9]{11}$/'],
                'patent-gender' => ['required', Rule::in(array_keys($this->ob[$this->ob['Setting']['Language']]['SelectGenderBox']))],
                'last-period-date' => ['required', 'date'],
                'date-birth' => ['required', 'date'],
                'patent-address' => ['required', 'min:3'],
                'patent-contracting' => ['required', Rule::in(isset($this->ob['Contracts'])?array_keys($this->ob['Contracts']):null)],
                'patent-hours' => ['required', 'integer'],
                'choices' => ['required_without:patent-other', 'array'], // Ensure at least one checkbox is selected
                'choices.*'=>[Rule::in(array_keys($this->ob[$this->ob['Setting']['Language']]['CheckBox']))],
                'patent-other'=>['required_without:choices', 'nullable', 'min:3'],
            ];
            $this->message = [
                'patent-name.required'=> $this->error1,
                'patent-name.min'=> $this->error2,
                'patent-national-id.required'=> $this->error3,
                'patent-national-id.min'=> $this->error4,
                'patent-passport-no.required'=> $this->error5,
                'patent-passport-no.min'=> $this->error6,
                'patent-email.required'=> $this->error7,
                'patent-email.email'=> $this->error8,
                'patent-phone.required'=> $this->error9,
                'patent-phone.regex'=> $this->error10,
                'patent-phone2.required'=> $this->error11,
                'patent-phone2.regex'=> $this->error12,
                'patent-address.required'=>$this->error13,
                'patent-address.min' => $this->error14, 
                'patent-hours.required'=>$this->error15,
                'patent-hours.integer' => $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentFastingHoursInvalid'],
                'avatar.dimensions' => $this->PatentAvatarDimensions,

                'patent-nationality.required'=>$this->error17,
                'patent-nationality.in'=>$this->ob[$this->ob['Setting']['Language']]['Patent']['PatentNationalityInvalid'],
                'patent-gender.required'=>$this->error18,
                'patent-gender.in'=>$this->ob[$this->ob['Setting']['Language']]['Patent']['PatentGenderInvalid'],
                'last-period-date.required'=>$this->error19,
                'last-period-date.date' => $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentLastPeriodDateInvalid'],
                'date-birth.required'=>$this->error20,
                'date-birth.date' => $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentDateBirthInvalid'],
                'patent-contracting.required'=>$this->error21,
                'patent-contracting.in' => $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentContractingInvalid'], 
                'choices.array' =>$this->ob[$this->ob['Setting']['Language']]['Patent']['PatentDiseaseInvalid'],
                'choices.*.in' =>$this->ob[$this->ob['Setting']['Language']]['Patent']['PatentDiseaseInvalid'],
                'patent-other.min'=>$this->error22,
                'avatar.image'=> $this->error23,
                'avatar.mimes'=> $this->ob[$this->ob['Setting']['Language']]['Patent']['PatentAvatarMimes'],
                'avatar.max'=> $this->error32,
                'avatar.uploaded'=>$this->error23,
                'choices.required_without'=>$this->error16,
                'patent-other.required_without'=>$this->error16,
            ];
        }else{
            $this->myContract = isset($this->ob['Contracts'])?Contracts::fromArray($this->ob['Contracts']):array();            
            parent::__construct('Patent', $this->ob, $this->ob['Patent']?Patent::fromArray(array_reverse($this->ob['Patent']), $this->myContract, $this->ob[$this->ob['Setting']['Language']]['SelectGenderBox'], $this->ob[$this->ob['Setting']['Language']]['SelectNationalityBox'], $this->ob[$this->ob['Setting']['Language']]['CheckBox']):array());
            $this->title5 = $this->ob[$this->language]['Patent']['PatentIamge'];
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
            $this->myContract = isset($this->ob['Contracts'])?Contracts::fromArray($this->ob['Contracts']):array();
            $this->successfully1 = $this->ob[$this->language]['Patent']['LoadMessage'];
        }
    }
    public function index(){
        return view('admin.reception.patients', [
            'lang'=> $this,
            'active'=>'Patent',
        ]);
    }
    public function makeAddPatent(){
        $this->avatar = request()->file('avatar') ? $this->setupImage():null;
        $this->myDbId = $this->generateUniqueIdentifier();
        $this->getCreateDataBase($this->ob, 'Patent', $this->myDbId, $this);
        return back()->with('success', $this->ob[$this->ob['Setting']['Language']]['Patent']['PatientsAdd']);
    }
    public function makeEditPatent(){
        $this->roll['id'] = ['required', Rule::in($this->ob['Patent']?array_keys($this->ob['Patent']):null)];
        $this->message['id.required'] = $this->ob[$this->ob['Setting']['Language']]['Patent']['IdIsReq'];
        $this->message['id.in'] = $this->ob[$this->ob['Setting']['Language']]['Patent']['IdIsInv'];
        $this->avatar = request()->file('avatar') ? $this->setupImage() : $this->ob['Patent'][request()->input('id')]['Avatar'];
        $this->getEditDataBase($this->ob, 'Patent', $this);
        return back()->with('success', $this->ob[$this->ob['Setting']['Language']]['Patent']['PatientsEdit']);
    }
    private function setupImage(){
        return 'data:' . request()->file('avatar')->getClientMimeType() . ';base64,' . base64_encode(file_get_contents(request()->file('avatar')));
    }
    public function getMyObject(){
        request()->validate($this->roll, $this->message);
        return array('PatentCode'=>isset($this->myDbId)?$this->myDbId:request()->input('id'), 'Avatar'=>$this->avatar, 'Name'=>request()->input('patent-name'), 'Nationality'=>request()->input('patent-nationality'), 'NationalId'=>request()->input('patent-national-id'), 'PassportNo'=>request()->input('patent-passport-no'), 'Email'=>request()->input('patent-email'), 'Phone'=>request()->input('patent-phone'), 'Phone2'=>request()->input('patent-phone2'), 'Gender'=>request()->input('patent-gender'), 'LastPeriodDate'=>request()->input('last-period-date'), 'DateBirth'=>request()->input('date-birth'), 'Address'=>request()->input('patent-address'), 'Contracting'=>request()->input('patent-contracting'), 'Hours'=>request()->input('patent-hours'), 'Disease'=>request()->input('patent-other') ? request()->input('patent-other'): request()->input('choices'));
    }
}
