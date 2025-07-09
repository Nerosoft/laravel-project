<?php
namespace App\Http\Controllers;
use App\Models\Rays;
use Illuminate\Validation\Rule;
class DeleteController extends Controller
{
    public function __construct(){

        $ob = Rays::find(request()->session()->get('userId'));
        if(request()->input('id') === request()->session()->get('userId') && request()->route('id') === 'Branch' && (Rays::find(request()->session()->get('userLogout'))[request()->route('id')])){
            $mainModel = Rays::find(request()->session()->get('userLogout'));
            request()->validate(['id' => ['required', Rule::in(array_keys($mainModel[request()->route('id')]))],
            ], [
                'id.required'=>$ob[$ob['Setting']['Language']][request()->route('id')]['IdIsReq'],
                'id.in'=>$ob[$ob['Setting']['Language']][request()->route('id')]['IdIsInv'],
            ]);
            $this->getDeleteDatabade($mainModel, request()->route('id'));
            request()->session()->put('userId', request()->session()->get('userLogout'));
            Rays::find(request()->input('id'))->delete();
            $this->successfully1 = $ob[$ob['Setting']['Language']][request()->route('id')]['Delete'];
        }
        //main branch
        else if(request()->route('id') === 'Branch' && $ob[request()->route('id')]){
            request()->validate(['id' => ['required', Rule::in(array_keys($ob[request()->route('id')]))],
            ], [
                'id.required'=>$ob[$ob['Setting']['Language']][request()->route('id')]['IdIsReq'],
                'id.in'=>$ob[$ob['Setting']['Language']][request()->route('id')]['IdIsInv'],
            ]);
            $this->getDeleteDatabade($ob, request()->route('id'));
            Rays::find(request()->input('id'))->delete();
            $this->successfully1 = $ob[$ob['Setting']['Language']][request()->route('id')]['Delete'];
            //all branch
        }else if(request()->route('id') === 'Branch' && (Rays::find(request()->session()->get('userLogout'))[request()->route('id')])){
            $mainModel = Rays::find(request()->session()->get('userLogout'));
            request()->validate(['id' => ['required', Rule::in(array_keys($mainModel[request()->route('id')]))],
            ], [
                'id.required'=>$ob[$ob['Setting']['Language']][request()->route('id')]['IdIsReq'],
                'id.in'=>$ob[$ob['Setting']['Language']][request()->route('id')]['IdIsInv'],
            ]);
            $this->getDeleteDatabade($mainModel, request()->route('id'));
            Rays::find(request()->input('id'))->delete();
            $this->successfully1 = $ob[$ob['Setting']['Language']][request()->route('id')]['Delete'];
        }else if($ob[request()->route('id')]){
            request()->validate(['id' => ['required', Rule::in(array_keys($ob[request()->route('id')]))],
            ], [
                'id.required'=>$ob[$ob['Setting']['Language']][request()->route('id')]['IdIsReq'],
                'id.in'=>$ob[$ob['Setting']['Language']][request()->route('id')]['IdIsInv'],
            ]);
            $this->getDeleteDatabade($ob, request()->route('id'));
            $this->successfully1 = $ob[$ob['Setting']['Language']][request()->route('id')]['Delete'];
        }else
            $this->successfully1 = $ob[$ob['Setting']['Language']]['AppSettingAdmin']['MessageError'];
    }
    public function action($id){
        return back()->with('success', $this->successfully1);
    }
    private function getDeleteDatabade($model, $item){
        if(count($model[$item]) === 1)
            unset($model[$item]);
        else{
            $arr = $model[$item];
            unset($arr[request()->input('id')]);
            $model[$item] = $arr;
        }
        $model->save();
    }
}