<?php

namespace App;
use App\MenuItem;
class Menu
{
    private $Home;
    private $SystemLang;
    private $ChangeLanguage;
    private $Reception;
    private $TestCultures;
    private $Contracts;
    private $Branches;
    /**
     * Create a new class instance.
     */
    public function __construct($menu, $state = null, $CutomLang = null, $MyLanguage = null)
    {
        if($state === 'Language'){
            $this->Home = $menu['Home'];
            $this->SystemLang = $menu['SystemLang'];
            foreach ($MyLanguage as $key => $value)
                $this->CustomMenu[$key] = new MenuItem($value, $CutomLang);
        }
        else{
            $this->ChangeLanguage = $menu['ChangeLanguage'];
            $this->SystemLang = $menu['SystemLang'];
            $this->Home = $menu['Home'];
            $this->Reception = new MenuItem($menu['Reception']['Name'], $menu['Reception']['Item']);
            $this->TestCultures = new MenuItem($menu['TestCultures']['Name'], $menu['TestCultures']['Item']);
            $this->Contracts = new MenuItem($menu['Contracts']['Name'], $menu['Contracts']['Item']);
            $this->Branches = $menu['Branches'];
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
        else if($key === 'Branches')
            return 'bi bi-hospital';
        else if($key === 'PatientRegisteration')
            return 'bi bi-person-add';
        else if($key === 'Patients')
            return 'bi bi-people-fill';
        else if($key === 'AllTestCultures')
            return 'bi bi-pencil-square';
        else if($key === 'TheCultures')
            return 'bi bi-globe';
        else if($key === 'PackagesCultures')
            return 'bi bi-box';
        else if($key === 'PackagesContracts')
            return 'bi bi-box';
        else if($key === 'Knows')
            return 'bi bi-lightbulb';
        else if($key === 'SelectBox')
            return 'bi bi-cart4';
        else if($key === 'Direction')
            return 'bi bi-arrow-left-right';
        else if($key === 'Label')
            return 'bi bi-file-richtext';
        else if($key === 'Title')
            return 'bi bi-globe-asia-australia';
        else if($key === 'Hint')
            return 'bi bi-lightbulb-fill';
        else if($key === 'Button')
            return 'bi bi-fonts';
        else if($key === 'AllNamesLanguage')
            return 'bi bi-globe-europe-africa';
        else if($key === 'Html')
            return 'bi bi-table';
        else if($key === 'Menu')
            return 'bi bi-menu-button-fill';
        else if($key === 'Error')
            return 'bi bi-clipboard2-x-fill';
        else if($key === 'Message')
            return 'bi bi-clipboard2-check-fill';
        else if($key === 'Table')
            return 'bi bi-table';
        else if($key === 'Model')
            return 'bi bi-layout-text-sidebar'; 
        else if($key === 'CheckBox')
            return 'bi bi-clipboard2-check'; 
        else if($key === 'CutomLang')
            return 'bi bi-clipboard2-check';
        else if($key === 'AllLanguage')
            return 'bi bi-globe-americas';
        else if($key === 'TableInfo')
            return 'bi bi-clipboard2-check';
        else if($key === 'AppSettingAdmin')
            return 'bi bi-clipboard2-check';   
        else if($key === 'MenuAdmin')
            return 'bi bi-clipboard2-check';    
        else if($key === 'TitleCustomLang')
            return 'bi bi-clipboard2-check';
         else if($key === 'SelectTestBox')
            return 'bi bi-clipboard2-check';
        else if($key === 'SelectBranchBox')
            return 'bi bi-clipboard2-check';
        else if($key === 'SelectNationalityBox')
            return 'bi bi-clipboard2-check';
        else if($key === 'SelectGenderBox')
            return 'bi bi-clipboard2-check';
        else if($key === 'PaymentMethodBox')
            return 'bi bi-clipboard2-check';
        else
            return 'bi bi-clipboard2-check'; 
    }
}
