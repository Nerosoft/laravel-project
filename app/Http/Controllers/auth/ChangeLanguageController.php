<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Cookie;
use App\Models\Rays;

class ChangeLanguageController extends Controller
{
    public function __construct(){
        $ob = Rays::find(request()->input('userId'))?Rays::find(request()->input('userId')):Rays::first();
        request()->validate([
            'mylanguage' => ['required', Rule::in(array_keys($ob[$ob['Setting']['Language']]['AllNamesLanguage']))]
        ], [
            'mylanguage.required' => $ob[$ob['Setting']['Language']]['Error']['UserLanguageRequired'], 
            'mylanguage.in' =>$ob[$ob['Setting']['Language']]['Error']['UserLanguageInvalid']
        ]);
        Cookie::queue(request()->input('userId'), serialize(request()->input('mylanguage')),2628000);
        $this->successfully1 = $ob[request()->input('mylanguage')]['Message']['UserLanguage'].$ob[request()->input('mylanguage')]['AllNamesLanguage'][request()->input('mylanguage')];
    }
    public function changeLanguage(){
        return back()->with('success', $this->successfully1);
    }
}
