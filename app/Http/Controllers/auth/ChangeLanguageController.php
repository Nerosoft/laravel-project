<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Cookie;
use App\Models\Rays;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use App\Http\interface\ValidRule;
use App\Http\interface\DbRays;
use App\language\share\Page;

class ChangeLanguageController extends Page implements ValidRule, DbRays
{
    public function getDataBase(){
        return $this->ob;
    }
    public function getValidRule(){
        array_push($this->roll['id'], Route::currentRouteName() === 'branch.delete'?Rule::in(array_keys((array)Rays::find(request()->session()->get('userLogout'))['Branch'])):
        Rule::in(Route::currentRouteName() === 'branchMain'?(array_merge([request()->session()->get('userLogout')],array_keys((array)Rays::find(request()->session()->get('userLogout'))['Branch']))):array_keys($this->getDataBase()[$this->getDataBase()['Setting']['Language']]['AllNamesLanguage'])));
        array_push($this->roll['id'], Route::currentRouteName() === 'branchMain' || Route::currentRouteName() === 'branch.delete'?Rule::notIn(request()->session()->get('userId')):Rule::notIn(request()->session()->get('userId')?$this->getDataBase()['Setting']['Language']:(request()->cookie(request()->input('userAdmin'))&&request()->input('id') === unserialize(request()->cookie(request()->input('userAdmin')))?unserialize(request()->cookie(request()->input('userAdmin'))):array())));
    }
    public function __construct(){
        $this->ob = request()->session()->get('userId')?Rays::find(request()->session()->get('userId')):(Rays::find(request()->input('userAdmin'))?Rays::find(request()->input('userAdmin')):Rays::first());
        parent::__construct($this, Route::currentRouteName() === 'branchMain'?'Branch':'ChangeLanguage');
        $this->message['not_in'] = $this->getDataBase()[$this->getDataBase()['Setting']['Language']][Route::currentRouteName() === 'branchMain'?'Branch':'ChangeLanguage']['IdIsInv'];
        request()->validate($this->roll, $this->message);
    }
    public function makeChangeBranch(){   
        request()->session()->put('userId', request()->input('id'));
        return back()->with('success', $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Branch']['BranchesChange'].(request()->session()->get('userLogout') === request()->input('id') ? $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['AppSettingAdmin']['BranchMain']:Rays::find(request()->session()->get('userLogout'))['Branch'][request()->input('id')]['Name']));
    }
    public function makeChangeMyLanguage(){
        $setting = $this->getDataBase()['Setting'];
        $setting['Language'] = request()->input('id');
        $this->getDataBase()['Setting'] = $setting;
        $this->getDataBase()->save();
        return back()->with('success', $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['ChangeLanguage']['ChangeLang'].$this->getDataBase()[$this->getDataBase()['Setting']['Language']]['AllNamesLanguage'][request()->input('id')]);
    }
    public function makeDeleteMyLanguage(){
        $langName = $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['AllNamesLanguage'][request()->input('id')];
        foreach ($this->getDataBase()[$this->getDataBase()['Setting']['Language']]['AllNamesLanguage'] as $key=>$value) {
            $myLang = $this->getDataBase()[$key];
            unset($myLang['AllNamesLanguage'][request()->input('id')]);
            $this->getDataBase()[$key] = $myLang;
        }
        unset($this->getDataBase()[request()->input('id')]);
        $this->getDataBase()->save();
        return back()->with('success', $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['ChangeLanguage']['DeleteLanguage'].$langName);
    }
    public function makeChangeAuthLang(){
        Cookie::queue(request()->input('userAdmin'), serialize(request()->input('id')),2628000);
        return back()->with('success', $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['ChangeLanguage']['ChangeLang'].$this->getDataBase()[request()->input('id')]['AllNamesLanguage'][request()->input('id')]);
    }
    public function makeDeleteMyBranch(){
        $this->getDeleteDatabade(Rays::find(request()->session()->get('userLogout')), 'Branch');
        Rays::find(request()->input('id'))->delete();
        return back()->with('success', $this->getDataBase()[$this->getDataBase()['Setting']['Language']]['Branch']['Delete']);
    }
}
