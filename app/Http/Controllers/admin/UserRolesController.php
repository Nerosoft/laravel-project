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
            $view = view('admin.user_roles.roles',[
                'lang'=> $lang, 
            ]);
        }
        else if($id === 'User'){
            $view = view('admin.user_roles.user',[
                'lang'=> $lang,
            ]);
        }else
            abort(404);
        $lang->myMenuApp['UserRoles']['active'] = 'my_active';
        $lang->myMenuApp['UserRoles']['items'][$id]['active'] = 'my_active';
        return $view;
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
