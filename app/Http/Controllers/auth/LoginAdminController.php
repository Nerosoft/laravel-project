<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\language\share\EmailPassInformaion;
use App\Models\Rays;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\Rule;

class LoginAdminController extends EmailPassInformaion
{
    public function __construct(){
        $ob = Rays::find(request()->route('id'))?Rays::find(request()->route('id')):(Rays::find(request()->input('userId'))?Rays::find(request()->input('userId')):Rays::first());
        $this->error1 = $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['Error']['UserEmail'];
        $this->error2 = $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['Error']['UserEmailRequired'];
        $this->error3 = $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['Error']['UserPassword'];
        $this->error4 = $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['Error']['UserPasswordRequired'];
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
                    request()->session()->put('userId', request()->input('userId'));
                    //save user session logout
                    request()->session()->put('userLogout', request()->input('userId'));
                    $this->successfully1 = $ob[$ob['Setting']['Language']]['Message']['AdminLogin'];
                }         
            // return error email exsist
            $this->errorMessage = $ob[isset($ob[unserialize(request()->cookie($ob['_id']))]) ? unserialize(request()->cookie($ob['_id'])) : $ob['Setting']['Language']]['Error']['UserPasswordDntMatch'];
        }else if(isset($ob[unserialize(request()->cookie($ob['_id']))])){
            parent::__construct(
            $this->error1, 
            $this->error2,
            $this->error3,
            $this->error4,
            $ob[unserialize(request()->cookie($ob['_id']))]['Label']['LoginUser'],
            $ob[unserialize(request()->cookie($ob['_id']))]['Label']['UserEmail'],
            $ob[unserialize(request()->cookie($ob['_id']))]['Label']['UserPassword'],
            $ob[unserialize(request()->cookie($ob['_id']))]['Hint']['UserEmail'],
            $ob[unserialize(request()->cookie($ob['_id']))]['Hint']['UserPassword'],
            $ob[unserialize(request()->cookie($ob['_id']))]['Label']['SettingLanguage'],
            $ob[unserialize(request()->cookie($ob['_id']))]['Button']['Language'],
            $ob[unserialize(request()->cookie($ob['_id']))]['Button']['SaveLanguage'],
            $ob[unserialize(request()->cookie($ob['_id']))]['Button']['LoginUser'],
            $ob[unserialize(request()->cookie($ob['_id']))]['AllNamesLanguage'],
            $ob['_id'],
            unserialize(request()->cookie($ob['_id'])), 
            $ob[unserialize(request()->cookie($ob['_id']))]['Title']['LoginAdmin'], 
            $ob[unserialize(request()->cookie($ob['_id']))]['Html']['Direction']);
            $this->label3 = $ob[unserialize(request()->cookie($ob['_id']))]['Label']['LoginUser'];  
        }else{
            Cookie::queue($ob['_id'], serialize($ob['Setting']['Language']),2628000);
            parent::__construct(
            $this->error1,
            $this->error2,
            $this->error3,
            $this->error4,
            $ob[$ob['Setting']['Language']]['Label']['LoginUser'],
            $ob[$ob['Setting']['Language']]['Label']['UserEmail'],
            $ob[$ob['Setting']['Language']]['Label']['UserPassword'],
            $ob[$ob['Setting']['Language']]['Hint']['UserEmail'],
            $ob[$ob['Setting']['Language']]['Hint']['UserPassword'],
            $ob[$ob['Setting']['Language']]['Label']['SettingLanguage'],
            $ob[$ob['Setting']['Language']]['Button']['Language'],
            $ob[$ob['Setting']['Language']]['Button']['SaveLanguage'],
            $ob[$ob['Setting']['Language']]['Button']['LoginUser'],
            $ob[$ob['Setting']['Language']]['AllNamesLanguage'],
            $ob['_id'],
            $ob['Setting']['Language'],
            $ob[$ob['Setting']['Language']]['Title']['LoginAdmin'], 
            $ob[$ob['Setting']['Language']]['Html']['Direction']);
        }
    }
    public function index(){
        return (new Response(view('login.user',[
        'lang'=>$this
        ])));
    }
    public function action(){
        return isset($this->successfully1)?redirect()->route('Home')->with('success', $this->successfully1):back()->withInput()->withErrors($this->errorMessage);
    }
}
