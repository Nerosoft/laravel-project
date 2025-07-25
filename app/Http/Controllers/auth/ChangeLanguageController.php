<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Cookie;
use App\Models\Rays;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;


use App\language\share\Page;

class ChangeLanguageController extends Page
{
    public function __construct(){
        $this->ob = Rays::find(request()->session()->get('userId'))?Rays::find(request()->session()->get('userId')):(Rays::find(request()->input('userAdmin'))?Rays::find(request()->input('userAdmin')):Rays::first());
        parent::__construct(Route::currentRouteName() === 'branchMain'?'Branch':'ChangeLanguage', $this->ob);
        array_push($this->roll['id'], Route::currentRouteName() === 'branch.delete'?Rule::in(Rays::find(request()->session()->get('userLogout'))['Branch']?array_keys(Rays::find(request()->session()->get('userLogout'))['Branch']):null):Rule::in(Route::currentRouteName() === 'branchMain'?(Rays::find(request()->session()->get('userLogout'))['Branch']?array_merge([request()->session()->get('userLogout')],array_keys(Rays::find(request()->session()->get('userLogout'))['Branch'])):request()->session()->get('userLogout')):array_keys($this->ob[$this->ob['Setting']['Language']]['AllNamesLanguage'])));
        array_push($this->roll['id'], Route::currentRouteName() === 'branchMain' || Route::currentRouteName() === 'branch.delete'?
        Rule::notIn(request()->session()->get('userId')):Rule::notIn(request()->session()->get('userId')?$this->ob['Setting']['Language']:(request()->cookie(request()->input('userAdmin'))&&request()->input('id') === unserialize(request()->cookie(request()->input('userAdmin')))?unserialize(request()->cookie(request()->input('userAdmin'))):array())));
        $this->message['not_in'] = $this->ob[$this->ob['Setting']['Language']][Route::currentRouteName() === 'branchMain'?'Branch':'ChangeLanguage']['IdIsInv'];
        request()->validate($this->roll, $this->message);
    }
    public function makeChangeBranch(){   
        request()->session()->put('userId', request()->input('id'));
        return back()->with('success', $this->ob[$this->ob['Setting']['Language']]['Branch']['BranchesChange'].(request()->session()->get('userLogout') === request()->input('id') ? $this->ob[$this->ob['Setting']['Language']]['AppSettingAdmin']['BranchMain']:Rays::find(request()->session()->get('userLogout'))['Branch'][request()->input('id')]['Name']));
    }
    public function makeChangeMyLanguage(){
        $setting = $this->ob['Setting'];
        $setting['Language'] = request()->input('id');
        $this->ob['Setting'] = $setting;
        $this->ob->save();
        return back()->with('success', $this->ob[$this->ob['Setting']['Language']]['ChangeLanguage']['ChangeLang'].$this->ob[$this->ob['Setting']['Language']]['AllNamesLanguage'][request()->input('id')]);
    }
    public function makeDeleteMyLanguage(){
        $langName = $this->ob[$this->ob['Setting']['Language']]['AllNamesLanguage'][request()->input('id')];
        foreach ($this->ob[$this->ob['Setting']['Language']]['AllNamesLanguage'] as $key=>$value) {
            $myLang = $this->ob[$key];
            unset($myLang['AllNamesLanguage'][request()->input('id')]);
            $this->ob[$key] = $myLang;
        }
        unset($this->ob[request()->input('id')]);
        $this->ob->save();
        return back()->with('success', $this->ob[$this->ob['Setting']['Language']]['ChangeLanguage']['DeleteLanguage'].$langName);
    }
    public function makeChangeAuthLang(){
        Cookie::queue(request()->input('userAdmin'), serialize(request()->input('id')),2628000);
        return back()->with('success', $this->ob[$this->ob['Setting']['Language']]['ChangeLanguage']['ChangeLang'].$this->ob[request()->input('id')]['AllNamesLanguage'][request()->input('id')]);
    }
    public function makeDeleteMyBranch(){
        $this->getDeleteDatabade(Rays::find(request()->session()->get('userLogout')), 'Branch');
        Rays::find(request()->input('id'))->delete();
        return back()->with('success', $this->ob[$this->ob['Setting']['Language']]['Branch']['Delete']);
    }
}
