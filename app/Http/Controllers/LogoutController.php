<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Rays;
class LogoutController extends Controller
{
    public function logoutAdmin(){
        $url = Rays::first()['_id'] === request()->session()->get('userLogout') ? '/admin/login' : '/admin/'.request()->session()->get('userLogout').'/login';
        request()->session()->forget('userLogout');
        request()->session()->forget('userId');
        return redirect($url);
    }
}
