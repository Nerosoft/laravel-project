<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\language\admin\safe_transfers\RejectedTransfers;
use App\language\admin\safe_transfers\TransferToOwner;
use App\language\admin\safe_transfers\AllTransfers;
class SafeTransfersController extends Controller
{
    public function index($id){
        $lang = $this->initLanguage($id);
        if($id === 'RejectedTransfers'){
            return view('admin.safe_transfers.rejected_transfers',[
                'lang'=> $lang,
                'active'=>'SafeTransfers',
                'activeItem'=>'RejectedTransfers'
            ]);
        }
        else if($id === 'TransferToOwner'){
            return view('admin.safe_transfers.transfer_to_owner',[
                'lang'=> $lang,
                'active'=>'SafeTransfers',
                'activeItem'=>'TransferToOwner'
            ]);
        }
        else if($id === 'AllTransfers'){
            return view('admin.safe_transfers.all_transfers',[
                'lang'=> $lang,
                'active'=>'SafeTransfers',
                'activeItem'=>'AllTransfers' 
            ]);
        }else
            abort(404);
    }
    private function initLanguage($id){
        switch ($id) {
            case'RejectedTransfers':        
                return new RejectedTransfers();
            case'TransferToOwner':
                return new TransferToOwner();
            case'AllTransfers':
                return new AllTransfers();
            default :
                return null;
        }
    }
}
