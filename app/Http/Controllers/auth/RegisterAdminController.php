<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\language\share\EmailPassInformaion;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\Rule;
use App\Http\interface\LangObject;

class RegisterAdminController extends EmailPassInformaion implements LangObject
{   
    public function __construct(){
        parent::__construct('Register');
        $this->UserRepeatPassword = $this->ob[isset($this->ob[unserialize(request()->cookie($this->ob['_id']))]) ? unserialize(request()->cookie($this->ob['_id'])) : $this->ob['Setting']['Language']]['Register']['UserRepeatPassword'];
        $this->UserRepeatPasswordRequired = $this->ob[isset($this->ob[unserialize(request()->cookie($this->ob['_id']))]) ? unserialize(request()->cookie($this->ob['_id'])) : $this->ob['Setting']['Language']]['Register']['UserRepeatPasswordRequired'];
        $this->error7 = $this->ob[isset($this->ob[unserialize(request()->cookie($this->ob['_id']))]) ? unserialize(request()->cookie($this->ob['_id'])) : $this->ob['Setting']['Language']]['Register']['UserPasswordDntMatch'];
        $this->error8 = $this->ob[isset($this->ob[unserialize(request()->cookie($this->ob['_id']))]) ? unserialize(request()->cookie($this->ob['_id'])) : $this->ob['Setting']['Language']]['Register']['UserCodePasswordRequired'];
        $this->error9 = $this->ob[isset($this->ob[unserialize(request()->cookie($this->ob['_id']))]) ? unserialize(request()->cookie($this->ob['_id'])) : $this->ob['Setting']['Language']]['Register']['UserCodePassword'];
        if(Route::currentRouteName() === 'register.registerUser'){
            array_push($this->roll['email'], Rule::notIn(array_values(array_map(function($users) {return $users['Email'];}, $this->users))));
            array_push($this->roll['password'], 'confirmed');
            $this->roll['password_confirmation'] = ['required', 'min:8'];
            $this->roll['codePassword'] = ['required', 'min:8'];
            $this->message['email.not_in'] = $this->ob[isset($this->ob[unserialize(request()->cookie($this->ob['_id']))]) ? unserialize(request()->cookie($this->ob['_id'])) : $this->ob['Setting']['Language']]['Register']['UserEmailExist'];
            $this->message['password_confirmation.min'] = $this->UserRepeatPassword;
            $this->message['password_confirmation.required'] = $this->UserRepeatPasswordRequired;
            $this->message['codePassword.min'] = $this->error9;
            $this->message['codePassword.required'] = $this->error8;
            $this->message['password.confirmed']= $this->error7;   
        }else{
            $this->labelUserRepeatPassword = $this->ob[$this->language]['Register']['LabelUserRepeatPassword'];
            $this->labelUserCodePassword = $this->ob[$this->language]['Register']['LabelUserCodePassword'];
            $this->hintUserRepeatPassword = $this->ob[$this->language]['Register']['HintUserRepeatPassword'];
            $this->hintUserCodePassword = $this->ob[$this->language]['Register']['HintUserCodePassword'];
        }
    }
    public function index(){
        return view('login.register',[
            'lang'=>$this
        ]);
    }
    public function makeRegister(){
        $this->getCreateDataBase($this->ob, 'User', $this->generateUniqueIdentifier(), $this);     
        request()->session()->put('userId', request()->input('id'));
        request()->session()->put('userLogout', request()->input('id'));
        return redirect()->route('Home')->with('success',  $this->ob[isset($this->ob[unserialize(request()->cookie($this->ob['_id']))]) ? unserialize(request()->cookie($this->ob['_id'])) : $this->ob['Setting']['Language']]['Register']['AdminLogin']);
    }
    public function getMyObject($id = null){
        request()->validate($this->roll,$this->message);       
        return array('Key'=>request()->input('codePassword'), 'Password'=>request()->input('password'), 'Email'=>request()->input('email'));
    }
}

