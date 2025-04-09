<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\language\admin\user_roles\Roles;
use App\language\admin\user_roles\User;
class UserRolesController extends Controller
{
    public function index($id){
        $lang = $this->initLanguage($id);
        if($id === 'Roles'){
            return view('admin.user_roles.roles',[
                'lang'=> $lang,
                'logOut'=>route('admin.logout'),
                'active'=>'UserRoles',
                'activeItem'=>'Roles' 
            ]);
        }
        else if($id === 'User'){
            return view('admin.user_roles.user',[
                'lang'=> $lang,
                'logOut'=>route('admin.logout'),
                'active'=>'UserRoles',
                'activeItem'=>'User'
            ]);
        }else
            abort(404);
    }
    private function initLanguage($id){
        switch ($id) {
            case'Roles':
                return new Roles();
            case'User':
                return new User();
            default :
                return null;
        }
    }
}
