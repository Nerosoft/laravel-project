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
                return new AppModel('use delete option', $ob[$ob['Setting']['Language']]['Error'], 'ChangeLanguage', $ob[  isset($ob[request()->input('language-select')]) ? request()->input('language-select') : $ob['Setting']['Language'] ]['Message']['ChangeLanguage'], array_keys($ob[$ob['Setting']['Language']]['AllNamesLanguage']));
            case 'ChangeLanguage_copy':
                return new AppModel('option4', $ob[$ob['Setting']['Language']]['Error'], 'ChangeLanguage', $ob[$ob['Setting']['Language']]['Message']['CopyLanguage'], array_keys($ob[$ob['Setting']['Language']]['AllNamesLanguage']));
            case 'ChangeLanguage_delete':
                return new AppModel('option8', $ob[$ob['Setting']['Language']]['Error'], 'ChangeLanguage', $ob[$ob['Setting']['Language']]['Message']['DeleteLanguage'], array_keys($ob[$ob['Setting']['Language']]['AllNamesLanguage']), $ob['Setting']['Language']);
            default:
                return new AllLanguage($state, $ob);
        }
    }
    public function index($nameLanguage, $id = null){
        if(isset(Rays::find(request()->session()->get('userId'))[$nameLanguage][$id]) || $nameLanguage === 'AllLanguage'){
            //check id is null to call title all language
            $lang = $this->setupLanguage($nameLanguage, $id !== null ? $id : $nameLanguage);
            return view('all_language',[
                'lang'=> $lang,
                'active'=>$nameLanguage !== null ? $nameLanguage : $id,
                'activeItem'=>$id,
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
        $rules = ['word' => ['required', $id !== 'Html' ? 'min:2' : Rule::in(['ltr', 'rtl'])]];        
        $messages =  $id !== 'Html' ? [
            'word.required' => $lang->error1,
            'word.min' => $lang->error2,
        ] : [
            'word.required' => $lang->error1,
            'word.in' => $lang->error2,  
        ];
        $request->validate($rules, $messages);
        $model = Rays::find($request->session()->get('userId'));
        //only menu item
        if(isset($model[$myLang][$id][$name]['Item'][$item]) && $request->input('word') && strlen($request->input('word')) > 2
        ||isset($model[$myLang][$id][$name]) && $item === null && $request->input('word') && strlen($request->input('word')) > 2
        || isset($model[$myLang][$id][$name]) && $id !== 'Menu' && $item === null && $request->input('word') && strlen($request->input('word')) > 2){
            $var1 = $model[$myLang];
            //make array first order importaint
            if($id === 'Menu' && $item === null && is_array($var1[$id][$name]))
                $var1[$id][$name]['Name'] = $request->input('word');
            else if($id === 'Menu' && $item !== null)
                $var1[$id][$name]['Item'][$item] = $request->input('word');
            else
                $var1[$id === $myLang ? $myLang : $id][$name] = $request->input('word');
            //my key of site aut and this key not like my key in database
            //svae data using new object and send my data to constructor and call setValue to save new value and return object                
            $model[$myLang] = $var1;
            $model->save();
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
        return back()->with('success', $lang->successfully1);
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
        foreach ($lang->size1 as $key) {
            $myLang = $model[$key];
            $myLang['AllNamesLanguage'][$newKey] = request()->input('lang_name');
            $model[$key] = $myLang;
        }
        //after add new language name
        $model[$newKey] = $model[request()->input('language-select')];
        $model->save();
        return back()->with('success', $lang->successfully1);
    }
    public function deleteLanguage(){
        $lang = $this->setupLanguage('ChangeLanguage_delete', Rays::find(request()->session()->get('userId')));
        request()->validate([
            'id' =>['required', Rule::in($lang->size1), Rule::notIn([$lang->language, $lang->size1[0], $lang->size1[1]])]
        ], [
            'id.required' => $lang->error3,
            'id.in' => $lang->error4,
            'id.not_in' => $lang->error5,
        ]);
        $model = Rays::find(request()->session()->get('userId'));
        foreach ($lang->size1 as $key) {
            $myLang = $model[$key];
            unset($myLang['AllNamesLanguage'][request()->input('id')]);
            $model[$key] = $myLang;
        }
        unset($model[request()->input('id')]);
        $model->save();
        return back()->with('success', $lang->successfully1);
    }
}
