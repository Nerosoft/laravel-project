@include('layout.my_id', ['myId'=>$lang->RaysId])
<h4>{{$lang->help}}</h4>
<div class="form-group">
    <label for="email">{{$lang->label1}}</label>
    <input type="text" class="form-control" id="email" name="email"
        value="abdullah@rays.com" placeholder="{{$lang->hint1}}">
</div>
<div class="form-group">
    <label for="password">{{$lang->label2}}</label>
    <input type="password" class="form-control" value="12345678" id="password" name="password"
        placeholder="{{$lang->hint2}}">
</div>