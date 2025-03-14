<?php
namespace App\language\admin\test_cultures;
use App\instance\admin\test_cultures\MyCurrentOffers;
use App\language\admin\test_cultures\TestView;
use App\Models\Rays;
class OfferView extends TestView{
    public function __construct($id){
        $ob = Rays::find(request()->session()->get('userId'));
        parent::__construct($id, $ob);
        $this->table13 = $ob[$this->language]['Table']['CurrentOffersDisplayPrice'];
        $this->label6 = $ob[$this->language]['Label']['CurrentOffersDisplayPrice'];
        $this->hint4 = $ob[$this->language]['Hint']['CurrentOffersDisplayPrice'];
        if(isset($ob['CurrentOffers'])){
            foreach ($ob['CurrentOffers'] as $key => $currentOffers)
                $this->arr1[$key] = new MyCurrentOffers($currentOffers['Name'], $currentOffers['Shortcut'], $currentOffers['Price'], $currentOffers['DisplayPrice'], $currentOffers['State']);
        }
    }
}