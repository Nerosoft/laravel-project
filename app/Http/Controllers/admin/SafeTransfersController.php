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
            $view = view('admin.safe_transfers.rejected_transfers',[
                'lang'=> $lang,
            ]);
        }
        else if($id === 'TransferToOwner'){
            $view = view('admin.safe_transfers.transfer_to_owner',[
                'lang'=> $lang,
            ]);
        }
        else if($id === 'AllTransfers'){
            $view = view('admin.safe_transfers.all_transfers',[
                'lang'=> $lang, 
            ]);
        }else
            abort(404);
        $lang->myMenuApp['SafeTransfers']['active'] = 'my_active';
        $lang->myMenuApp['SafeTransfers']['items'][$id]['active'] = 'my_active';
        return $view;
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
