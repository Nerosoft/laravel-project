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
            $view = view('admin.notifications.notification',[
                'lang'=> $lang,                
            ]);
        }
        else if($id === 'CreateNotifications'){
            $view = view('admin.notifications.create_notifications',[
                'lang'=> $lang,                
            ]);
        }else
            abort(404);
        $lang->myMenuApp['Notifications']['active'] = 'my_active';
        $lang->myMenuApp['Notifications']['items'][$id]['active'] = 'my_active';
        return $view;
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
