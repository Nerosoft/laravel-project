<?php                                          //LANGUAGE
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\language\AllLanguage;
use App\language\admin\action\AppModel;
use App\language\admin\action\change_language\MyChangeLanguage;
use App\language\admin\action\change_language\CopyLanguage;
use App\language\admin\action\change_language\DeleteLanguage;
use App\language\admin\ChangeLanguage;
use App\Models\Rays;
use Illuminate\Validation\Rule;
class LanguageController extends Controller
{
    const AllLang = 'AllLang';
    public $arr = array();
    public function setupLanguage($state, $ob = null){
        switch ($state) {
            case 'AllLanguage':
                return new AllLanguage($state, $ob);
            case 'edit':
                return new AppModel(false, $ob[$ob['Setting']['Language']]['Error'], 'AllLanguage', $ob[$ob['Setting']['Language']]['Message']['AllLanguageEdit'], null, null, null, null, $ob);
            case 'ChangeLanguage':
                return new ChangeLanguage($state);
            case 'ChangeLanguage_edit':
                return new MyChangeLanguage($ob[$ob['Setting']['Language']]['Error'], 'ChangeLanguage', $ob[$ob['Setting']['Language']]['Message']['ChangeLanguage'], array_keys($ob[$ob['Setting']['Language']][$ob['Setting']['Language']]), $ob['Setting']['Language']);
            case 'ChangeLanguage_copy':
                return new CopyLanguage($ob[$ob['Setting']['Language']]['Error'], 'ChangeLanguage', $ob[$ob['Setting']['Language']]['Message']['CopyLanguage'], array_keys($ob[$ob['Setting']['Language']][$ob['Setting']['Language']]), $ob);
            case 'ChangeLanguage_delete':
                return new DeleteLanguage($ob[$ob['Setting']['Language']]['Error'], 'ChangeLanguage', 
                $ob[$ob['Setting']['Language']]['Message']['DeleteLanguage'],
                array_keys($ob[$ob['Setting']['Language']][$ob['Setting']['Language']]), $ob);
        }
    }
    public function index($nameLanguage, $id = null){
        //my key of site aut and this key not like my key in database
        if(isset(Rays::find(request()->session()->get('userId'))[$nameLanguage][$id!== LanguageController::AllLang ? $id : $nameLanguage]) || $nameLanguage === 'AllLanguage'){
            $lang = $this->setupLanguage('AllLanguage', $id !== null ? $id : $nameLanguage);
            $lang->myMenuApp[$nameLanguage]['active'] = 'my_active';
            if($id !== null){
                $lang->myMenuApp[$nameLanguage]['items'][$id]['active'] = 'my_active';
                $this->getAllMenu($lang->myAllLanguage[$nameLanguage][$nameLanguage][$nameLanguage], $id!== LanguageController::AllLang ? $lang->myAllLanguage[$nameLanguage][$id] : $lang->myAllLanguage[$nameLanguage][$nameLanguage], $nameLanguage, $id, $id !== 'Html' ? null :  $lang->myDirectionOption);
            }else
                foreach ($lang->myAllLanguage as $myKey => $value)
                    foreach ($value as $key => $data)
                        $this->getAllMenu($lang->myAllLanguage[$lang->language][$lang->language][$myKey], $data, $myKey, $key, ($key === 'Html' ? $lang->myAllLanguage[$lang->language]['Direction'] : null));   
            return view('all_language', [
                'lang'=> $lang,
                'table'=> $this->arr,
                'state'=>$id === null
            ]);
        }else if($nameLanguage === 'ChangeLanguage'){
            $lang = $this->setupLanguage($nameLanguage);
            $lang->myMenuApp[$nameLanguage]['active'] = 'my_active';
            return view('admin.change_language',[
                'lang'=>$lang,
                'myRadios'=>$this->setupRadios($lang->myLanguage),
            ]);
        }
        else{
            $lang = $this->setupLanguage('AllLanguage', $id !== null ? $id : $nameLanguage);
            return back()->withErrors($lang->error6);
        }
    }
    public function getAllMenu($allLanguage, $data, $myKey, $id, $direction = null, $myId = null){
        if($id === 'Menu'){//only menu
            foreach ($data as $key => $value)
                if(isset($value['Item'])){
                    array_push($this->arr, array('languageName'=>$allLanguage, 'lang'=>$myKey, 'myName'=>$key, 'id'=>$id, 'name'=>$value['Name']));
                    $this->getAllMenu($allLanguage, $value['Item'], $myKey, $id, null, $key);
                }
                else if(is_array($value))
                    $this->getAllMenu($allLanguage, $value, $myKey, $id);
                else
                    array_push($this->arr, $myId === null ? array('languageName'=>$allLanguage, 'lang'=>$myKey, 'myName'=>$key, 'id'=>$id, 'name'=>$value) : array('languageName'=>$allLanguage, 'lang'=>$myKey, 'myName'=>$myId, 'id'=>$id, 'name'=>$value, 'item'=>$key));  
        }else
            foreach ($data as $key => $value) 
                array_push($this->arr, $direction === null ? array('languageName'=>$allLanguage, 'lang'=>$myKey, 'myName'=>$key, 'id'=>$id, 'name'=>$value) : array('languageName'=>$allLanguage, 'lang'=>$myKey, 'myName'=>$key, 'id'=>$id, 'name'=>$value, 'direction'=>$direction));
    }
    public function editAllLanguage(Request $request, $myLang, $id, $name, $item = null){
        //allLang and menu
        $lang = $this->setupLanguage('edit', Rays::find(request()->session()->get('userId')));
        //check id error and html and button and message is exist in language
        // check value using database
        if($request->input('dir') === 'ltr' && isset($lang->myAllLanguage[$myLang][$id]) 
        || $request->input('dir') ==='rtl' && isset($lang->myAllLanguage[$myLang][$id])
        //my key of site aut and this key not like my key in database
        || isset($lang->myAllLanguage[$myLang][$id !==  LanguageController::AllLang ? $id : $myLang]) && $request->input('word') && strlen($request->input('word')) > 2){
            //check name value is exist
            if(//my key of site aut and this key not like my key in database
                isset($lang->myAllLanguage[$myLang][$id !== LanguageController::AllLang ? $id : $myLang][$name]['Item'][$item]) ||
                isset($lang->myAllLanguage[$myLang][$id !== LanguageController::AllLang ? $id : $myLang][$name])){
                //use interface to save value using function
                $value = Rays::find($request->session()->get('userId'));
                $var1 = $value[$myLang];
                //make array first order importaint
                if($id === 'Menu' && $item === null && is_array($var1[$id][$name]))
                    $var1[$id][$name]['Name'] = $request->input('word');
                else if($id === 'Menu' && $item !== null)
                    $var1[$id][$name]['Item'][$item] = $request->input('word');
                else
                    $var1[$id ===  LanguageController::AllLang ? $myLang : $id][$name] = $id !== 'Html' ? $request->input('word') : $request->input('dir');
                //my key of site aut and this key not like my key in database
                //svae data using new object and send my data to constructor and call setValue to save new value and return object                
                $value[$myLang] = $var1;
                $value->save();
                return back()->with('success', $lang->successfully1);
            }
            // show error if name of value not exist in language
            return back()->withInput()->withErrors($lang->error3); 
            //my key of site aut and this key not like my key in database
        }else if(isset($lang->myAllLanguage[$myLang][$id !==  LanguageController::AllLang ? $id : $myLang])){//show error direction and text
            $rules = $id !== 'Html' ? ['word' => ['required', 'min:2']] : ['dir' =>['required', Rule::in(['ltr', 'rtl'])]];        
            $messages = $id !== 'Html' ? [
                'word.required' => $lang->error1,
                'word.min' => $lang->error2,
            ] :  [
                'dir.required' => $lang->error4,
                'dir.in' => $lang->error5,  
            ];
            $request->validate($rules, $messages);
        }else
            // show error 
            return back()->withInput()->withErrors($lang->error3); 
       
    }

    public function changeLanguage(){
        $lang = $this->setupLanguage('ChangeLanguage_edit', Rays::find(request()->session()->get('userId')));
        request()->validate([
            'language-select' =>['required', Rule::in($lang->size1)]
        ], [
            'language-select.required' => $lang->error1,
            'language-select.in' => $lang->error2
        ]);
        $model = Rays::find(request()->session()->get('userId'));
        $setting = $model['Setting'];
        $setting['Language'] = request()->input('language-select');
        $model['Setting'] = $setting;
        $model->save();
        return back()->with('success', request()->input('language-select') != $lang->language ? Rays::find(request()->session()->get('userId'))[request()->input('language-select')]['Message']['ChangeLanguage']: $lang->successfully1);
    }
    public function copyLanguage(){
        $lang = $this->setupLanguage('ChangeLanguage_copy', Rays::find(request()->session()->get('userId')));
        request()->validate([
            'language-select' =>['required', Rule::in($lang->size1)]
        ], [
            'language-select.required' => $lang->error1,
            'language-select.in' => $lang->error2
        ]);
        $newKey = $this->generateUniqueIdentifier();
        $model = Rays::find(request()->session()->get('userId'));
        foreach ($lang->myAllLanguage as $key => $value) {
            $myLang = $model[$key];
            $myLang['MyNameLanguage'][$newKey] = $lang->myAllLanguage[$key][$key][request()->input('language-select')];
            $myLang[$key][$newKey] = $lang->myAllLanguage[$key][$key][request()->input('language-select')];
            $model[$key] = $myLang;
        }
        $myNewLang = $model[request()->input('language-select')];
        $myLang = $myNewLang[request()->input('language-select')];
        unset($myNewLang[request()->input('language-select')]);
        $myNewLang[$newKey] =  $myLang;
        $model[$newKey] = $myNewLang;
        $model->save();
        return back()->with('success', $lang->successfully1);
    }
    public function deleteLanguage(){
        $lang = $this->setupLanguage('ChangeLanguage_delete', Rays::find(request()->session()->get('userId')));
        request()->validate([
            'id' =>['required', Rule::in($lang->size1), Rule::notIn($lang->language)]
        ], [
            'id.required' => $lang->error1,
            'id.in' => $lang->error2,
            'id.not_in' => $lang->error3,
        ]);
        $model = Rays::find(request()->session()->get('userId'));
        foreach ($lang->myAllLanguage as $key => $value) {
            $myLang = $model[$key];
            unset($myLang['MyNameLanguage'][request()->input('id')]);
            unset($myLang[$key][request()->input('id')]);
            $model[$key] = $myLang;
        }
        unset($model[request()->input('id')]);
        $model->save();
        return back()->with('success', $lang->successfully1);
    }
}
