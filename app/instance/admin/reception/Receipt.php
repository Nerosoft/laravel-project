<?php
namespace App\instance\admin\reception;
use App\instance\share\SearchId;
use App\Models\Rays;
use App\instance\admin\reception\Patent;
class Receipt extends Patent
{
    /**
     * Create a new class instance.
     */
    private $Know;
    private $CurrentOffers;
    private $Test;
    private $Discount;
    private $DelayedMoney;
    private $PaymentDate;
    private $AmountPaid;
    private $PaymentMethod;
    
    private $Subtotal;
    private $TotalDiscount;
    private $Total;
    private $Due;
    private $DueUser;		
    public function __construct($Know, $CurrentOffers, $Test,
    $Discount, $DelayedMoney, $PaymentDate, $AmountPaid, $PaymentMethod, 
    $PatentCode = null, $Avatar = null, $Name = null, $Nationality = null, $NationalId = null, $PassportNo = null,
    $Email = null, $Phone = null, $Phone2 = null, $Gender = null, $LastPeriodDate = null,
    $DateBirth = null, $Address = null, $Contracting = null, $Hours = null,
    $Disease = null)
    {
        parent::__construct($PatentCode, $Avatar, $Name, $Nationality, $NationalId, $PassportNo,
    $Email, $Phone, $Phone2, $Gender, $LastPeriodDate,
    $DateBirth, $Address, $Contracting, $Hours,
    $Disease);
        
        $this->Know = $Know;
        $this->CurrentOffers = $CurrentOffers;
        $this->Test = $Test;
        $this->Discount = $Discount;
        $this->DelayedMoney = $DelayedMoney;
        $this->PaymentDate = $PaymentDate;
        $this->AmountPaid = $AmountPaid;
        $this->PaymentMethod = $PaymentMethod;
        
        $this->Subtotal = array_reduce($this->CurrentOffers != null ? array_merge($this->Test , $this->CurrentOffers) : $this->Test, function ($acc, $item) {
            return $acc + $item->getPrice() ;
        }, 0);
        $this->TotalDiscount = intval($this->Subtotal * ($this->Discount / 100));
        $this->Total = intval($this->Subtotal - $this->TotalDiscount);
        $this->Due = $this->AmountPaid < $this->Total ? $this->Total - $this->AmountPaid : 0;
        $this->DueUser = $this->AmountPaid > $this->Total ? $this->AmountPaid - $this->Total : 0;
    }

    //get all test for set all test when user close model and open once agen
    public function getTestObject(){
        foreach ($this->Test as $key => $value)
        $this->Test[$key] = $value->getObject2();
        return $this->Test;
    }
    //get all offer for set all test when user close model and open once agen
    public function getOfferObject(){
        if($this->CurrentOffers != null)
            foreach ($this->CurrentOffers as $key => $value)
            $this->CurrentOffers[$key] = $value->getObject2();
        return $this->CurrentOffers != null ? $this->CurrentOffers : array();
    }
    public function getObject(){
        foreach ($this->Test as $key => $value)
            $this->Test[$key] = $value->getObject();
        if($this->CurrentOffers != null)
            foreach ($this->CurrentOffers as $key => $value)
                $this->CurrentOffers[$key] = $value->getObject();
        return get_object_vars($this);
    }
    public function getSubtotal(){
        return $this->Subtotal;
    }
    public function getTotalDiscount(){
        return $this->TotalDiscount;
    }
    public function getTotal(){
        return $this->Total;
    }
    public function getDue(){
        return $this->Due;
    }
    public function getDueUser(){
        return $this->DueUser;
    }
    public function getKnowId(){
        return $this->Know;
    }
    public function getKnow(){
        return $this->getValue('Name', $this->Know, 'Knows');
    }
    public function getCurrentOffers(){
        return $this->CurrentOffers != null ? $this->CurrentOffers : array();
    }
    public function getTest(){
        return $this->Test;
    }
    public function getTestPdf(){
        return array_reduce($this->CurrentOffers != null ? array_merge($this->Test , $this->CurrentOffers) : $this->Test, function ($acc, $item) {
            return is_array($acc) ? [...$acc, $item->getObject()] : array($item->getObject());
        }, 0);
    }
    public function getDiscount(){
        return $this->Discount;
    }
    public function getDelayedMoney(){
        return $this->DelayedMoney;
    }
    public function getPaymentDate(){
        return $this->PaymentDate;
    }
    public function getAmountPaid(){
        return $this->AmountPaid;
    }
    public function getPaymentMethodId(){
        return $this->PaymentMethod;
    }
    public function getPaymentMethod(){
        return $this->getValue($this->PaymentMethod, 'PaymentMethodBox');
    }
}
