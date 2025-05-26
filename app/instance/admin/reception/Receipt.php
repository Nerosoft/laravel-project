<?php
namespace App\instance\admin\reception;
use App\Models\Rays;
use App\instance\admin\reception\Patent;
use App\instance\admin\test_cultures\Test;

class Receipt extends Patent
{
    /**
     * Create a new class instance.
     */
    private $Know;
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
    public function __construct($Know, $Test,
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
        $this->Test = $Test;
        $this->Discount = $Discount;
        $this->DelayedMoney = $DelayedMoney;
        $this->PaymentDate = $PaymentDate;
        $this->AmountPaid = $AmountPaid;
        $this->PaymentMethod = $PaymentMethod;
        
        $this->Subtotal = array_reduce($this->Test, function ($acc, $item) {
            return $acc + $item->getPrice() ;
        }, 0);
        $this->TotalDiscount = intval($this->Subtotal * ($this->Discount / 100));
        $this->Total = intval($this->Subtotal - $this->TotalDiscount);
        $this->Due = $this->AmountPaid < $this->Total ? $this->Total - $this->AmountPaid : 0;
        $this->DueUser = $this->AmountPaid > $this->Total ? $this->AmountPaid - $this->Total : 0;
    }

    //get all test for set all test when user close model and open once agen
    public function getTestObject(){
        $myTests = array();
        foreach ($this->Test as $key => $value)
            $myTests[$key] = $value->getObject();
        return $myTests;
    }
    public function getObject(){
        foreach ($this->Test as $key => $value)
            $this->Test[$key] = $value->getObject();
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
    public function getTest(){
        return $this->Test;
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
    public static function fromArray2($receipt, $patient, $MyKnows, $TestBox, $paymentMethod): array {
        $MyReceipt = array();
        foreach ($receipt as $key => $value)
            $MyReceipt[$key] = isset($patient[$value['PatentCode']]) ? new Receipt(
            isset($MyKnows[$value['Know']]) ? $MyKnows[$value['Know']]->getName():null,
            Test::fromArray($value['Test'], $TestBox),
            $value['Discount'],
            $value['DelayedMoney'],
            $value['PaymentDate'],
            $value['AmountPaid'],
            $paymentMethod[$value['PaymentMethod']],
            $patient[$value['PatentCode']]->getPatentCode(),
            $patient[$value['PatentCode']]->getAvatar(),
            $patient[$value['PatentCode']]->getName(), 
            $patient[$value['PatentCode']]->getNationalityId(),
            $patient[$value['PatentCode']]->getNationalId(),
            $patient[$value['PatentCode']]->getPassportNo(),
            $patient[$value['PatentCode']]->getEmail(),
            $patient[$value['PatentCode']]->getPhone(), 
            $patient[$value['PatentCode']]->getPhone2(),
            $patient[$value['PatentCode']]->getGenderId(),
            $patient[$value['PatentCode']]->getLastPeriodDate(),
            $patient[$value['PatentCode']]->getDateBirth(), 
            $patient[$value['PatentCode']]->getAddress(),
            $patient[$value['PatentCode']]->getContractingId(),
            $patient[$value['PatentCode']]->getHours(),
            $patient[$value['PatentCode']]->getDiseaseId()): new Receipt(
            isset($MyKnows[$value['Know']]) ? $MyKnows[$value['Know']]->getName():null,
            Test::fromArray($value['Test'], $TestBox),
            $value['Discount'],
            $value['DelayedMoney'],
            $value['PaymentDate'],
            $value['AmountPaid'],
            $paymentMethod[$value['PaymentMethod']],);

        return $MyReceipt;
    }

    
}
