<?php

namespace App;
use App\MenuItem;
use App\Http\interface\DbRays;
class Menu
{
    private $Home;
    private $SystemLang;
    private $TestCultures;
    /**
     * Create a new class instance.
     */
    public function __construct(DbRays $ob, $state, $language)
    {
        if($state === 'SystemLang'){
            $this->Home = $ob->getDataBase()[$language]['Menu']['Home'];
            $this->SystemLang = $ob->getDataBase()[$language]['Menu']['SystemLang'];
            foreach ($ob->getDataBase()[$language]['AllNamesLanguage'] as $key => $value)
                $this->CustomMenu[$key] = new MenuItem($value, $ob->getDataBase()[$language]['CutomLang']);
        }
        else{
            $this->SystemLang = $ob->getDataBase()[$language]['Menu']['SystemLang'];
            $this->Home = $ob->getDataBase()[$language]['Menu']['Home'];
            $this->TestCultures = new MenuItem($ob->getDataBase()[$language]['Menu']['TestCultures']['Name'], $ob->getDataBase()[$language]['Menu']['TestCultures']['Item']);
        }
    }
    public function getMenu(){
        return array_filter(get_object_vars($this), function ($value) {
            return !is_null($value);
        });
    }
    public function getIconByKey($key){
        if($key === 'Home')//--
            return 'bi bi-box-arrow-left';
        else if($key === 'SystemLang')
                return 'bi bi-gear';  
        else if($key === 'ChangeLanguage')
            return 'bi bi-globe-asia-australia';
        else if($key === 'Reception')
            return 'bi bi-person-video';
        else if($key === 'TestCultures')
            return 'bi bi-pencil-square';
        else if($key === 'Contracts')
            return 'bi bi-pencil';
        else if($key === 'Receipt')
            return 'bi bi-person-add';
        else if($key === 'Patent')
            return 'bi bi-people-fill';
        else if($key === 'Test')
            return 'bi bi-pencil-square';
        else if($key === 'Cultures')
            return 'bi bi-globe';
        else if($key === 'Packages')
            return 'bi bi-box';
        else if($key === 'PackagesContracts')
            return 'bi bi-box';
        else if($key === 'Knows')
            return 'bi bi-lightbulb';
        else if($key === 'SelectBox')
            return 'bi bi-cart4';
        else if($key === 'Direction')
            return 'bi bi-arrow-left-right';
        else if($key === 'Admin')
            return 'bi bi-file-richtext';
        else if($key === 'Branch')
            return 'bi bi-hospital';
        else if($key === 'Contracts')
            return 'bi bi-lightbulb-fill';
        else if($key === 'AllNamesLanguage')
            return 'bi bi-globe-europe-africa';
        else if($key === 'Html')
            return 'bi bi-table';
        else if($key === 'Menu')
            return 'bi bi-menu-button-fill';
        else if($key === 'CheckBox')
            return 'bi bi-layout-text-sidebar'; 
        else if($key === 'CutomLang')
            return 'bi bi-menu-button-fill';
        else if($key === 'LoginAdmin')
            return 'bi bi-globe-americas';
        else if($key === 'TableInfo')
            return 'bi bi-person-add';
        else if($key === 'AppSettingAdmin')
            return 'bi bi-box';   
         else if($key === 'SelectTestBox')
            return 'bi bi-hospital';
        else if($key === 'SelectBranchBox')
            return 'bi bi-gear';
        else if($key === 'SelectNationalityBox')
            return 'bi bi-clipboard2-x-fill';
        else if($key === 'SelectGenderBox')
            return 'bi bi-arrow-left-right';
        else if($key === 'PaymentMethodBox')
            return 'bi bi-globe-americas';
        else if($key === 'Register')
            return 'bi bi-pencil';
        else
            return 'bi bi-clipboard2-check'; 
    }
}
