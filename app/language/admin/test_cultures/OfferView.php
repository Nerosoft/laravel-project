<?php
namespace App\language\admin\test_cultures;
use App\language\admin\test_cultures\TestView;
use App\Models\Rays;
class OfferView extends TestView{
    public function __construct($id, $ob){
        parent::__construct($id, $ob);
        $this->table13 = $ob[$this->language]['Table']['CurrentOffersDisplayPrice'];
        $this->label6 = $ob[$this->language]['Label']['CurrentOffersDisplayPrice'];
        $this->hint4 = $ob[$this->language]['Hint']['CurrentOffersDisplayPrice'];
    }
}