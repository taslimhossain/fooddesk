
  <div class="form-group {{ $errors->has('banner') ? 'has-error' : ''}}">
    <label for="banner" class="control-label">{{ __('m.banner') }}</label>
    <input id="banner" type="file" class="" name="banner_img">
    @if($setting->banner)
    <img id="banner_img1" style="max-width:200px" src="{{URL::to('/')}}/images/{{$setting->banner}}"> <button type="button" onclick="removeBanner(1,this)" class="btn btn-danger">&times
        </button>
        @endif
        {!! $errors->first('banner', '
    <p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('banner2') ? 'has-error' : ''}}">
    <label for="banner" class="control-label">{{ __('m.banner') }}2</label>
    <input type="file" class="" name="banner_img2">
    @if($setting->banner2)
    <img id="banner_img2" style="max-width:200px" src="{{URL::to('/')}}/images/{{$setting->banner2}}"> <button type="button" onclick="removeBanner(2,this)" class="btn btn-danger">&times
    </button>
    @endif
    {!! $errors->first('banner2', '
    <p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('banner3') ? 'has-error' : ''}}">
    <label for="banner" class="control-label">{{ __('m.banner') }}3</label>
    <input type="file" class="" name="banner_img3">
    @if($setting->banner3)
    <img id="banner_img3" style="max-width:200px" src="{{URL::to('/')}}/images/{{$setting->banner3}}"><button type="button" onclick="removeBanner(3,this)" class="btn btn-danger">&times
    </button>
    @endif
    {!! $errors->first('banner3', '
    <p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('banner4') ? 'has-error' : ''}}">
    <label for="banner" class="control-label">{{ __('m.banner') }}4</label>
    <input type="file" class="" name="banner_img4">
    @if($setting->banner4)
    <img id="banner_img4" style="max-width:200px" src="{{URL::to('/')}}/images/{{$setting->banner4}}"><button type="button" onclick="removeBanner(4,this)" class="btn btn-danger">&times
    </button>
    @endif
    {!! $errors->first('banner4', '
    <p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('banner5') ? 'has-error' : ''}}">
            <label for="banner" class="control-label">{{ __('m.banner') }}5</label>
            <input type="file" class="" name="banner_img5">
            @if($setting->banner5)
            <img id="banner_img5" style="max-width:200px" src="{{URL::to('/')}}/images/{{$setting->banner5}}"><button type="button" onclick="removeBanner(5,this)" class="btn btn-danger">&times
            </button>
            @endif
            {!! $errors->first('banner5', '
            <p class="help-block">:message</p>') !!}
    </div>
<script>
    function removeBanner(id,el){
        el.remove();
        document.getElementById("banner_img"+id).remove();
        var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            toastr.success("Banner Removed");
        }
    };
    xhttp.open("GET", "remove-banner?id="+id, true);
    xhttp.send();
    }
</script>
<div class="form-group {{ $errors->has('offline') ? 'has-error' : ''}}">
    <label for="offline" class="control-label">{{ __('m.putOffline') }}</label>
    <select class="form-control" name="offline">
        <option value="1" {{$setting->offline=="1"?"selected":""}}>{{ __('m.yes') }}</option>
        <option value="0" {{$setting->offline=="0"?"selected":""}}>{{ __('m.no') }}</option>

    </select> 
</div>

<div class="form-group {{ $errors->has('offline_message') ? 'has-error' : ''}}">
    <label for="address" class="control-label">{{ __('m.offlineMessage') }}</label>
    <textarea class="offline_message textarea form-control" name="offline_message"></textarea> {!! $errors->first('offline_message', '
    <p class="help-block">:message</p>') !!}
</div>







<div class="form-group">
    <input class="btn btn-primary my-2" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
@section('script')

<script>
    $(function() {
        // Summernote
        $('.textarea').summernote()
        $('.ok_mail').summernote('code', `{!! $setting->ok_mail !!}`);
        $('.success_mail').summernote('code', `{!! $setting->success_mail !!}`);
        $('.hold_mail').summernote('code', `{!! $setting->hold_mail !!}`);
        $('.delivery_complete').summernote('code', `{!! $setting->delivery_complete !!}`);
        $('.collection_complete').summernote('code', `{!! $setting->collection_complete !!}`);
        $('.offline_message').summernote('code', `{!! $setting->offline_message !!}`);
        $('.homepage_notice').summernote('code', `{!! $setting->homepage_notice !!}`);
        $('.privacy').summernote('code', `{!! $setting->privacy !!}`);
        $('.terms').summernote('code', `{!! $setting->terms !!}`);
        $('.payments').summernote('code', `{!! $setting->payments !!}`);
        $('.copyright').summernote('code', `{!! $setting->copyright !!}`);
        $('.signup_message').summernote('code', `{!! $setting->signup_message !!}`);
        $('.order_admin_body').summernote('code', `{!! $setting->order_admin_body !!}`);
        
        $('.order_place_body').summernote('code', `{!! $setting->order_place_body !!}`);
        $('.follow_us').summernote('code', `{!! $setting->follow_us !!}`);
    })
</script>
@endsection