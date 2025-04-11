<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use App\Models\Rays;
use App\language\admin\action\auth\login\MyLoginAdmin;
use App\language\admin\action\auth\login\MyLoginPatient;
use App\language\admin\action\auth\login\MyLoginDoctor;
use App\language\admin\action\auth\MyLoginRegisterAdmin;
use App\language\admin\action\auth\ChangeLanguage;
use App\language\admin\action\auth\ShowError;
use App\language\login\RegisterAdmin;
use App\language\login\LoginAdmin;
use App\language\login\LoginPatent;
use App\language\login\LoginDoctor;
use Illuminate\Validation\Rule;
class UserController extends Controller
{
    public function makeResponse($page, $lang){
        return request()->cookie($lang->RaysId) ? (new Response(view($page,[
            'lang'=>$lang,
            'myRadios'=>$this->setupRadios($lang->myLanguage),
            'userLanguage'=> unserialize(request()->cookie($lang->RaysId))
            ]))) :
            (new Response(view($page,[
                'lang'=>$lang,
                'myRadios'=>$this->setupRadios($lang->myLanguage),
                'userLanguage'=>$lang->language
                ])))
            ->withCookie(cookie()->forever($lang->RaysId, serialize($lang->language)));      
    }
    public function doctor($myRays = null){
        return Rays::first()!== null ? $this->makeResponse('login.doctor', $this->setupLanguage('doctor', $myRays !== null ? $this->findUser($myRays) : Rays::first())) : 'empty database';
    }
    public function patent($myRays = null){
        return Rays::first()!== null ? $this->makeResponse('login.login_patient',  $this->setupLanguage('patent', $myRays !== null ? $this->findUser($myRays) : Rays::first())) : 'empty database';
    }
    public function index($myRays = null){
        return Rays::first()!== null ? $this->makeResponse('user',  $this->setupLanguage('register', $myRays !== null ? $this->findUser($myRays) : Rays::first())) : 'empty database';
    }
    public function login($myRays = null){
        return Rays::first()!== null ? $this->makeResponse('login.user', $this->setupLanguage('login', $myRays !== null ? $this->findUser($myRays) : Rays::first())) : 'empty database';
    }
    public function findUser(string $raysId){
        return Rays::find($raysId) ? Rays::find($raysId): Rays::first();
    }
    public function registerUser(Request $request){
        if(Rays::find($request->input('userId'))){
            $lang = $this->setupLanguage('register_init2', Rays::find(request()->input('userId')), 'register');
            $rules = [
                'email' => ['required', 'email'],
                'password' => ['required', 'confirmed', 'min:8'],
                'password_confirmation' => ['required', 'min:8'],
                'codePassword' => ['required', 'min:8'],
            ];        
            $messages = [
                'email.email' => $lang->error2 ,
                'email.required' => $lang->error3,

                'password.min' => $lang->error5 ,
                'password.required' => $lang->error6,

                'password_confirmation.min' => $lang->error1 ,
                'password_confirmation.required' => $lang->error4,

                'codePassword.min' => $lang->error9,
                'codePassword.required' => $lang->error8,
                'password.confirmed'=>$lang->error7
            ];
            $request->validate($rules, $messages);
            foreach ($lang->User as $key => $user) 
                if($user->getEmail() === $request->input('email'))
                    // return error email exsist
                    return back()->withInput()->withErrors($lang->error10);
            $this->getCreateDataBase('User', [
            'Key'=>$request->input('codePassword'),
            'Password'=>$request->input('password'),
            'Email'=>$request->input('email')]);     
            
           
            $request->session()->put('userId', $request->input('userId'));
            //save user session logout
            $request->session()->put('userLogout', $request->input('userId'));
            // go to register home page
            return redirect()->route('Home');
        }
        else
            // redirect to route register and setup cookie 
            return back()->withInput()->withErrors($this->setupLanguage('id_not_found1', Rays::first())->error1);
    }
    public function loginUser(Request $request){
        if(Rays::find($request->input('userId'))){
            $lang = $this->setupLanguage('login_admin_init2', Rays::find(request()->input('userId')), 'login');
            $rules = [
                'email' => ['required', 'email'],
                'password' => ['required', 'min:8'],
            ];        
            $messages = [
                'email.email' => $lang->error1 ,
                'email.required' => $lang->error2,
    
                'password.min' => $lang->error3 ,
                'password.required' => $lang->error4,
            ];
            $request->validate($rules, $messages);
            foreach ($lang->User as $key => $user)
                if($user->getEmail() === $request->input('email') && $user->getPassword() === $request->input('password')){
                    //save user session
                    $request->session()->put('userId', $request->input('userId'));
                    //save user session logout
                    $request->session()->put('userLogout', $request->input('userId'));
                    return redirect()->route('Home');
                }         
            // return error email exsist
            return back()->withInput()->withErrors($lang->error5);  
        }else
           // redirect to route login and setup cookie 
           return back()->withInput()->withErrors($this->setupLanguage('id_not_found2', Rays::first())->error1);
    }
    public function loginPatent(Request $request){
        if(Rays::find($request->input('userId'))){
            $lang = $this->setupLanguage('language_patent_init2', Rays::find(request()->input('userId')));
            //check form is valid
            $rules = [
                'PatientCode' => ['required', 'min:3'],
            ];        
            $messages = [
                'PatientCode.min' => $lang->error1 ,
                'PatientCode.required' => $lang->error2,
            ];
            $validation = $request->validate($rules, $messages);
            $arr = array(array('code'=>'12345'));
            foreach ($arr as $key => $value)
                if($value['code'] === $request->input('PatientCode')){
                    //save user session
                    $request->session()->put('patentId', $request->input('userId'));
                    //save user session logout
                    $request->session()->put('patentLogout', $request->input('userId'));
                    return redirect()->route('PatentDashboard');
                }
            // return error if rong patent
            return back()->withInput()->withErrors($lang->error3);  
        }else
            // redirect to route patent and setup cookie and set error
            return back()->withInput()->withErrors($this->setupLanguage('id_not_found3', Rays::first())->error1); 
    }
    public function loginDoctor(Request $request){
        if(Rays::find($request->input('userId'))){
            $lang = $this->setupLanguage('language_doctor_init2', Rays::find(request()->input('userId')));
            $rules = [
                'email' => ['required', 'email'],
                'password' => ['required', 'min:8'],
            ];        
            $messages = [
                'email.email' => $lang->error1 ,
                'email.required' => $lang->error2,
    
                'password.min' => $lang->error3 ,
                'password.required' => $lang->error4,
            ];
            $request->validate($rules, $messages);
            $arr = array(array('Email'=>'nero@rays.com', 'Password'=>'12345678'));
            foreach ($arr as $key => $value)
                if($value['Email'] === $request->input('email') && $value['Password'] === $request->input('password')){
                    //save user session
                    $request->session()->put('doctorId', $request->input('userId'));
                    //save user session logout
                    $request->session()->put('doctorLogout', $request->input('userId'));
                    return redirect()->route('DoctorDashboard');
                }           
            // return error email exsist
            return back()->withInput()->withErrors($lang->error5);  
        }else
            // redirect to route doctor and setup cookie and set error
            return back()->withInput()->withErrors($this->setupLanguage('id_not_found4', Rays::first())->error1);  
    }
    //post
    private function getLanguage2($userRays){
        if(request()->cookie(request()->input('userId'))) 
            if(isset($userRays[unserialize(request()->cookie(request()->input('userId')))]))
                return unserialize(request()->cookie(request()->input('userId')));
            else{
                //use language system if admin delete language and save the language in cookie
                Cookie::queue($userRays->_id, serialize($userRays['Setting']['Language']),2628000);
                return $userRays['Setting']['Language'];
            }
        else
            return $userRays['Setting']['Language'];

        
    }
    //page
    private function getLanguage1($userRays){
        if(request()->cookie($userRays->_id)) 
            if(isset($userRays[unserialize(request()->cookie($userRays->_id))]))
                return unserialize(request()->cookie($userRays->_id));
            else{
                //use language system if admin delete language and save the language in cookie
                Cookie::queue($userRays->_id, serialize($userRays['Setting']['Language']),2628000);
                return $userRays['Setting']['Language'];
            }
        else
            return $userRays['Setting']['Language'];

        
    }
    function setupLanguage($id, $userRays, $state = null){
        switch ($id) {
              //post change language
            case 'register_admin'://register admin  
            case 'login_admin'://login admin
            case 'language_patent'://login patient
            case 'language_doctor'://login doctor
                return new ChangeLanguage(array_keys($userRays[$this->getLanguage2($userRays)]['AllNamesLanguage']), $userRays[$this->getLanguage2($userRays)]['Error']['LoginPatentLanguageRequired']);
            case 'login_admin_init2'://post
            case 'register_init2'://post register
                return new MyLoginRegisterAdmin($userRays[$this->getLanguage2($userRays)]['Error'], $state, isset($userRays['User'])?$userRays['User']:null);
            case 'register'://page register admin
                return new RegisterAdmin($userRays, $id, $this->getLanguage1($userRays));
            case 'id_not_found1':
                return new ShowError($userRays[$userRays['Setting']['Language']]['Error']['Language']);
            case 'login':
                return new LoginAdmin($userRays, $id, $this->getLanguage1($userRays));
            case 'id_not_found2':
                return new ShowError($userRays[$userRays['Setting']['Language']]['Error']['AuthLoginAdmin']);
            case 'language_patent_init2'://post
                return new MyLoginPatient($userRays[$this->getLanguage2($userRays)]['Error'], 'patent');
            case 'patent'://page patent
                return new LoginPatent($userRays, $id, $this->getLanguage1($userRays));
            case 'id_not_found3':
                return new ShowError($userRays[$userRays['Setting']['Language']]['Error']['AuthLoginPatent']);
            case 'language_doctor_init2'://post
                return new MyLoginDoctor($userRays[$this->getLanguage2($userRays)]['Error'], 'doctor');
            case 'doctor'://page doctor
                return new LoginDoctor($userRays, $id, $this->getLanguage1($userRays));        
            case 'id_not_found4':
                return new ShowError($userRays[$userRays['Setting']['Language']]['Error']['AuthLoginDoctor']);
            
        }
    }
    public function changeLanguage(Request $request, $id){

        if(Rays::find($request->input('userId')) && $id === 'register_admin' || Rays::find($request->input('userId')) && $id === 'login_admin' || Rays::find($request->input('userId')) && $id === 'language_patent' || Rays::find($request->input('userId')) && $id === 'language_doctor'){
            $lang = $this->setupLanguage($id, Rays::find($request->input('userId')));
            $rules = ['mylanguage' => ['required', Rule::in($lang->size1)]];        
            $messages = ['mylanguage.required' => $lang->error1, 
            'mylanguage.required' =>$lang->error1];// fix id jqery
            $validation = $request->validate($rules, $messages);
            //save cookie
            Cookie::queue($request->input('userId'), serialize($request->input('mylanguage')),2628000);
            // save language and go to register page
            return back();
        }else if($id === 'register_admin')
            return back()->withInput()->withErrors($this->setupLanguage('id_not_found1', Rays::first())->error1);
        else if($id === 'login_admin')
            return back()->withInput()->withErrors($this->setupLanguage('id_not_found2', Rays::first())->error1);
        else if($id === 'language_patent')
            return back()->withInput()->withErrors($this->setupLanguage('id_not_found3', Rays::first())->error1);
        else //if($id === 'language_doctor')
            return back()->withInput()->withErrors($this->setupLanguage('id_not_found4', Rays::first())->error1);
    }
}
