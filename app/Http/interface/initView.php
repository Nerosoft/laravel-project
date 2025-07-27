<?php
namespace App\Http\interface;
interface initView extends initValid{
    public function getTableData();
    public function initView();
}