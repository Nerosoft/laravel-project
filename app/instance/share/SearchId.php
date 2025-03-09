<?php
namespace App\instance\share;
use App\Models\Rays;
class SearchId
{
    protected function getValue($key, $nameObj, $lang = null){
        $ob = Rays::find(request()->session()->get('userId'));
        return isset($ob[$lang !== null ? $lang : $ob['Setting']['Language']][$nameObj][$key]) ? $ob[$lang !== null ? $lang : $ob['Setting']['Language']][$nameObj][$key] : '';
    }
}
