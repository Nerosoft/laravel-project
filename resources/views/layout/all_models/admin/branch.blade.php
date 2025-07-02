<!-- Modal -->
<div class="modal fade" id="{{isset($index) ? 'editModel'.$index : 'createModel'}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="SettingLanguage">{{isset($index) ? $lang->title3 : $lang->title2}}</h5>
        <button type="button" onclick="closeForm('{{isset($index) ? "editModel".$index : "createModel"}}')" class="btn btn-dark">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="{{isset($index) ? 'editForm'.$index : 'createForm'}}" action="{{isset($index) ? route('editBranchRays') : route('addBranchRays')}}" method="POST" onsubmit="return validateBranche($(this).find('#brance-rays-name'), $(this).find('#brance-rays-phone'), $(this).find('#brance-rays-country'), $(this).find('#brance-rays-governments'), $(this).find('#brance-rays-city'), $(this).find('#brance-rays-street'), $(this).find('#brance-rays-building'), $(this).find('#brance-rays-address'), $(this).find('#brance-rays-follow'))">
            @csrf
            @isset($index)
                @include('layout.my_id', ['myId'=>$index])
            @endisset
                <div class="container">
                    <div class="row">
                        <div class="col-lg-auto pt-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text bi bi-hospital input-icon"></div>
                                </div>
                                <input id="brance-rays-name" type="tel" class="form-control" name="brance_rays_name" value="{{isset($index) ? $branch->getName() : ''}}" placeholder="{{$lang->hint1}}">
                            </div>
                        </div>
                        <div class="col-lg-auto pt-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text bi bi-telephone input-icon"></div>
                                </div>
                                <input id="brance-rays-phone" type="text" class="form-control" name="brance_rays_phone" value="{{isset($index) ? $branch->getPhone() : ''}}" placeholder="{{ $lang->hint2 }}">
                            </div>
                        </div>
                        <div class="col-lg-auto pt-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bi bi-geo-alt input-icon"></div>
                                </div>
                                    <input id="brance-rays-country" type="text" class="form-control" name="brance_rays_country" value="{{isset($index) ? $branch->getCountry() : ''}}" placeholder="{{ $lang->hint3 }}">
                            </div>
                        </div>
                        <div class="col-lg-auto pt-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text bi bi-geo-alt input-icon"></div>
                                </div>
                                <input id="brance-rays-governments" type="text" class="form-control" name="brance_rays_governments" value="{{isset($index) ? $branch->getGovernments() : ''}}" placeholder="{{ $lang->hint4 }}">
                            </div>
                        </div>
                        <div class="col-lg-auto pt-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text bi bi-geo-alt input-icon"></div>
                                </div>
                                <input id="brance-rays-city" type="text" class="form-control" name="brance_rays_city" value="{{isset($index) ? $branch->getCity() : ''}}" placeholder="{{ $lang->hint5 }}">
                            </div>
                        </div>
                        <div class="col-lg-auto pt-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text bi bi-geo-alt input-icon"></div>
                                </div>
                                <input id="brance-rays-street" type="text" class="form-control" name="brance_rays_street" value="{{isset($index) ? $branch->getStreet() : ''}}" placeholder="{{ $lang->hint6 }}">
                            </div>
                        </div>
                        <div class="col-lg-auto pt-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text bi bi-geo-alt input-icon"></div>
                                </div>
                                <input id="brance-rays-building" type="text" class="form-control" name="brance_rays_building" value="{{isset($index) ? $branch->getBuilding() : ''}}" placeholder="{{ $lang->hint7 }}">
                            </div>
                        </div>
                        <div class="col-lg-auto pt-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text bi bi-geo-alt input-icon"></div>
                                </div>
                                <input id="brance-rays-address" type="text" class="form-control" name="brance_rays_address" value="{{isset($index) ? $branch->getAddress() : ''}}" placeholder="{{ $lang->hint8 }}">
                            </div>
                        </div>
                        <div class="col-lg-auto pt-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bi bi-geo-alt input-icon"></div>
                                </div>
                                <select class="form-select" id="brance-rays-follow" name="brance_rays_follow"  aria-label="Default select example">
                                    <option selected disabled>{{ $lang->selectBox1 }}</option>
                                    @foreach($lang->branchInputOutput as $key=>$inpBranch)
                                    <option {{isset($index) ? ($branch->getFollowId() === $inpBranch ? 'selected' : '') : ''}} value="{{ $key}}">{{ $inpBranch }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
                    
                </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" form="{{isset($index) ? 'editForm'.$index : 'createForm'}}" class="btn btn-primary">{{isset($index) ? $lang->button3 : $lang->button2}}</button>
      </div>
    </div>
  </div>
</div>