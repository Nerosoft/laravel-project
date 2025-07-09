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
    public $ob;
    public function __construct(){
        $ob = Rays::find(request()->route('id'))?Rays::find(request()->route('id')):(Rays::find(request()->input('id'))?Rays::find(request()->input('id')):Rays::first());
        $this->UserRepeatPassword = $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['Register']['UserRepeatPassword'];
        $this->UserRepeatPasswordRequired = $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['Register']['UserRepeatPasswordRequired'];
        $this->error7 = $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['Register']['UserPasswordDntMatch'];
        $this->error8 = $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['Register']['UserCodePasswordRequired'];
        $this->error9 = $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['Register']['UserCodePassword'];
        if(Route::currentRouteName() === 'register.registerUser'){
            parent::__construct(
                $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['Register']['UserEmail'],
                $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['Register']['UserEmailRequired'],
                $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['Register']['UserPassword'],
                $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['Register']['UserPasswordRequired'],
            );
            request()->validate([
                'email' => ['required', 'email', Rule::notIn(array_values(array_map(function($users) {return $users['Email'];}, $ob['User'])))],
                'password' => ['required', 'confirmed', 'min:8'],
                'password_confirmation' => ['required', 'min:8'],
                'codePassword' => ['required', 'min:8'],
            ], [
                'email.email' => $this->errorUserEmail ,
                'email.not_in' => $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['Register']['UserEmailExist'] ,
                'email.required' => $this->errorUserEmailRequired,

                'password.min' => $this->errorUserPassword ,
                'password.required' => $this->errorUserPasswordRequired,

                'password_confirmation.min' => $this->UserRepeatPassword ,
                'password_confirmation.required' => $this->UserRepeatPasswordRequired,

                'codePassword.min' => $this->error9,
                'codePassword.required' => $this->error8,
                'password.confirmed'=>$this->error7
            ]);       
            $this->getCreateDataBase($ob, 'User', $this->generateUniqueIdentifier(), $this);     
            request()->session()->put('userId', request()->input('id'));
            request()->session()->put('userLogout', request()->input('id'));
            $this->successfully1 = $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['Register']['AdminLogin'];  
            return;     
        }else if(isset($ob[unserialize(request()->cookie($ob['_id']))])){
            parent::__construct(
            $ob[unserialize(request()->cookie($ob['_id']))]['Register']['UserEmail'],
            $ob[unserialize(request()->cookie($ob['_id']))]['Register']['UserEmailRequired'],
            $ob[unserialize(request()->cookie($ob['_id']))]['Register']['UserPassword'],
            $ob[unserialize(request()->cookie($ob['_id']))]['Register']['UserPasswordRequired'],
            $ob[unserialize(request()->cookie($ob['_id']))]['Register']['LabelRegisterUser'],
            $ob[unserialize(request()->cookie($ob['_id']))]['Register']['LabelUserEmail'],
            $ob[unserialize(request()->cookie($ob['_id']))]['Register']['LabelUserPassword'],
            $ob[unserialize(request()->cookie($ob['_id']))]['Register']['HintUserEmail'],
            $ob[unserialize(request()->cookie($ob['_id']))]['Register']['HintUserPassword'],
            $ob[unserialize(request()->cookie($ob['_id']))]['Register']['LabelSettingLanguage'],
            $ob[unserialize(request()->cookie($ob['_id']))]['Register']['ButtonLanguage'],
            $ob[unserialize(request()->cookie($ob['_id']))]['Register']['ButtonSaveLanguage'],
            $ob[unserialize(request()->cookie($ob['_id']))]['Register']['ButtonUserRegister'],
            $ob[unserialize(request()->cookie($ob['_id']))]['AllNamesLanguage'],
            $ob['_id'],
            unserialize(request()->cookie($ob['_id'])),
            $ob[unserialize(request()->cookie($ob['_id']))]['Register']['Title'],
            $ob[unserialize(request()->cookie($ob['_id']))]['Html']['Direction']);
        }else{
            Cookie::queue($ob['_id'], serialize($ob['Setting']['Language']),2628000);
            parent::__construct(
            $ob[$ob['Setting']['Language']]['Register']['UserEmail'],
            $ob[$ob['Setting']['Language']]['Register']['UserEmailRequired'],
            $ob[$ob['Setting']['Language']]['Register']['UserPassword'],
            $ob[$ob['Setting']['Language']]['Register']['UserPasswordRequired'],
            $ob[$ob['Setting']['Language']]['Register']['LabelRegisterUser'],
            $ob[$ob['Setting']['Language']]['Register']['LabelUserEmail'],
            $ob[$ob['Setting']['Language']]['Register']['LabelUserPassword'],
            $ob[$ob['Setting']['Language']]['Register']['HintUserEmail'],
            $ob[$ob['Setting']['Language']]['Register']['HintUserPassword'],
            $ob[$ob['Setting']['Language']]['Register']['LabelSettingLanguage'],
            $ob[$ob['Setting']['Language']]['Register']['ButtonLanguage'],
            $ob[$ob['Setting']['Language']]['Register']['ButtonSaveLanguage'],
            $ob[$ob['Setting']['Language']]['Register']['ButtonUserRegister'],
            $ob[$ob['Setting']['Language']]['AllNamesLanguage'],
            $ob['_id'],
            $ob['Setting']['Language'],
            $ob[$ob['Setting']['Language']]['Register']['Title'],
            $ob[$ob['Setting']['Language']]['Html']['Direction']); 
        }
        $this->labelUserRepeatPassword = $ob[$this->language]['Register']['LabelUserRepeatPassword'];
        $this->labelUserCodePassword = $ob[$this->language]['Register']['LabelUserCodePassword'];
        $this->hintUserRepeatPassword = $ob[$this->language]['Register']['HintUserRepeatPassword'];
        $this->hintUserCodePassword = $ob[$this->language]['Register']['HintUserCodePassword'];
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

