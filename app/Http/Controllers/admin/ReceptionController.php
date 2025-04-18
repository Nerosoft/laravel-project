<?php
namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rays;
use Illuminate\Validation\Rule;
use App\instance\admin\reception\Receipt;
use App\language\admin\reception\Vault;
use App\language\admin\reception\Invoices;
use App\language\admin\reception\PatientRegisteration;
use App\language\admin\reception\Retrieved;
use App\language\admin\reception\Patients;
use App\language\admin\reception\Prefix;
use App\language\admin\reception\Knows;
use App\language\admin\action\AppModel;
use App\instance\admin\reception\Patent;

class ReceptionController extends Controller
{
    private $testArr = array();
    private $currentOffersArr = array();
    public function initArray($arr){
        $myArr = array();
        foreach ($arr as $mykey => $res) {
            $offerArr = array();
            $testArr = array();
            foreach ($res->getCurrentOffers() as $offer)
                $offerArr[] = $offer->getObject2();
            foreach ($res->getTest() as $test)
                $testArr[] = $test->getObject2();
            array_push($myArr, array($offerArr, $testArr, $mykey));
        }
        return $myArr;
    }
    public function index($id){
        $lang = $this->initLanguage($id);
        if($id === 'Vault'){
            return view('admin.reception.vault',[
                'lang'=> $lang,
                'logOut'=>route('admin.logout'),
                'active'=>'Reception',
                'activeItem'=>'Vault',      
            ]);
        }
        else if($id === 'Invoices'){
            return view('admin.reception.invoices',[
                'lang'=> $lang,
                'logOut'=>route('admin.logout'),
                'active'=>'Reception',
                'activeItem'=>'Invoices',       
            ]);
        }
        else if($id === 'PatientRegisteration'){
            return view('admin.reception.patientRegisteration',[
                'lang'=> $lang,
                'logOut'=>route('admin.logout'),
                'active'=>'Reception',
                'activeItem'=>'PatientRegisteration',
                'allRes'=>$this->initArray($lang->arr6),
            ]);
        }
        else if($id === 'Retrieved'){
            return view('admin.reception.retrieved',[
                'lang'=> $lang,
                'logOut'=>route('admin.logout'),
                'active'=>'Reception',
                'activeItem'=>'Retrieved',           
            ]);
        }
        else if($id === 'Patients'){
            return view('admin.reception.patients',[
                'lang'=> $lang,
                'logOut'=>route('admin.logout'),
                'active'=>'Reception',
                'activeItem'=>'Patients',           
            ]);
        }
        else if($id === 'Prefix'){
            return view('admin.reception.prefix',[
                'lang'=> $lang,
                'logOut'=>route('admin.logout'),
                'active'=>'Reception',
                'activeItem'=>'Prefix',    
            ]);
        }
        else if($id === 'Knows'){
            return view('admin.reception.knows',[
                'lang'=> $lang,
                'logOut'=>route('admin.logout'),
                'active'=>'Reception',
                'activeItem'=>'Knows',   
            ]);
        }else
            abort(404);
    }
    
    public function createPatientServices(Request $request){
        $lang = $this->initLanguage('patientRegisteration_create', Rays::find(request()->session()->get('userId')));
        $validated = $request->validate([
            'item' => ['required', 'array'],
            'item2' => ['array'],
            'item.*' => ['required',
            function ($attribute, $value, $fail) use ($lang) {// use for loop
                if(is_array($value))
                    if(array_key_exists("Id", $value) && array_key_exists("Name", $value) && array_key_exists("Shortcut", $value) && array_key_exists("Price", $value) && array_key_exists("InputOutputLab", $value))
                        foreach ([...$lang->arr2,...$lang->arr3,...$lang->arr4] as $myTest)
                            if ($myTest->getMyId() === $value['Id'] && $myTest->getName() === $value['Name'] && $myTest->getShortcut() === $value['Shortcut'] && $myTest->getPrice() === $value['Price'] && $myTest->getInputOutputLab() === $value['InputOutputLab'])
                            {
                                array_push($this->testArr, $myTest);
                                return;
                            }   
                $fail($lang->error13);
            },],
            'item2.*' => ['required', function ($attribute, $value, $fail) use ($lang) {               
                if(is_array($value))
                    if(array_key_exists("Id", $value) && array_key_exists("Name", $value) && array_key_exists("Shortcut", $value) && array_key_exists("Price", $value) && array_key_exists("DisplayPrice", $value) && array_key_exists("State", $value))
                        foreach ($lang->arr5 as $myOffer)
                            if ($myOffer->getMyId() === $value['Id'] && $myOffer->getName() === $value['Name'] && $myOffer->getShortcut() === $value['Shortcut'] && $myOffer->getPrice() === $value['Price'] && $myOffer->getDisplayPrice() === $value['DisplayPrice'] && $myOffer->getState() === $value['State'])
                            {
                                array_push($this->currentOffersArr, $myOffer);
                                return;
                            }
                $fail($lang->error13);
            },],
            'patentCode' => ['required', Rule::in($lang->arr6)],
            'know' => ['required', Rule::in($lang->arr1)],
            'discount' => ['required', 'numeric', 'min:0'],
            'delayedMoney' => ['required', 'numeric', 'min:0'],
            'paymentDate' => ['required', 'date'],
            'paymentAmount' => ['required', 'numeric', 'min:0'],
            'paymentMethod' => ['required', Rule::in($lang->paymentKeys)],
        ],[
            'item.required'=>$lang->error5,
            'item.array'=>$lang->error13,
            'item2.array'=>$lang->error13,
            'patentCode.required'=>$lang->error3,
            'patentCode.in'=>$lang->error15,
            'know.required'=>$lang->error4,
            'know.in'=>$lang->error17,
            'discount.required'=>$lang->error9,
            'discount.numeric'=>$lang->error10,
            'discount.min'=>$lang->error10,
            'delayedMoney.required'=>$lang->error11,
            'delayedMoney.numeric'=>$lang->error12,
            'delayedMoney.min'=>$lang->error12,
            'paymentDate.required'=>$lang->error6,
            'paymentDate.date'=>$lang->error14,
            'paymentAmount.required'=>$lang->error7,
            'paymentAmount.numeric'=>$lang->error16,
            'paymentAmount.min'=>$lang->error16,
            'paymentMethod.required'=>$lang->error2,
            'paymentMethod.in'=>$lang->error8,
            'item.*.required'=>$lang->error13,
            'item2.*.required'=>$lang->error13
        ]);
        $MyReceipt = new Receipt(request()->input('patentCode'),
        request()->input('know'),
        empty($this->currentOffersArr) ? null : $this->currentOffersArr, $this->testArr,
        (int)request()->input('discount'), (int)request()->input('delayedMoney'),
        request()->input('paymentDate'), (int)request()->input('paymentAmount'),
        request()->input('paymentMethod'));
        $this->getCreateDataBase('Receipt', $MyReceipt->getObject());
        return response()->json([
            'success' => true,
            'message'=>$lang->successfully1
        ]);
    }
    public function editPatientServices(Request $request){
        $lang = $this->initLanguage('patientRegisteration_edit', Rays::find(request()->session()->get('userId')));
        $validated = $request->validate([
            'id' => ['required', Rule::in($lang->size1)],
            'item' => ['required', 'array'],
            'item2' => ['array'],
            'item.*' => ['required',
            function ($attribute, $value, $fail) use ($lang) {// use for loop
                if(is_array($value))
                    if(array_key_exists("Id", $value) && array_key_exists("Name", $value) && array_key_exists("Shortcut", $value) && array_key_exists("Price", $value) && array_key_exists("InputOutputLab", $value))
                        foreach ([...$lang->arr2,...$lang->arr3,...$lang->arr4] as $myTest)
                            if ($myTest->getMyId() === $value['Id'] && $myTest->getName() === $value['Name'] && $myTest->getShortcut() === $value['Shortcut'] && $myTest->getPrice() === $value['Price'] && $myTest->getInputOutputLab() === $value['InputOutputLab'])
                            {
                                array_push($this->testArr, $myTest);
                                return;
                            }   
                $fail($lang->error13);
            },],
            'item2.*' => ['required', function ($attribute, $value, $fail) use ($lang) {
                if(is_array($value))
                    if(array_key_exists("Id", $value) && array_key_exists("Name", $value) && array_key_exists("Shortcut", $value) && array_key_exists("Price", $value) && array_key_exists("DisplayPrice", $value) && array_key_exists("State", $value))
                        foreach ($lang->arr5 as $myOffer)
                            if ($myOffer->getMyId() === $value['Id'] && $myOffer->getName() === $value['Name'] && $myOffer->getShortcut() === $value['Shortcut'] && $myOffer->getPrice() === $value['Price'] && $myOffer->getDisplayPrice() === $value['DisplayPrice'] && $myOffer->getState() === $value['State'])
                            {
                                array_push($this->currentOffersArr, $myOffer);
                                return;
                            }
                $fail($lang->error13);
            },],
            'patentCode' => ['required', Rule::in($lang->arr6)],
            'know' => ['required', Rule::in($lang->arr1)],
            'discount' => ['required', 'numeric', 'min:0'],
            'delayedMoney' => ['required', 'numeric', 'min:0'],
            'paymentDate' => ['required', 'date'],
            'paymentAmount' => ['required', 'numeric', 'min:0'],
            'paymentMethod' => ['required', Rule::in($lang->paymentKeys)],
        ],[
            'id.required' => $lang->error18,
            'id.in' => $lang->error19,
            'item.required'=>$lang->error5,
            'item.array'=>$lang->error13,
            'item2.array'=>$lang->error13,
            'patentCode.required'=>$lang->error3,
            'patentCode.in'=>$lang->error15,
            'know.required'=>$lang->error4,
            'know.in'=>$lang->error17,
            'discount.required'=>$lang->error9,
            'discount.numeric'=>$lang->error10,
            'discount.min'=>$lang->error10,
            'delayedMoney.required'=>$lang->error11,
            'delayedMoney.numeric'=>$lang->error12,
            'delayedMoney.min'=>$lang->error12,
            'paymentDate.required'=>$lang->error6,
            'paymentDate.date'=>$lang->error14,
            'paymentAmount.required'=>$lang->error7,
            'paymentAmount.numeric'=>$lang->error16,
            'paymentAmount.min'=>$lang->error16,
            'paymentMethod.required'=>$lang->error2,
            'paymentMethod.in'=>$lang->error8,
            'item.*.required'=>$lang->error13,
            'item2.*.required'=>$lang->error13
        ]);
        $MyReceipt = new Receipt(request()->input('patentCode'),
        request()->input('know'),
        empty($this->currentOffersArr) ? null : $this->currentOffersArr, $this->testArr,
        (int)request()->input('discount'), (int)request()->input('delayedMoney'),
        request()->input('paymentDate'), (int)request()->input('paymentAmount'),
        request()->input('paymentMethod'));
        $this->getEditDataBase('Receipt', $MyReceipt->getObject());  
        return response()->json([
            'success' => true,
            'message'=>$lang->successfully1
        ]);
    }
    public function deletePatientServices(){
        $lang = $this->initLanguage('patientRegisteration_delete', Rays::find(request()->session()->get('userId')));
        request()->validate([
            'id' => ['required', Rule::in($lang->size1)],
        ], [
            'id.required' => $lang->error18,
            'id.in' => $lang->error19,
        ]);
        $this->getDeleteDatabade('Receipt');
        return back()->with('success', $lang->successfully1);
    }
    public function createKnows(){
        $lang = $this->initLanguage('knows_create', Rays::find(request()->session()->get('userId')));
        request()->validate([
            'name' => ['required', 'min:3'],
        ], [
            'name.required' => $lang->error1,
            'name.min' => $lang->error2,
        ]);
        $this->getCreateDataBase('Knows', ['Name'=>request()->input('name')]);
        return back()->with('success', $lang->successfully1);

    }
    public function editKnows(){
        $lang = $this->initLanguage('knows_edit', Rays::find(request()->session()->get('userId')));
        $validator = Validator::make(request()->all(), [
            'id' => ['required', Rule::in($lang->size1)],
            'name' => ['required', 'min:3'],
        ], [
            'id.required' => $lang->error3,
            'id.in' => $lang->error4,
            'name.required' => $lang->error1,
            'name.min' => $lang->error2,
        ]);
        if ($validator->fails())
            return back()->withErrors($validator);
        else{
            $this->getEditDataBase('Knows', ['Name'=>request()->input('name')]);
            return back()->with('success', $lang->successfully1);
        }
  
    }
    public function deleteKnows(){
        $lang = $this->initLanguage('knows_delete', Rays::find(request()->session()->get('userId')));
        request()->validate([
            'id' => ['required', Rule::in($lang->size1)],
        ], [
            'id.required' => $lang->error3,
            'id.in' => $lang->error4,
        ]);
        $this->getDeleteDatabade('Knows');
        return back()->with('success', $lang->successfully1);

    }
    private function initLanguage($id, $mes = null){
        switch ($id) {
            case 'Vault':
                return new Vault();
            case 'Prefix':
                return new Prefix();
            case 'Invoices':
                return new Invoices();
            case 'Retrieved':
                return new Retrieved();

            case 'PatientRegisteration':
                return new PatientRegisteration($id);
            case 'patientRegisteration_create':
                return new AppModel('option1', $mes[$mes['Setting']['Language']]['Error'], 'PatientRegisteration', $mes[$mes['Setting']['Language']]['Message']['PatientRegisterationAdd'], $mes['Patent'], isset($mes['Knows']) ? array_keys($mes['Knows']) : array(), array_keys($mes[$mes['Setting']['Language']]['PaymentMethodBox']), null, $mes['Test'], $mes['Cultures'], $mes['Packages'], $mes['CurrentOffers']);
            case 'patientRegisteration_edit':
                return new AppModel('option2', $mes[$mes['Setting']['Language']]['Error'], 'PatientRegisteration', $mes[$mes['Setting']['Language']]['Message']['PatientRegisterationEdit'],
                isset($mes['Receipt']) ? array_keys($mes['Receipt']) : array(),//var4
                $mes['Patent'],//var1
                isset($mes['Knows']) ? array_keys($mes['Knows']) : array(),//var2
                array_keys($mes[$mes['Setting']['Language']]['PaymentMethodBox']),//var3
                $mes['Test'],//var5
                $mes['Cultures'],//var6
                $mes['Packages'],//var7
                $mes['CurrentOffers']);//var8
            case 'patientRegisteration_delete':
                return new AppModel('delete', $mes[$mes['Setting']['Language']]['Error'], 'PatientRegisteration', $mes[$mes['Setting']['Language']]['Message']['PatientRegisterationDelete'], isset($mes['Receipt']) ? array_keys($mes['Receipt']) : array(), 'DeleteOption');
            

            case 'Patients':
                return new Patients($id);
            case 'patients_create':
                return new AppModel('option1', $mes[$mes['Setting']['Language']]['Error'], 'Patients', $mes[$mes['Setting']['Language']]['Message']['PatientsAdd'], array_keys($mes[$mes['Setting']['Language']]['SelectNationalityBox']), array_keys($mes[$mes['Setting']['Language']]['SelectGenderBox']), array_keys($mes[$mes['Setting']['Language']]['CheckBox']), isset($mes['Contracts']) ? array_keys($mes['Contracts']) : array(), new Patent($this->generateUniqueIdentifier(), request()->file('avatar') ? request()->file('avatar') : null, request()->input('patent-name'), request()->input('patent-nationality'), request()->input('patent-national-id'), request()->input('patent-passport-no'), request()->input('patent-email'), request()->input('patent-phone'), request()->input('patent-phone2'), request()->input('patent-gender'), request()->input('last-period-date'), request()->input('date-birth'), request()->input('patent-address'), request()->input('patent-contracting'), request()->input('patent-hours'), request()->input('patent-other') ? request()->input('patent-other'): request()->input('choices')));
            case 'patients_edit':
                return new AppModel('option2', $mes[$mes['Setting']['Language']]['Error'], 'Patients', $mes[$mes['Setting']['Language']]['Message']['PatientsEdit'], isset($mes['Patent']) ? array_keys($mes['Patent']) : array(), array_keys($mes[$mes['Setting']['Language']]['SelectNationalityBox']), array_keys($mes[$mes['Setting']['Language']]['SelectGenderBox']), array_keys($mes[$mes['Setting']['Language']]['CheckBox']), isset($mes['Contracts']) ? array_keys($mes['Contracts']) : array(), isset($mes['Patent'][(string)request()->input('id')]) ? new Patent($mes['Patent'][(string)request()->input('id')]['PatentCode'], request()->file('avatar') ? request()->file('avatar') : $mes['Patent'][(string)request()->input('id')]['Avatar'], request()->input('patent-name'), request()->input('patent-nationality'), request()->input('patent-national-id'), request()->input('patent-passport-no'), request()->input('patent-email'), request()->input('patent-phone'), request()->input('patent-phone2'), request()->input('patent-gender'), request()->input('last-period-date'), request()->input('date-birth'), request()->input('patent-address'), request()->input('patent-contracting'), request()->input('patent-hours'), request()->input('patent-other') ? request()->input('patent-other'): request()->input('choices')) : null);
            case 'patients_delete':
                return new AppModel('delete', $mes[$mes['Setting']['Language']]['Error'], 'Patients', $mes[$mes['Setting']['Language']]['Message']['PatientsDelete'], isset($mes['Patent']) ? array_keys($mes['Patent']) : array());

            case 'Knows':
                return new Knows($id);
            case 'knows_create':
                return new AppModel('option3', $mes[$mes['Setting']['Language']]['Error'], 'Knows', $mes[$mes['Setting']['Language']]['Message']['KnowsAdd']);
            case 'knows_edit':
                return new AppModel('option1', $mes[$mes['Setting']['Language']]['Error'], 'Knows', $mes[$mes['Setting']['Language']]['Message']['KnowsEdit'], isset($mes['Knows']) ? array_keys($mes['Knows']) : array());
            case 'knows_delete':
                return new AppModel('delete', $mes[$mes['Setting']['Language']]['Error'], 'Knows', $mes[$mes['Setting']['Language']]['Message']['KnowsDelete'], isset($mes['Knows']) ? array_keys($mes['Knows']) : array());
            default :
                return null;
        }
    }
    public function createPatent(){
        $lang = $this->initLanguage('patients_create', Rays::find(request()->session()->get('userId')));
        $this->getCreateDataBase('Patent', $lang->myPatient->validPatient([
            'avatar' => ['image', 'mimes:jpg,png', 'max:1024', 'dimensions:min_width=300,min_height=300'],
            'patent-name' => ['required', 'min:3'],
            'patent-nationality' => ['required', Rule::in($lang->nationalityKeys)],
            'patent-national-id' => ['required', 'min:3'],
            'patent-passport-no' => ['required', 'min:3'],
            'patent-email' => ['required', 'email'],
            'patent-phone' => ['required', 'regex:/^[0-9]{11}$/'],
            'patent-phone2' => ['required', 'regex:/^[0-9]{11}$/'],
            'patent-gender' => ['required', Rule::in($lang->genderKeys)],
            'last-period-date' => ['required', 'date'],
            'date-birth' => ['required', 'date'],
            'patent-address' => ['required', 'min:3'],
            'patent-contracting' => ['required', Rule::in($lang->arr1)],
            'patent-hours' => ['required', 'integer'],
            'choices' => ['required_without:patent-other', 'array'], // Ensure at least one checkbox is selected
            'choices.*'=>[Rule::in($lang->disKeys)],
            'patent-other'=>['required_without:choices', 'nullable', 'min:3'],
        ], [
            'patent-name.required'=>$lang->error1,
            'patent-name.min'=>$lang->error2,
            'patent-national-id.required'=>$lang->error3,
            'patent-national-id.min'=>$lang->error4,
            'patent-passport-no.required'=>$lang->error5,
            'patent-passport-no.min'=>$lang->error6,
            'patent-email.required'=>$lang->error7,
            'patent-email.email'=>$lang->error8,
            'patent-phone.required'=>$lang->error9,
            'patent-phone.regex'=>$lang->error10,
            'patent-phone2.required'=>$lang->error11,
            'patent-phone2.regex'=>$lang->error12,
            'patent-address.required'=>$lang->error13,
            'patent-address.min' => $lang->error14, 
            'patent-hours.required'=>$lang->error15,
            'patent-hours.integer' => $lang->error34,
            'avatar.dimensions' => $lang->PatentAvatarDimensions,
            'patent-nationality.required'=>$lang->error17,
            'patent-nationality.in'=>$lang->error33,
            'patent-gender.required'=>$lang->error18,
            'patent-gender.in'=>$lang->error24,
            'last-period-date.required'=>$lang->error19,
            'last-period-date.date' => $lang->error25,
            'date-birth.required'=>$lang->error20,
            'date-birth.date' => $lang->error26,
            'patent-contracting.required'=>$lang->error21,
            'patent-contracting.in' => $lang->error27, 
            
            'choices.array' =>$lang->error28,
            'choices.*.in' =>$lang->error28,
            'patent-other.min'=>$lang->error22,
            'avatar.image'=> $lang->error30,
            'avatar.mimes'=> $lang->error31,
            'avatar.max'=> $lang->error32,
            'choices.required_without'=>$lang->error16,
            'patent-other.required_without'=>$lang->error16,
        ]));
        return back()->with('success', $lang->successfully1);
    }
    public function editPatent(){
        $lang = $this->initLanguage('patients_edit', Rays::find(request()->session()->get('userId')));
        $rull = [
            'id' => ['required', Rule::in($lang->size1)],
            'avatar' => ['image', 'mimes:jpg,png', 'max:1024', 'dimensions:min_width=300,min_height=300'],
            'patent-name' => ['required', 'min:3'],
            'patent-nationality' => ['required', Rule::in($lang->nationalityKeys)],
            'patent-national-id' => ['required', 'min:3'],
            'patent-passport-no' => ['required', 'min:3'],
            'patent-email' => ['required', 'email'],
            'patent-phone' => ['required', 'regex:/^[0-9]{11}$/'],
            'patent-phone2' => ['required', 'regex:/^[0-9]{11}$/'],
            'patent-gender' => ['required', Rule::in($lang->genderKeys)],
            'last-period-date' => ['required', 'date'],
            'date-birth' => ['required', 'date'],
            'patent-address' => ['required', 'min:3'],
            'patent-contracting' => ['required', Rule::in($lang->arr1)],
            'patent-hours' => ['required', 'integer'],
            'choices' => ['required_without:patent-other', 'array'], // Ensure at least one checkbox is selected
            'choices.*'=>[Rule::in($lang->disKeys)],
            'patent-other'=>['required_without:choices', 'nullable', 'min:3'],
        ];
        $message = [
            'id.required' => $lang->error35,
            'id.in' => $lang->error36,
            'patent-name.required'=>$lang->error1,
            'patent-name.min'=>$lang->error2,
            'patent-national-id.required'=>$lang->error3,
            'patent-national-id.min'=>$lang->error4,
            'patent-passport-no.required'=>$lang->error5,
            'patent-passport-no.min'=>$lang->error6,
            'patent-email.required'=>$lang->error7,
            'patent-email.email'=>$lang->error8,
            'patent-phone.required'=>$lang->error9,
            'patent-phone.regex'=>$lang->error10,
            'patent-phone2.required'=>$lang->error11,
            'patent-phone2.regex'=>$lang->error12,
            'patent-address.required'=>$lang->error13,
            'patent-address.min' => $lang->error14, 
            'patent-hours.required'=>$lang->error15,
            'patent-hours.integer' => $lang->error34,
            'avatar.dimensions' => $lang->PatentAvatarDimensions,
            'patent-nationality.required'=>$lang->error17,
            'patent-nationality.in'=>$lang->error33,
            'patent-gender.required'=>$lang->error18,
            'patent-gender.in'=>$lang->error24,
            'last-period-date.required'=>$lang->error19,
            'last-period-date.date' => $lang->error25,
            'date-birth.required'=>$lang->error20,
            'date-birth.date' => $lang->error26,
            'patent-contracting.required'=>$lang->error21,
            'patent-contracting.in' => $lang->error27, 
            
            'choices.array' =>$lang->error28,
            'choices.*.in' =>$lang->error28,
            'patent-other.min'=>$lang->error22,
            'avatar.image'=> $lang->error30,
            'avatar.mimes'=> $lang->error31,
            'avatar.max'=> $lang->error32,
            'choices.required_without'=>$lang->error16,
            'patent-other.required_without'=>$lang->error16,
        ];
        if($lang->myPatient === null)
            request()->validate($rull, $message);
        $this->getEditDataBase('Patent', $lang->myPatient->validPatient($rull, $message));
        return back()->with('success', $lang->successfully1);
    }
    public function deletePatent(){
        $lang = $this->initLanguage('patients_delete', Rays::find(request()->session()->get('userId')));
        request()->validate([
            'id' => ['required', Rule::in($lang->size1)],
        ], [
            'id.required' => $lang->error35,
            'id.in' => $lang->error36,
        ]);
        $this->getDeleteDatabade('Patent');
        return back()->with('success', $lang->successfully1);
    }
}
