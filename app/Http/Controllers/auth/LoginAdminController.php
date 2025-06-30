<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\language\share\EmailPassInformaion;
use App\Models\Rays;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\Rule;

class LoginAdminController extends EmailPassInformaion
{
    public function __construct(){
        $ob = Rays::find(request()->route('id'))?Rays::find(request()->route('id')):(Rays::find(request()->input('id'))?Rays::find(request()->input('id')):Rays::first());
        $this->error1 = $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['LoginAdmin']['UserEmail'];
        $this->error2 = $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['LoginAdmin']['UserEmailRequired'];
        $this->error3 = $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['LoginAdmin']['UserPassword'];
        $this->error4 = $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['LoginAdmin']['UserPasswordRequired'];
        if(Route::currentRouteName() === 'loginUser.loginUser'){
            request()->validate([
                'email' => ['required', 'email'],
                'password' => ['required', 'min:8'],
            ], [
                'email.email' => $this->error1 ,
                'email.required' => $this->error2,
    
                'password.min' => $this->error3 ,
                'password.required' => $this->error4,
            ]);
            foreach ($ob['User'] as $key => $user)
                if($user['Email'] === request()->input('email') && $user['Password'] === request()->input('password')){
                    //save user session
                    request()->session()->put('userId', request()->input('id'));
                    //save user session logout
                    request()->session()->put('userLogout', request()->input('id'));
                    $this->successfully1 = $ob[$ob['Setting']['Language']]['LoginAdmin']['LoginMessage'];
                    return;
                }         
            // return error email exsist
            $this->errorMessage = $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['LoginAdmin']['UserPasswordDntMatch'];
        }else if(isset($ob[unserialize(request()->cookie($ob['_id']))])){
            parent::__construct(
            $this->error1, 
            $this->error2,
            $this->error3,
            $this->error4,
            $ob[unserialize(request()->cookie($ob['_id']))]['LoginAdmin']['LabelLoginUser'],
            $ob[unserialize(request()->cookie($ob['_id']))]['LoginAdmin']['LabelUserEmail'],
            $ob[unserialize(request()->cookie($ob['_id']))]['LoginAdmin']['LabelUserPassword'],
            $ob[unserialize(request()->cookie($ob['_id']))]['LoginAdmin']['HintUserEmail'],
            $ob[unserialize(request()->cookie($ob['_id']))]['LoginAdmin']['HintUserPassword'],
            $ob[unserialize(request()->cookie($ob['_id']))]['LoginAdmin']['LabelSettingLanguage'],
            $ob[unserialize(request()->cookie($ob['_id']))]['LoginAdmin']['ButtonLanguage'],
            $ob[unserialize(request()->cookie($ob['_id']))]['LoginAdmin']['ButtonSaveLanguage'],
            $ob[unserialize(request()->cookie($ob['_id']))]['LoginAdmin']['ButtonLoginUser'],
            $ob[unserialize(request()->cookie($ob['_id']))]['AllNamesLanguage'],
            $ob['_id'],
            unserialize(request()->cookie($ob['_id'])), 
            $ob[unserialize(request()->cookie($ob['_id']))]['LoginAdmin']['Title'], 
            $ob[unserialize(request()->cookie($ob['_id']))]['Html']['Direction']);
        }else{
            Cookie::queue($ob['_id'], serialize($ob['Setting']['Language']),2628000);
            parent::__construct(
            $this->error1,
            $this->error2,
            $this->error3,
            $this->error4,
            $ob[$ob['Setting']['Language']]['LoginAdmin']['LabelLoginUser'],
            $ob[$ob['Setting']['Language']]['LoginAdmin']['LabelUserEmail'],
            $ob[$ob['Setting']['Language']]['LoginAdmin']['LabelUserPassword'],
            $ob[$ob['Setting']['Language']]['LoginAdmin']['HintUserEmail'],
            $ob[$ob['Setting']['Language']]['LoginAdmin']['HintUserPassword'],
            $ob[$ob['Setting']['Language']]['LoginAdmin']['LabelSettingLanguage'],
            $ob[$ob['Setting']['Language']]['LoginAdmin']['ButtonLanguage'],
            $ob[$ob['Setting']['Language']]['LoginAdmin']['ButtonSaveLanguage'],
            $ob[$ob['Setting']['Language']]['LoginAdmin']['ButtonLoginUser'],
            $ob[$ob['Setting']['Language']]['AllNamesLanguage'],
            $ob['_id'],
            $ob['Setting']['Language'],
            $ob[$ob['Setting']['Language']]['LoginAdmin']['Title'], 
            $ob[$ob['Setting']['Language']]['Html']['Direction']);
        }
    }
    public function index(){
        return view('login.user',[
            'lang'=>$this
        ]);
    }
    public function action(){
        return isset($this->successfully1)?redirect()->route('Home')->with('success', $this->successfully1):back()->withInput()->withErrors($this->errorMessage);
    }
}
