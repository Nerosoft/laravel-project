<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\language\share\EmailPassInformaion;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\Rule;

class LoginAdminController extends EmailPassInformaion
{
    public function __construct(){
        parent::__construct('LoginAdmin');
        if(Route::currentRouteName() === 'loginUser.loginUser'){
            request()->validate($this->roll, $this->message);
            foreach ($this->users as $key => $user)
                if($user['Email'] === request()->input('email') && $user['Password'] === request()->input('password')){
                    //save user session
                    request()->session()->put('userId', request()->input('id'));
                    //save user session logout
                    request()->session()->put('userLogout', request()->input('id'));
                    $this->successfully1 = $this->ob[$this->ob['Setting']['Language']]['LoginAdmin']['LoginMessage'];
                    return;
                }         
            // return error email exsist
            $this->errorMessage = $this->ob[isset($this->ob[unserialize(request()->cookie($this->ob['_id']))]) ? unserialize(request()->cookie($this->ob['_id'])) : $this->ob['Setting']['Language']]['LoginAdmin']['UserPasswordDntMatch'];
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
