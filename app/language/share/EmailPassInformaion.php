<?php
namespace App\language\share;
use App\MyLanguage;
use Illuminate\Support\Facades\Route;
use App\Models\Rays;
use Illuminate\Support\Facades\Cookie;
class EmailPassInformaion extends InitPage{
    protected function __construct($state){
        $this->ob = Rays::find(request()->route('id'))?Rays::find(request()->route('id')):(Rays::find(request()->input('id'))?Rays::find(request()->input('id')):Rays::first());
        $this->errorUserEmail = $this->ob[isset($this->ob[unserialize(request()->cookie($this->ob['_id']))]) ? unserialize(request()->cookie($this->ob['_id'])) : $this->ob['Setting']['Language']][$state]['UserEmail'];
        $this->errorUserEmailRequired = $this->ob[isset($this->ob[unserialize(request()->cookie($this->ob['_id']))]) ? unserialize(request()->cookie($this->ob['_id'])) : $this->ob['Setting']['Language']][$state]['UserEmailRequired'];
        $this->errorUserPassword = $this->ob[isset($this->ob[unserialize(request()->cookie($this->ob['_id']))]) ? unserialize(request()->cookie($this->ob['_id'])) : $this->ob['Setting']['Language']][$state]['UserPassword'];
        $this->errorUserPasswordRequired = $this->ob[isset($this->ob[unserialize(request()->cookie($this->ob['_id']))]) ? unserialize(request()->cookie($this->ob['_id'])) : $this->ob['Setting']['Language']][$state]['UserPasswordRequired'];
        if(Route::currentRouteName() === 'loginUser.loginUser' || Route::currentRouteName() === 'register.registerUser'){
            parent::__construct(isset($this->ob[unserialize(request()->cookie($this->ob['_id']))]) ? unserialize(request()->cookie($this->ob['_id'])) : $this->ob['Setting']['Language']);
            $this->roll = [
                'email' => ['required', 'email'],
                'password' => ['required', 'min:8'],
            ];
            $this->message = [
                'email.email' => $this->errorUserEmail ,
                'email.required' => $this->errorUserEmailRequired,
    
                'password.min' => $this->errorUserPassword ,
                'password.required' => $this->errorUserPasswordRequired,
            ];
            $this->users = $this->ob['User'] ? $this->ob['User'] : array();
        }else if(isset($this->ob[unserialize(request()->cookie($this->ob['_id']))])){
            parent::__construct(unserialize(request()->cookie($this->ob['_id'])),
            $this->ob[unserialize(request()->cookie($this->ob['_id']))][$state]['Title'],
            $this->ob[unserialize(request()->cookie($this->ob['_id']))]['Html']['Direction']);
            
            $this->button1 = $this->ob[$this->language][$state]['ButtonLanguage'];
            $this->button2 = $this->ob[$this->language][$state]['ButtonSaveLanguage'];
            $this->button3 = $this->ob[$this->language][$state]['ButtonLoginUser'];
            $this->label4 = $this->ob[$this->language][$state]['LabelSettingLanguage'];
            $this->myRadios = array();
            foreach ($this->ob[$this->language]['AllNamesLanguage'] as $key => $value)
                $this->myRadios[$key] = new MyLanguage($value);
            $this->RaysId = $this->ob['_id'];
            $this->label1 = $this->ob[$this->language][$state]['LabelUserEmail'];
            $this->label2 = $this->ob[$this->language][$state]['LabelUserPassword'];
            $this->hint1 = $this->ob[$this->language][$state]['HintUserEmail'];
            $this->hint2 = $this->ob[$this->language][$state]['HintUserPassword'];
            $this->help = $this->ob[$this->language][$state]['LabelLoginUser'];
        }else{
            Cookie::queue($this->ob['_id'], serialize($this->ob['Setting']['Language']),2628000);
            parent::__construct($this->ob['Setting']['Language'],
            $this->ob[$this->ob['Setting']['Language']][$state]['Title'],
            $this->ob[$this->ob['Setting']['Language']]['Html']['Direction']);
            $this->button1 = $this->ob[$this->ob['Setting']['Language']][$state]['ButtonLanguage'];
            $this->button2 = $this->ob[$this->ob['Setting']['Language']][$state]['ButtonSaveLanguage'];
            $this->button3 = $this->ob[$this->ob['Setting']['Language']][$state]['ButtonLoginUser'];
            $this->label4 = $this->ob[$this->ob['Setting']['Language']][$state]['LabelSettingLanguage'];
            $this->myRadios = array();
            foreach ($this->ob[$this->ob['Setting']['Language']]['AllNamesLanguage'] as $key => $value)
                $this->myRadios[$key] = new MyLanguage($value);
            $this->RaysId = $this->ob['_id'];
            $this->label1 = $this->ob[$this->ob['Setting']['Language']][$state]['LabelUserEmail'];
            $this->label2 = $this->ob[$this->ob['Setting']['Language']][$state]['LabelUserPassword'];
            $this->hint1 = $this->ob[$this->ob['Setting']['Language']][$state]['HintUserEmail'];
            $this->hint2 = $this->ob[$this->ob['Setting']['Language']][$state]['HintUserPassword'];
            $this->help = $this->ob[$this->ob['Setting']['Language']][$state]['LabelLoginUser'];
        }  
    }
}