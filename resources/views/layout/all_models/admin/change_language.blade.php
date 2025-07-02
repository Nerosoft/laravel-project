<div class="modal" id="{{isset($index)?'copyModel'.$index:'createModel'}}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{isset($index)?$lang->title3:$lang->TitleNewLang}}</h5>
                <button type="button" onclick="closeForm('{{isset($index)?'copyModel'.$index:'createModel'}}')" class="btn btn-dark">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route(isset($index)?'language.copy':'lang.createLanguage')}}" method="POST" onsubmit="return validName($(this).find('#lang_name'))">
                <div class="modal-body">
                    @csrf
                    @isset($index)
                    @include('layout.my_id', ['myId'=>$index])
                    @endisset
                    <div class="form-group">
                        <label for="lang_name" class="form-label">{{isset($index)?$lang->label6:$lang->LabelNameLanguage}}</label>
                        <input type="text" name="lang_name" id="lang_name" placeholder='{{isset($index)?$lang->HintCopyLanguage:$lang->hint1}}' class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">{{isset($index)?$lang->button5:$lang->ButtonNewLang}}</button>
                </div>
            </form>
        </div>
    </div>
</div>