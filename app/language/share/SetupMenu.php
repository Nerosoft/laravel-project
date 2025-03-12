<?php
namespace App\language\share;
class SetupMenu extends InitPage{
    protected function __construct($language, $title, $direction, $myMenuApp, $AppSetting)
    {
        parent::__construct($language, $title, $direction);
        $this->myMenuApp = array();
        $this->title101 = $AppSetting['Offcanvas'];
        $this->label1 = $AppSetting['Logout'];
        $this->label2 = $AppSetting['AdminDashboard'];
        foreach ($myMenuApp->getMenu() as $key => $value){
            if($key === 'CustomMenu')
                foreach (array_reverse($value) as $key2 => $myValue){
                    $this->myMenuApp[$key2]['name'] = $myValue->Name;
                    $this->myMenuApp[$key2]['icon'] = 'bi bi-spellcheck';
                    $this->myMenuApp[$key2]['items'] = array();
                        foreach ($myValue->Item as $key3 => $item) {
                            $this->myMenuApp[$key2]['items'][$key3] = array('name'=> $item, 'icon'=>$myMenuApp->getIconByKey($key3), 'link'=>'Setting', 'id'=>$key3, 'lang'=>$key2);
                        }
                }
            else if(isset($value->Item)){
                $this->myMenuApp[$key]['name'] = $value->Name;
                $this->myMenuApp[$key]['icon'] = $myMenuApp->getIconByKey($key);
                $this->myMenuApp[$key]['items'] = array();
                foreach ($value->Item as $key2 => $item) {
                    $this->myMenuApp[$key]['items'][$key2] = array('name'=> $item,  'icon'=>$myMenuApp->getIconByKey($key2), 'link'=>$key, 'id'=>$key2);
                }
            }
            else if($value && $key === 'AllLanguage' || $value && $key === 'ChangeLanguage'){
                $this->myMenuApp[$key] = array('name'=> $value,  'icon'=>$myMenuApp->getIconByKey($key), 'link'=>'Setting', 'id'=>$key);
            }
            else if($value)
                $this->myMenuApp[$key] = array('name'=> $value,  'icon'=>$myMenuApp->getIconByKey($key), 'link'=>$key);
        }
    }
}
