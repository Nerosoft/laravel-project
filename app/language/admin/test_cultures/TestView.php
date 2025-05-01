<?php
namespace App\language\admin\test_cultures;
use App\Models\Rays;
use App\instance\admin\test_cultures\Test;
use App\instance\admin\test_cultures\Packages;
use App\instance\admin\test_cultures\Cultures;
use App\language\share\Page;
use App\Menu;
use App\instance\admin\test_cultures\MyCurrentOffers;
class TestView extends Page{
    public $arr1 = array();
    public function __construct($state, $ob){   
        parent::__construct($ob[$ob['Setting']['Language']]['Error'],
        $state, $ob['Setting']['Language'],
        $ob[$ob['Setting']['Language']]['Title'][$state === 'AllTestCultures' ? 'DeleteTest' : ($state !== 'PackagesCultures' ? ($state !== 'CurrentOffers' ? 'DeleteCultures' : 'DeleteCurrentOffers') : 'DeletePackages')], 
        $ob[$ob['Setting']['Language']]['Label'][$state === 'AllTestCultures' ? 'DeleteTest' : ($state !== 'PackagesCultures' ? ($state !== 'CurrentOffers' ? 'DeleteCultures' : 'DeleteCurrentOffers') : 'DeletePackages')], 
        $ob[$ob['Setting']['Language']]['Button'][$state === 'AllTestCultures' ? 'DeleteTest' : ($state !== 'PackagesCultures' ? ($state !== 'CurrentOffers' ? 'DeleteCultures' : 'DeleteCurrentOffers') : 'DeletePackages')], 
        $state === 'CurrentOffers' ? route('deleteCurrentOffers') : route('deleteTest', $state), 
        $ob[$ob['Setting']['Language']]['TableInfo'], 

        $ob[$ob['Setting']['Language']]['Title'][$state === 'AllTestCultures' ? 'AllTestCultures' : ($state !== 'PackagesCultures' ? ($state !== 'CurrentOffers' ? 'TheCultures' : 'CurrentOffers') : 'PackagesCultures')], 

        $ob[$ob['Setting']['Language']]['AppSettingAdmin'], 
        $ob[$ob['Setting']['Language']]['Html']['Direction'], 
        $ob['Branch'], 
        new Menu($ob[$ob['Setting']['Language']]['Menu'], 'Admin'),
        $ob[$ob['Setting']['Language']]['Title'][$state === 'AllTestCultures' ? 'CreateTest' : ($state !== 'PackagesCultures' ? ($state !== 'CurrentOffers' ? 'CreateCultures' : 'CreateCurrentOffers') : 'CreatePackages')],
        $ob[$ob['Setting']['Language']]['Title'][$state === 'AllTestCultures' ? 'EditTest' : ($state !== 'PackagesCultures' ? ($state !== 'CurrentOffers' ? 'EditCultures' : 'EditCurrentOffers') : 'EditPackages')],
        $ob[$ob['Setting']['Language']]['Button'][$state === 'AllTestCultures' ? 'CreateTest' : ($state !== 'PackagesCultures' ? ($state !== 'CurrentOffers' ? 'CreateCultures' : 'CreateCurrentOffers') : 'CreatePackages')],
        $ob[$ob['Setting']['Language']]['Button'][$state === 'AllTestCultures' ? 'AddTest' : ($state !== 'PackagesCultures' ? ($state !== 'CurrentOffers' ? 'AddCultures' : 'AddCurrentOffers') : 'AddPackages')],
        $ob[$ob['Setting']['Language']]['Button'][$state === 'AllTestCultures' ? 'EditTest' : ($state !== 'PackagesCultures' ? ($state !== 'CurrentOffers' ? 'EditCultures' : 'EditCurrentOffers') : 'EditPackages')],
        $ob[$ob['Setting']['Language']]['Table'][$state === 'AllTestCultures' ? 'TestId' : ($state !== 'PackagesCultures' ? ($state !== 'CurrentOffers' ? 'CulturesId' : 'CurrentOffersId') : 'PackagesId')],
        $ob[$ob['Setting']['Language']]['Table'][$state === 'AllTestCultures' ? 'TestEdit' : ($state !== 'PackagesCultures' ? ($state !== 'CurrentOffers' ? 'CulturesEdit' : 'CurrentOffersEdit') : 'PackagesEdit')]);

        $this->table8 = $ob[$this->language]['Table'][$state === 'AllTestCultures' ? 'TestName' : ($state !== 'PackagesCultures' ? ($state !== 'CurrentOffers' ? 'CulturesName' : 'CurrentOffersName') : 'PackagesName')];
        $this->table9 = $ob[$this->language]['Table'][$state === 'AllTestCultures' ? 'TestPrice' : ($state !== 'PackagesCultures' ? ($state !== 'CurrentOffers' ? 'CulturesPrice' : 'CurrentOffersPrice') : 'PackagesPrice')];
        $this->table10 = $ob[$this->language]['Table'][$state === 'AllTestCultures' ? 'TestInputOutput' : ($state !== 'PackagesCultures' ? ($state !== 'CurrentOffers' ? 'CulturesInputOutput' : 'CurrentOffersState') : 'PackagesInputOutput')];
        $this->table12 = $ob[$this->language]['Table'][$state === 'AllTestCultures' ? 'TestShortcut' : ($state !== 'PackagesCultures' ? ($state !== 'CurrentOffers' ? 'CulturesShortcut' : 'CurrentOffersShortcut') : 'PackagesShortcut')];

        $this->label3 = $ob[$this->language]['Label'][$state === 'AllTestCultures' ? 'TestName' : ($state !== 'PackagesCultures' ? ($state !== 'CurrentOffers' ? 'CulturesName' : 'CurrentOffersName') : 'PackagesName')];
        $this->label4 = $ob[$this->language]['Label'][$state === 'AllTestCultures' ? 'TestPrice' : ($state !== 'PackagesCultures' ? ($state !== 'CurrentOffers' ? 'CulturesPrice' : 'CurrentOffersPrice') : 'PackagesPrice')];
        $this->label5 = $ob[$this->language]['Label'][$state === 'AllTestCultures' ? 'TestInputOutLab' : ($state !== 'PackagesCultures' ? ($state !== 'CurrentOffers' ? 'CulturesInputOutLab' : 'CurrentOffersState') : 'PackagesInputOutLab')];
        $this->label7 = $ob[$this->language]['Label'][$state === 'AllTestCultures' ? 'TestShortcut' : ($state !== 'PackagesCultures' ? ($state !== 'CurrentOffers' ? 'CulturesShortcut' : 'CurrentOffersShortcut') : 'PackagesShortcut')];

        $this->inputOutPut = $ob[$this->language][$state !== 'CurrentOffers' ? 'SelectTestBox' : 'SelectOfferBox'];
        $this->selectBox1 = $ob[$this->language]['SelectBox'][$state !== 'CurrentOffers' ? 'TestInputOutLab' : 'CurrentOffersState'];

        $this->hint1 = $ob[$this->language]['Hint'][$state === 'AllTestCultures' ? 'TestName': ($state !== 'PackagesCultures' ? ($state !== 'CurrentOffers' ? 'CulturesName' : 'CurrentOffersName') : 'PackagesName')];
        $this->hint2 = $ob[$this->language]['Hint'][$state === 'AllTestCultures' ? 'TestPrice': ($state !== 'PackagesCultures' ? ($state !== 'CurrentOffers' ? 'CulturesPrice' : 'CurrentOffersPrice') : 'PackagesPrice')];
        $this->hint3 = $ob[$this->language]['Hint'][$state === 'AllTestCultures' ? 'TestShortcut': ($state !== 'PackagesCultures' ? ($state !== 'CurrentOffers' ? 'CulturesShortcut' : 'CurrentOffersShortcut') : 'PackagesShortcut')];
        

        if(isset($ob['Test']) && $state === 'AllTestCultures')
            foreach ($ob['Test'] as $key => $test)
                $this->arr1[$key] = new Test($test['Name'], $test['Shortcut'], $test['Price'], $test['InputOutputLab']);
        else if(isset($ob['Packages']) && $state === 'PackagesCultures')
            foreach ($ob['Packages'] as $key => $packages)
                $this->arr1[$key] = new Packages($packages['Name'], $packages['Shortcut'], $packages['Price'], $packages['InputOutputLab']);
        else if(isset($ob['Cultures']) && $state === 'TheCultures')
            foreach ($ob['Cultures'] as $key => $cultures)
                $this->arr1[$key] = new Cultures($cultures['Name'], $cultures['Shortcut'], $cultures['Price'], $cultures['InputOutputLab']);
        else if(isset($ob['CurrentOffers']) && $state === 'CurrentOffers')
            foreach ($ob['CurrentOffers'] as $key => $currentOffers)
                $this->arr1[$key] = new MyCurrentOffers($currentOffers['Name'], $currentOffers['Shortcut'], $currentOffers['Price'], $currentOffers['DisplayPrice'], $currentOffers['State']);
    }
}