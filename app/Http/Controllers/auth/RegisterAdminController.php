<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\language\share\EmailPassInformaion;
use App\Models\Rays;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\Rule;
use App\Http\interface\LangObject;

class RegisterAdminController extends EmailPassInformaion implements LangObject
{   
    public function __construct(){
        $ob = Rays::find(request()->route('id'))?Rays::find(request()->route('id')):(Rays::find(request()->input('id'))?Rays::find(request()->input('id')):Rays::first());
        $this->error2 = $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['Error']['UserEmail'];
        $this->error3 = $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['Error']['UserEmailRequired'];
        $this->error5 = $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['Error']['UserPassword'];//len
        $this->error6 = $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['Error']['UserPasswordRequired'];
        $this->UserRepeatPassword = $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['Error']['UserRepeatPassword'];
        $this->UserRepeatPasswordRequired = $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['Error']['UserRepeatPasswordRequired'];
        $this->error7 = $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['Error']['UserPasswordDntMatch'];
        $this->error8 = $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['Error']['UserCodePasswordRequired'];
        $this->error9 = $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['Error']['UserCodePassword'];
        if(Route::currentRouteName() === 'register.registerUser'){
            request()->validate([
                'email' => ['required', 'email', Rule::notIn(array_values(array_map(function($users) {return $users['Email'];}, $ob['User'])))],
                'password' => ['required', 'confirmed', 'min:8'],
                'password_confirmation' => ['required', 'min:8'],
                'codePassword' => ['required', 'min:8'],
            ], [
                'email.email' => $this->error2 ,
                'email.not_in' => $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['Error']['UserEmailExist'] ,
                'email.required' => $this->error3,

                'password.min' => $this->error5 ,
                'password.required' => $this->error6,

                'password_confirmation.min' => $this->UserRepeatPassword ,
                'password_confirmation.required' => $this->UserRepeatPasswordRequired,

                'codePassword.min' => $this->error9,
                'codePassword.required' => $this->error8,
                'password.confirmed'=>$this->error7
            ]);       
            $this->getCreateDataBase($ob, 'User', $this->generateUniqueIdentifier(), $this);     
            request()->session()->put('userId', request()->input('id'));
            request()->session()->put('userLogout', request()->input('id'));
            $this->successfully1 = $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['Message']['AdminLogin'];       
        }else if(isset($ob[unserialize(request()->cookie($ob['_id']))])){
            parent::__construct(
            $this->error2, 
            $this->error3,
            $this->error5,
            $this->error6,
            $ob[unserialize(request()->cookie($ob['_id']))]['Label']['RegisterUser'],
            $ob[unserialize(request()->cookie($ob['_id']))]['Label']['UserEmail'],
            $ob[unserialize(request()->cookie($ob['_id']))]['Label']['UserPassword'],
            $ob[unserialize(request()->cookie($ob['_id']))]['Hint']['UserEmail'],
            $ob[unserialize(request()->cookie($ob['_id']))]['Hint']['UserPassword'],
            $ob[unserialize(request()->cookie($ob['_id']))]['Label']['SettingLanguage'],
            $ob[unserialize(request()->cookie($ob['_id']))]['Button']['Language'],
            $ob[unserialize(request()->cookie($ob['_id']))]['Button']['SaveLanguage'],
            $ob[unserialize(request()->cookie($ob['_id']))]['Button']['UserRegister'],
            $ob[unserialize(request()->cookie($ob['_id']))]['AllNamesLanguage'],
            $ob['_id'],
            unserialize(request()->cookie($ob['_id'])),
            $ob[unserialize(request()->cookie($ob['_id']))]['Title']['RegisterUser'],
            $ob[unserialize(request()->cookie($ob['_id']))]['Html']['Direction']);
            $this->labelUserRepeatPassword = $ob[$this->language]['Label']['UserRepeatPassword'];
            $this->labelUserCodePassword = $ob[$this->language]['Label']['UserCodePassword'];
            $this->hintUserRepeatPassword = $ob[$this->language]['Hint']['UserRepeatPassword'];
            $this->hintUserCodePassword = $ob[$this->language]['Hint']['UserCodePassword'];
        }else{
            Cookie::queue($ob['_id'], serialize($ob['Setting']['Language']),2628000);
            parent::__construct(
            $this->error2, 
            $this->error3,
            $this->error5,
            $this->error6,
            $ob[$ob['Setting']['Language']]['Label']['RegisterUser'],
            $ob[$ob['Setting']['Language']]['Label']['UserEmail'],
            $ob[$ob['Setting']['Language']]['Label']['UserPassword'],
            $ob[$ob['Setting']['Language']]['Hint']['UserEmail'],
            $ob[$ob['Setting']['Language']]['Hint']['UserPassword'],
            $ob[$ob['Setting']['Language']]['Label']['SettingLanguage'],
            $ob[$ob['Setting']['Language']]['Button']['Language'],
            $ob[$ob['Setting']['Language']]['Button']['SaveLanguage'],
            $ob[$ob['Setting']['Language']]['Button']['UserRegister'],
            $ob[$ob['Setting']['Language']]['AllNamesLanguage'],
            $ob['_id'],
            $ob['Setting']['Language'],
            $ob[$ob['Setting']['Language']]['Title']['RegisterUser'],
            $ob[$ob['Setting']['Language']]['Html']['Direction']);
            $this->labelUserRepeatPassword = $ob[$this->language]['Label']['UserRepeatPassword'];
            $this->labelUserCodePassword = $ob[$this->language]['Label']['UserCodePassword'];
            $this->hintUserRepeatPassword = $ob[$this->language]['Hint']['UserRepeatPassword'];
            $this->hintUserCodePassword = $ob[$this->language]['Hint']['UserCodePassword'];
        }
    }
    public function index(){
        return view('login.register',[
            'lang'=>$this
        ]);
    }
    public function action(){
        return redirect()->route('Home')->with('success', $this->successfully1); 
    }
    public function getMyObject(){
        return array('Key'=>request()->input('codePassword'), 'Password'=>request()->input('password'), 'Email'=>request()->input('email'));
    }
}

