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
    }
    public function index(){
        return view('login.user',[
            'lang'=>$this
        ]);
    }
    public function makeLogin(){
        request()->validate($this->roll, $this->message);
        foreach ($this->users as $key => $user)
            if($user['Email'] === request()->input('email') && $user['Password'] === request()->input('password')){
                //save user session
                request()->session()->put('userId', request()->input('id'));
                //save user session logout
                request()->session()->put('userLogout', request()->input('id'));
                return redirect()->route('Home')->with('success', $this->ob[$this->ob['Setting']['Language']]['LoginAdmin']['LoginMessage']);
            }         
        // return error email exsist
        return back()->withInput()->withErrors($this->ob[$this->language]['LoginAdmin']['UserPasswordDntMatch']);
    }
}
