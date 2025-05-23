<?php
namespace App\language\share;
use App\instance\admin\test_cultures\Test;
use App\instance\admin\test_cultures\Cultures;
use App\instance\admin\test_cultures\Packages;
use App\instance\admin\test_cultures\MyCurrentOffers;
use App\language\menu\AdminTopMenu;

use App\Http\interface\initError;
use App\Http\interface\initError2;
use App\Http\interface\initError3;

class TestParent extends AdminTopMenu implements initError, initError2, initError3{
    protected $error;
    protected function __construct($error, $myState, $Language, $AppSettingAdmin, $Direction, $Branch, $Title, $Menu, $ob = null, $var1 = null, $var2 = null, $var3 = null, $var4 = null, $var5 = null, $var6 = null){
        //dont call constractor in edit and delete
        parent::__construct($Language, $AppSettingAdmin, $Direction, $Branch, $Title, $Menu);
        $this->error = $error;
        $this->initError($myState, $ob, $var1, $var2, $var3, $var4, $var5, $var6);
    }
    public function initError($myState, $ob = null, $var1 = null, $var2 = null, $var3 = null, $var4 = null, $var5 = null, $var6 = null){
        if($myState === 'AllTestCultures'){
            $this->error1 = $this->error['TestNameRequired'];
            $this->error2 = $this->error['TestNameInvalid'];
            $this->error3 = $this->error['TestPriceRequired'];
            $this->error4 = $this->error['TestInputOutputLabRequired'];
            $this->error9 = $this->error['TestShortcutRequired'];
            $this->error10 = $this->error['TestShortcutInvalid'];
        }else if($myState === 'PackagesCultures'){
            $this->error1 = $this->error['PackagesNameRequired'];
            $this->error2 = $this->error['PackagesNameInvalid'];
            $this->error3 = $this->error['PackagesPriceRequired'];
            $this->error4 = $this->error['PackagesInputOutputLabRequired'];
            $this->error9 = $this->error['PackagesShortcutRequired'];
            $this->error10 = $this->error['PackagesShortcutInvalid'];
        }else if($myState === 'TheCultures'){
            $this->error1 = $this->error['CulturesNameRequired'];
            $this->error2 = $this->error['CulturesNameInvalid'];
            $this->error3 = $this->error['CulturesPriceRequired'];
            $this->error4 = $this->error['CulturesInputOutputLabRequired'];
            $this->error9 = $this->error['CulturesShortcutRequired'];
            $this->error10 = $this->error['CulturesShortcutInvalid'];
        }else if($myState === 'PackagesContracts'){
            $this->error1 = $this->error['ContractNameRequired'];
            $this->error2 = $this->error['ContractNameInvalid'];
            $this->error3 = $this->error['ContractGovernorateRequired'];
            $this->error4 = $this->error['ContractGovernorateInvalid'];
            $this->error5 = $this->error['ContractAreaRequired'];
            $this->error6 = $this->error['ContractAreaInvalid'];
        }else if($myState ==='Knows'){
            $this->error1 = $this->error['KnowsNameRequired'];
            $this->error2 = $this->error['KnowsNameInvalid'];
        }else if($myState === 'CurrentOffers'){
            $this->error1 = $this->error['CurrentOffersNameRequired'];
            $this->error2 = $this->error['CurrentOffersNameInvalid'];
            $this->error3 = $this->error['CurrentOffersShortcutRequired'];
            $this->error4 = $this->error['CurrentOffersShortcutInvalid'];
            $this->error5 = $this->error['CurrentOffersPriceRequired'];
            $this->error6 = $this->error['CurrentOffersDisplayPriceRequired'];
            $this->error7 = $this->error['CurrentOffersStateRequired'];
        }else if($myState === 'Branch'){
            $this->error1 = $this->error['BranceRaysNameRequired'];
            $this->error2 = $this->error['BranceRaysPhoneRequired'];
            $this->error3 = $this->error['BranceRaysGovernmentsRequired'];
            $this->error4 = $this->error['BranceRaysCityRequired'];
            $this->error5 = $this->error['BranceRaysStreetRequired'];
            $this->error6 = $this->error['BranceRaysBuildingRequired'];
            $this->error7 = $this->error['BranceRaysAddressRequired'];
            $this->error8 = $this->error['BranceRaysCountryRequired'];
            $this->error9 = $this->error['BranceRaysFollowRequired'];
            $this->error10 = $this->error['BranceRaysNameLength'];
            $this->error11 = $this->error['BranceRaysPhoneLength'];
            $this->error12 = $this->error['BranceRaysGovernmentsLength'];
            $this->error13 = $this->error['BranceRaysCityLength'];
            $this->error14 = $this->error['BranceRaysStreetLength'];
            $this->error15 = $this->error['BranceRaysBuildingLength'];
            $this->error16 = $this->error['BranceRaysAddressLength'];
            $this->error17 = $this->error['BranceRaysCountryLength'];
        }else if($myState === 'Patients'){
            $this->error1 = $this->error['PatentNameRequired'];
            $this->error2 = $this->error['PatentNameInvalid'];
            $this->error3 = $this->error['PatentNationalIdRequired'];
            $this->error4 = $this->error['PatentNationalIdInvalid'];
            $this->error5 = $this->error['PatentPassportNoRequired'];
            $this->error6 = $this->error['PatentPassportNoInvalid'];
            $this->error7 = $this->error['PatentEmailRequired'];
            $this->error8 = $this->error['PatentEmailInvalid'];
            $this->error9 = $this->error['PatentPhoneRequired'];
            $this->error10 = $this->error['PatentPhoneInvalid'];
            $this->error11 = $this->error['PatentPhone2Required'];
            $this->error12 = $this->error['PatentPhone2Invalid'];
            $this->error13 = $this->error['PatentAddressRequired'];
            $this->error14 = $this->error['PatentAddressInvalid'];
            $this->error15 = $this->error['PatentFastingHoursRequired'];
            $this->error16 = $this->error['PatentDiseaseRequired'];
            $this->error17 = $this->error['PatentNationalityRequired'];
            $this->error18 = $this->error['PatentGenderRequired'];
            $this->error19 = $this->error['PatentLastPeriodDateRequired'];
            $this->error20 = $this->error['PatentDateBirthRequired'];
            $this->error21 = $this->error['PatentContractingRequired'];
            $this->error22 = $this->error['PatentDiseasOtherInvalid'];
            $this->error23 = $this->error['PatentAvatarImage'];
            $this->error32 = $this->error['PatentAvatarMax'];
            $this->PatentAvatarDimensions = $this->error['PatentAvatarDimensions'];
        }else if($myState === 'PatientRegisteration'){
            $this->error2 = $this->error['PatientRegisterationPaymentMethodRequired'];
            $this->error3 = $this->error['PatientRegisterationPatentCodeRequired'];
            $this->error4 = $this->error['PatientRegisterationKnowRequired'];
            $this->error5 = $this->error['PatientRegisterationItemRequired'];
            $this->error6 = $this->error['PatientRegisterationPaymentDateRequired'];
            $this->error7 = $this->error['PatientRegisterationPaymentAmountRequired'];
            $this->arr2 = array();
            $this->arr3 = array();
            $this->arr4 = array();
            $this->arr5 = array();
            if(isset($ob))
                foreach ($ob as $test)
                    array_push($this->arr2, $var4 ? array($test['Name'], $test['Shortcut'], $test['Price'], $var5[$test['InputOutputLab']], $test['Id']) : new Test($test['Name'], $test['Shortcut'], $test['Price'], $test['InputOutputLab'], $test['Id']));
            if(isset($var1))
                foreach ($var1 as $key => $cultures)
                    array_push($this->arr3, $var4 ? array($cultures['Name'], $cultures['Shortcut'], $cultures['Price'], $var5[$cultures['InputOutputLab']], $cultures['Id']) : new Cultures($cultures['Name'], $cultures['Shortcut'], $cultures['Price'], $cultures['InputOutputLab'], $cultures['Id']));
            //init Packages
            if(isset($var2))
                foreach ($var2 as $key => $packages)
                    array_push($this->arr4, $var4 ? array($packages['Name'], $packages['Shortcut'], $packages['Price'], $var5[$packages['InputOutputLab']], $packages['Id']) : new Packages($packages['Name'], $packages['Shortcut'], $packages['Price'], $packages['InputOutputLab'], $packages['Id']));
            if(isset($var3))
                foreach ($var3 as $key => $currentOffers)
                    array_push($this->arr5, $var4 ? array($currentOffers['Name'], $currentOffers['Shortcut'], $var6[$currentOffers['State']], $currentOffers['Price'], $currentOffers['DisplayPrice'], $currentOffers['Id']) : new MyCurrentOffers($currentOffers['Name'], $currentOffers['Shortcut'], $currentOffers['Price'], $currentOffers['DisplayPrice'], $currentOffers['State'], $currentOffers['Id']));    
        }else if($myState === 'ChangeLanguage'){
            $this->error1 = $this->error['NewLangNameRequired'];
            $this->error2 = $this->error['NewLangNameInvalid'];
        } 
        else {//if($myState === 'AllLanguage'){
            $this->error1 = $this->error['TextRequired'];
            $this->error2 = $this->error['TextLenght'];
        }
    }
    public function initError2($myState, $var1 = null, $var2 = null, $var3 = null, $var4 = null, $avatar = null){
        if($myState === 'AllTestCultures'){
            $this->error5 = $this->error['TestPriceInvalid'];
            $this->error6 = $this->error['TestInputOutputLabInvalid'];
            $this->inputOutPutKeys = $var1;
        }else if($myState === 'PackagesCultures'){
            $this->error5 = $this->error['PackagesPriceInvalid'];
            $this->error6 = $this->error['PackagesInputOutputLabInvalid'];
            $this->inputOutPutKeys = $var1;
        }else if($myState === 'TheCultures'){
            $this->error5 = $this->error['CulturesPriceInvalid'];
            $this->error6 = $this->error['CulturesInputOutputLabInvalid'];
            $this->inputOutPutKeys = $var1;
        }else if($myState === 'Branch'){
            $this->error18 = $this->error['BranceRaysFollowLength'];
            $this->error19 = $this->error['BranceRaysFollowValue'];
            $this->branchInputOutputKeys = $var1;
        }else if($myState === 'Patients'){
            $this ->error24 = $this->error['PatentGenderInvalid'];
            $this ->error25 = $this->error['PatentLastPeriodDateInvalid'];
            $this->error26 = $this->error['PatentDateBirthInvalid'];
            $this->error27 = $this->error['PatentContractingInvalid'];
            $this->error28 = $this->error['PatentDiseaseInvalid'];
            $this->error29 = $this->error['PatentDiseasOtherInvalid'];
            $this->error31 = $this->error['PatentAvatarMimes'];
            $this->error33 = $this->error['PatentNationalityInvalid'];
            $this->error34 = $this->error['PatentFastingHoursInvalid'];
            $this->nationalityKeys = $var1;
            $this->genderKeys = $var2;
            $this->disKeys = $var3;
            $this->arr1 = $var4;
            $this->avatar = $avatar;
        }else if($myState === 'PatientRegisteration'){
            $this->error8 = $this->error['PatientRegisterationPaymentMethodInvalid'];
            $this->error9 = $this->error['PatientRegisterationDiscountRequired'];
            $this->error10 = $this->error['PatientRegisterationDiscountInvalid'];
            $this->error11 = $this->error['PatientRegisterationDelayedMoneyRequired'];
            $this->error12 = $this->error['PatientRegisterationDelayedMoneyInvalid'];
            $this->error13 = $this->error['PatientRegisterationItemInvalid'];
            $this->error14 = $this->error['PatientRegisterationPaymentDateInvalid'];
            $this->error15 = $this->error['PatientRegisterationPatentCodeInvalid'];
            $this->error16 = $this->error['PatientRegisterationPaymentAmountInvalid'];
            $this->error17 = $this->error['PatientRegisterationKnowInvalid'];
            $this->arr6 = array();
            if(isset($var1))
                foreach ($var1 as $key => $patent)
                    array_push($this->arr6, $patent['PatentCode']);
            $this->arr1 = $var2;
            $this->paymentKeys = $var3;
            
        }else if($myState === 'ChangeLanguage'){
            $this->error5 = $this->error['ChangeLanguageUsed'];
            $this->language = $var1;
        }else if($myState === 'AllLanguage'){
            $this->error3 = $this->error['EditLanguageRequired'];
            $this->error4 = $this->error['EditTableRequired'];
            $this->error5 = $this->error['EditKeyRequired'];
            $this->error7 = $this->error['EditLanguageInvalid'];
            $this->error8 = $this->error['EditTableInvalid'];
            $this->error9 = $this->error['EditKeyInvalid'];
            $this->error10 = $this->error['EditKey2Invalid'];
            $this->size2 = $var1;
            $this->size3 = $var2;
        }
        else{
            $this->error8 = $this->error['CurrentOffersPriceInvalid'];
            $this->error9 = $this->error['CurrentOffersDisplayPriceInvalid'];
            $this->error10 = $this->error['CurrentOffersStateInvalid'];
            $this->inputOutPutKeys = $var1;
        }
    }
    public function initError3($myState, $var1){
        $this->size1 = $var1;
        if($myState === 'AllTestCultures'){
            $this->error7 = $this->error['TestIdRequired'];
            $this->error8 = $this->error['TestIdInvalid'];
        }else if($myState === 'PackagesCultures'){
            $this->error7 = $this->error['PackagesIdRequired'];
            $this->error8 = $this->error['PackagesIdInvalid'];
        }else if($myState === 'TheCultures'){
            $this->error7 = $this->error['CulturesIdRequired'];
            $this->error8 = $this->error['CulturesIdInvalid'];
        }else if ($myState === 'PackagesContracts'){
            $this->error7 = $this->error['ContractIdRequired'];
            $this->error8 = $this->error['ContractIdInvalid'];
        }else if($myState === 'Knows'){
            $this->error3 = $this->error['KnowsIdRequired'];
            $this->error4 = $this->error['KnowsIdInvalid'];
        }else if($myState === 'Branch'){
            $this->error20 = $this->error['BranchRaysId'];
            $this->error21 = $this->error['BranchRaysLenght'];
        }else if($myState === 'Patients'){
            $this->error35 = $this->error['PatentIdRequired'];
            $this->error36 = $this->error['PatentIdInvalid'];
        }else if($myState === 'PatientRegisteration'){
            $this->error18 = $this->error['PatientRegisterationIdRequired'];
            $this->error19 = $this->error['PatientRegisterationIdInvalid'];
        }else if($myState === 'ChangeLanguage'){
            $this->error3 = $this->error['ChangeLanguageRequired'];
            $this->error4 = $this->error['ChangeLanguageInvalid'];
        }
        else{
            $this->error11 = $this->error['CurrentOffersIdRequired'];
            $this->error12 = $this->error['CurrentOffersIdInvalid'];
        }
    }
}