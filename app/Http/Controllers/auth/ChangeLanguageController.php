<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Cookie;
use App\Models\Rays;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class ChangeLanguageController extends Controller
{
    public function __construct(){
        $ob = Rays::find(request()->input('id'))?Rays::find(request()->input('id')):Rays::first();
        if(Route::currentRouteName() === 'branchMain' && request()->route('id') === request()->session()->get('userId')){
            $this->successfully1 = $ob[$ob['Setting']['Language']]['Branch']['Active'];
        }else if(Route::currentRouteName() === 'branchMain' && request()->route('id') === request()->session()->get('userLogout')){
            request()->session()->put('userId', request()->session()->get('userLogout'));
            $this->successfully1 = Rays::find(request()->session()->get('userId'))[Rays::find(request()->session()->get('userId'))['Setting']['Language']]['Branch']['BranchesChange'].Rays::find(request()->session()->get('userId'))[Rays::find(request()->session()->get('userId'))['Setting']['Language']]['AppSettingAdmin']['BranchMain'];
        }else if(Route::currentRouteName() === 'branchMain' && Rays::find(request()->route('id'))){
            $myBranch = (array)Rays::find(request()->session()->get('userLogout'))['Branch'];
            Validator::make(['id'=>request()->route('id')], [
                'id'=>['required', Rule::in(array_keys($myBranch))]
            ], [
                'id.required' => $ob[$ob['Setting']['Language']]['Branch']['IdIsReq'],
                'id.in' => $ob[$ob['Setting']['Language']]['Branch']['IdIsInv'],
            ])->validate();
            request()->session()->put('userId', request()->route('id'));
            $this->successfully1 = Rays::find(request()->route('id'))[Rays::find(request()->route('id'))['Setting']['Language']]['Branch']['BranchesChange'].' '.$myBranch[request()->route('id')]['Name'];
        }else{
            request()->validate([
                'mylanguage' => ['required', Rule::in(array_keys($ob[$ob['Setting']['Language']]['AllNamesLanguage']))]
            ], [
                'mylanguage.required' => $ob[$ob['Setting']['Language']]['ChangeLanguage']['ChangeLanguageRequired'], 
                'mylanguage.in' =>$ob[$ob['Setting']['Language']]['ChangeLanguage']['ChangeLanguageInvalid']
            ]);
            Cookie::queue(request()->input('id'), serialize(request()->input('mylanguage')),2628000);
            $this->successfully1 = $ob[request()->input('mylanguage')]['ChangeLanguage']['ChangeLang'].$ob[request()->input('mylanguage')]['AllNamesLanguage'][request()->input('mylanguage')];
        }
    }
    public function action(){
        return back()->with('success', $this->successfully1);
    }
}
