<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\language\admin\notifications\Notification;
use App\language\admin\notifications\CreateNotifications;
class NotificationsController extends Controller
{
    public function index($id){
        $lang = $this->initLanguage($id);
        if($id === 'Notification'){
            return view('admin.notifications.notification',[
                'lang'=> $lang,
                'active'=>'Notifications',
                'activeItem'=>'Notification'                
            ]);
        }
        else if($id === 'CreateNotifications'){
            return view('admin.notifications.create_notifications',[
                'lang'=> $lang,
                'active'=>'Notifications',
                'activeItem'=>'CreateNotifications'                
            ]);
        }else
            abort(404);
    }
    private function initLanguage($id){
        switch ($id) {
            case'Notification':        
                return new Notification();
            case'CreateNotifications':
                return new CreateNotifications();
            default :
                return null;
        }
    }
}
