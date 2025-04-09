<?php                                          //LANGUAGE
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\language\AllLanguage;
use App\language\admin\action\AppModel;
use App\language\admin\ChangeLanguage;
use App\Models\Rays;
use Illuminate\Validation\Rule;
class LanguageController extends Controller
{
    public function setupLanguage($state, $ob = null){
        switch ($state) {
            case 'edit':
                return new AppModel('option1', $ob[$ob['Setting']['Language']]['Error'], 'AllLanguage', $ob[$ob['Setting']['Language']]['Message']['AllLanguageEdit'], null, null, null, null, $ob);
            case 'ChangeLanguage':
                return new ChangeLanguage($state);
            case 'ChangeLanguage_edit':
                return new AppModel('option7', $ob[$ob['Setting']['Language']]['Error'], 'ChangeLanguage', $ob[$ob['Setting']['Language']]['Message']['ChangeLanguage'], array_keys($ob[$ob['Setting']['Language']]['AllNamesLanguage']), $ob['Setting']['Language']);
            case 'ChangeLanguage_copy':
                return new AppModel('option8', $ob[$ob['Setting']['Language']]['Error'], 'ChangeLanguage', $ob[$ob['Setting']['Language']]['Message']['CopyLanguage'], array_keys($ob[$ob['Setting']['Language']]['AllNamesLanguage']), array_keys($ob[$ob['Setting']['Language']]['AllNamesLanguage']));
            case 'ChangeLanguage_delete':
                return new AppModel('option9', $ob[$ob['Setting']['Language']]['Error'], 'ChangeLanguage', $ob[$ob['Setting']['Language']]['Message']['DeleteLanguage'], array_keys($ob[$ob['Setting']['Language']]['AllNamesLanguage']), array_keys($ob[$ob['Setting']['Language']]['AllNamesLanguage']), $ob['Setting']['Language']);
            default:
                return new AllLanguage($state, $ob);
        }
    }
    public function index($nameLanguage, $id = null){
        if(isset(Rays::find(request()->session()->get('userId'))[$nameLanguage][$id]) || $nameLanguage === 'AllLanguage'){
            //check id is null to call title all language
            $lang = $this->setupLanguage($nameLanguage, $id !== null ? $id : $nameLanguage);
            return view('all_language', [
                'lang'=> $lang,
                'active'=>$nameLanguage !== null ? $nameLanguage : $id,
                'activeItem'=>$id,
                'state'=>$id === null,
                'logOut'=>route('admin.logout')
            ]);
        }else if($nameLanguage === 'ChangeLanguage'){
            $lang = $this->setupLanguage($nameLanguage);
            return view('admin.change_language',[
                'lang'=>$lang,
                'active'=>'ChangeLanguage',
                'myRadios'=>$this->setupRadios($lang->myLanguage),
                'logOut'=>route('admin.logout')
            ]);
        }
        else
            abort(404);
    }
    public function editAllLanguage(Request $request, $myLang, $id, $name, $item = null){
        $lang = $this->setupLanguage('edit', Rays::find(request()->session()->get('userId')));
        $rules = $id !== 'Html' ? ['word' => ['required', 'min:2']] : ['dir' =>['required', Rule::in(['ltr', 'rtl'])]];        
        $messages = $id !== 'Html' ? [
            'word.required' => $lang->error1,
            'word.min' => $lang->error2,
        ] :  [
            'dir.required' => $lang->error4,
            'dir.in' => $lang->error5,  
        ];
        $request->validate($rules, $messages);
        if($request->input('dir') === 'ltr' && isset($lang->myAllLanguage[$myLang][$id][$name]) && $item === null 
        || $request->input('dir') ==='rtl' && isset($lang->myAllLanguage[$myLang][$id][$name]) && $item === null
        //only menu item
        || isset($lang->myAllLanguage[$myLang][$id][$name]['Item'][$item]) && $request->input('word') && strlen($request->input('word')) > 2
        ||isset($lang->myAllLanguage[$myLang][$id][$name]) && $item === null && $request->input('word') && strlen($request->input('word')) > 2
        || isset($lang->myAllLanguage[$myLang][$id][$name]) && $id !== 'Menu' && $item === null && $request->input('word') && strlen($request->input('word')) > 2){
            $value = Rays::find($request->session()->get('userId'));
            $var1 = $value[$myLang];
            //make array first order importaint
            if($id === 'Menu' && $item === null && is_array($var1[$id][$name]))
                $var1[$id][$name]['Name'] = $request->input('word');
            else if($id === 'Menu' && $item !== null)
                $var1[$id][$name]['Item'][$item] = $request->input('word');
            else
                $var1[$id === $myLang ? $myLang : $id][$name] = $id !== 'Html' ? $request->input('word') : $request->input('dir');
            //my key of site aut and this key not like my key in database
            //svae data using new object and send my data to constructor and call setValue to save new value and return object                
            $value[$myLang] = $var1;
            $value->save();
            return back()->with('success', $lang->successfully1);             
        }else
            // show error 
            return back()->withInput()->withErrors($lang->error3); 

    }

    public function changeLanguage(){
        $lang = $this->setupLanguage('ChangeLanguage_edit', Rays::find(request()->session()->get('userId')));
        request()->validate([
            'language-select' =>['required', Rule::in($lang->size1)]
        ], [
            'language-select.required' => $lang->error3,
            'language-select.in' => $lang->error4
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
            'language-select' =>['required', Rule::in($lang->size1)],
            'lang_name' =>['required', 'min:3']
        ], [
            'lang_name.required' => $lang->error1,
            'lang_name.min' => $lang->error2,
            'language-select.required' => $lang->error3,
            'language-select.in' => $lang->error4
        ]);
        $newKey = $this->generateUniqueIdentifier();
        $model = Rays::find(request()->session()->get('userId'));
        foreach ($lang->myAllLanguage as $key) {
            $myLang = $model[$key];
            $myLang['MyNameLanguage'][$newKey] = request()->input('lang_name');
            $myLang['AllNamesLanguage'][$newKey] = request()->input('lang_name');
            $model[$key] = $myLang;
        }
        $model[$newKey] = $model[request()->input('language-select')];
        $model->save();
        return back()->with('success', $lang->successfully1);
    }
    public function deleteLanguage(){
        $lang = $this->setupLanguage('ChangeLanguage_delete', Rays::find(request()->session()->get('userId')));
        request()->validate([
            'id' =>['required', Rule::in($lang->size1), Rule::notIn($lang->language)]
        ], [
            'id.required' => $lang->error3,
            'id.in' => $lang->error4,
            'id.not_in' => $lang->error5,
        ]);
        $model = Rays::find(request()->session()->get('userId'));
        foreach ($lang->myAllLanguage as $key) {
            $myLang = $model[$key];
            unset($myLang['MyNameLanguage'][request()->input('id')]);
            unset($myLang['AllNamesLanguage'][request()->input('id')]);
            $model[$key] = $myLang;
        }
        unset($model[request()->input('id')]);
        $model->save();
        return back()->with('success', $lang->successfully1);
    }
}
