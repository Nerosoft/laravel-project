<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Rays;
class LogoutController extends Controller
{
    public function logoutPatent(){
        $url = Rays::first()['_id'] === request()->session()->get('patentLogout') ? '/login' : '/'.request()->session()->get('patentLogout').'/login';
        request()->session()->forget('patentLogout');
        request()->session()->forget('patentId');
        return redirect($url);
    }
    public function logoutDoctor(){
        $url = Rays::first()['_id'] === request()->session()->get('doctorLogout') ? '/doctor/login' : '/doctor/'.request()->session()->get('doctorLogout').'/login';
        request()->session()->forget('doctorLogout');
        request()->session()->forget('doctorId');
        return redirect($url);
    }
    public function logoutAdmin(){
        $url = Rays::first()['_id'] === request()->session()->get('userLogout') ? '/admin/login' : '/admin/'.request()->session()->get('userLogout').'/login';
        request()->session()->forget('userLogout');
        request()->session()->forget('userId');
        return redirect($url);
    }
}
