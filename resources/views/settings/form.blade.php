<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="form-group {{ $errors->has('company_id') ? 'has-error' : ''}}">
            <label for="company_id" class="control-label">{{ __('m.companyId') }}</label>
            <input type="text" name="company_id" value="{{ isset($setting->company_id) ? $setting->company_id : ''}}"
                   class="form-control"> {!! $errors->first('company_id', '
            <p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('api_key') ? 'has-error' : ''}}">
            <label for="api_key" class="control-label">{{ __('m.apiKey') }}</label>
            <input type="text" name="api_key" value="{{ isset($setting->api_key) ? $setting->api_key : ''}}"
                   class="form-control"> {!! $errors->first('api_key', '
            <p class="help-block">:message</p>') !!}
        </div>

    </div>
    <div class="tab-pane fade" id="theme" role="tabpanel" aria-labelledby="theme-tab">
        <div class="form-group {{ $errors->has('logo') ? 'has-error' : ''}}">
            <label for="logo" class="control-label">{{ __('m.logo') }}</label>
            <input type="file" class="" name="logo_img">
            @if($setting->logo)
            <img style="max-width:200px" src="{{URL::to('/')}}/images/{{$setting->logo}}">

            <button type="button" onclick="removeLogo('logo',this)" class="btn btn-danger">&times</button>
            @endif
            {!! $errors->first('logo', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('sticky_logo') ? 'has-error' : ''}}">
            <label for="sticky_logo" class="control-label">{{ __('m.stickyLogo') }}</label>
            <input type="file" class="" name="sticky_logo_img">
            @if($setting->sticky_logo)
            <img style="max-width:200px" src="{{URL::to('/')}}/images/{{$setting->sticky_logo}}">

            <button type="button" onclick="removeLogo('sticky_logo',this)" class="btn btn-danger">&times</button>
            @endif
            {!! $errors->first('sticky_logo', '<p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('fav_icon') ? 'has-error' : ''}}">
            <label for="fav_icon" class="control-label">{{ __('m.favIcon') }}</label>
            <input type="file" class="" name="fav_icon_img">
            <img style="max-width:200px" src="{{URL::to('/')}}/images/{{$setting->fav_icon}}"> {!! $errors->first('fav_icon', '
            <p class="help-block">:message</p>') !!}
        </div>


        <div class="form-group {{ $errors->has('banner') ? 'has-error' : ''}}">
            <label for="banner" class="control-label">{{ __('m.banner') }}1</label>
            <input id="banner" type="file" class="" name="banner_img">
            @if($setting->banner)
                <img id="banner_img1" style="max-width:200px" src="{{URL::to('/')}}/images/{{$setting->banner}}">
                <button type="button" onclick="removeBanner(1,this)" class="btn btn-danger">&times
                </button>
            @endif
            {!! $errors->first('banner', '
        <p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('banner2') ? 'has-error' : ''}}">
            <label for="banner" class="control-label">{{ __('m.banner') }}2</label>
            <input type="file" class="" name="banner_img2">
            @if($setting->banner2)
                <img id="banner_img2" style="max-width:200px" src="{{URL::to('/')}}/images/{{$setting->banner2}}">
                <button type="button" onclick="removeBanner(2,this)" class="btn btn-danger">&times
                </button>
            @endif
            {!! $errors->first('banner2', '
            <p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('banner3') ? 'has-error' : ''}}">
            <label for="banner" class="control-label">{{ __('m.banner') }}3</label>
            <input type="file" class="" name="banner_img3">
            @if($setting->banner3)
                <img id="banner_img3" style="max-width:200px" src="{{URL::to('/')}}/images/{{$setting->banner3}}">
                <button type="button" onclick="removeBanner(3,this)" class="btn btn-danger">&times
                </button>
            @endif
            {!! $errors->first('banner3', '
            <p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('banner4') ? 'has-error' : ''}}">
            <label for="banner" class="control-label">{{ __('m.banner') }}4</label>
            <input type="file" class="" name="banner_img4">
            @if($setting->banner4)
                <img id="banner_img4" style="max-width:200px" src="{{URL::to('/')}}/images/{{$setting->banner4}}">
                <button type="button" onclick="removeBanner(4,this)" class="btn btn-danger">&times
                </button>
            @endif
            {!! $errors->first('banner4', '
            <p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('banner5') ? 'has-error' : ''}}">
            <label for="banner" class="control-label">{{ __('m.banner') }}5</label>
            <input type="file" class="" name="banner_img5">
            @if($setting->banner5)
                <img id="banner_img5" style="max-width:200px" src="{{URL::to('/')}}/images/{{$setting->banner5}}">
                <button type="button" onclick="removeBanner(5,this)" class="btn btn-danger">&times
                </button>
            @endif
            {!! $errors->first('banner5', '
            <p class="help-block">:message</p>') !!}
        </div>
        <script>
            function removeBanner(id, el) {
                el.remove();
                document.getElementById("banner_img" + id).remove();
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState === 4 && this.status === 200) {
                        toastr.success("Banner Removed");
                    }
                };
                xhttp.open("GET", "remove-banner?id=" + id, true);
                xhttp.send();
            }

            function removeLogo(logo_type, element) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState === 4 && this.status === 200) {
                        toastr.success("Logo Removed");
                    }
                };
                xhttp.open("GET", "remove-logo?type=" + logo_type, true);
                xhttp.send();
            }
        </script>


        <div class="form-group {{ $errors->has('default_product') ? 'has-error' : ''}}">
            <label for="default_product" class="control-label">{{ __('m.defaultProductImage') }}</label>
            <input type="file" class="" name="default_product_img">
            <img style="max-width:200px" src="{{URL::to('/')}}/images/{{$setting->default_product}}"> {!! $errors->first('default_product', '
            <p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('them_color') ? 'has-error' : ''}}">
            <label for="them_color" class="control-label">{{ __('m.themeColor') }}</label>
            <input type="color" class="form-control" name="them_color"
                   value="{{ isset($setting->them_color) ? $setting->them_color : ''}}"> {!! $errors->first('them_color', '
            <p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('wishList') ? 'has-error' : ''}}">
            <label for="wishList" class="control-label">{{ __('m.wishList') }}</label>
            <input @if($setting->wishList) checked @endif type="checkbox" class="form-check-inline" name="wishList"> {!! $errors->first('wishList', '
            <p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="tab-pane fade" id="other" role="tabpanel" aria-labelledby="other-tab">
        <div class="form-group {{ $errors->has('site_name') ? 'has-error' : ''}}">
            <label for="site_name" class="control-label">{{ __('m.siteName') }}</label>
            <input class="form-control" name="site_name" type="text" id="site_name"
                   value="{{ isset($setting->site_name) ? $setting->site_name : ''}}"> {!! $errors->first('site_name', '
            <p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('sidebar') ? 'has-error' : ''}}">
            <label for="sidebar" class="control-label">{{ __('m.sidebar') }}</label>
            <select class="form-control">
                <option {{$setting->sidebar=="left"?"selected":""}} value="left">{{ __('m.left') }}</option>
                <option {{$setting->sidebar=="right"?"selected":""}} value="right">{{ __('m.right') }}</option>
            </select> {!! $errors->first('sidebar', '
            <p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('view') ? 'has-error' : ''}}">
            <label for="view" class="control-label">{{ __('m.defaultView') }}</label>
            <select class="form-control">
                <option {{$setting->view=="grid"?"selected":""}} value="grid">{{ __('m.grid') }}</option>
                <option {{$setting->view=="list"?"selected":""}} value="list">{{ __('m.list') }}</option>
            </select> {!! $errors->first('view', '
            <p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('ingredient') ? 'has-error' : ''}}">
            <label for="ingredient" class="control-label">{{ __('m.ingredient') }}</label>
            <select id="ingredient" name="ingredient" class="form-control">
                <option {{$setting->ingredient?"selected":""}} value="1">{{ __('m.yes') }}</option>
                <option {{!$setting->ingredient?"selected":""}} value="0">{{ __('m.no') }}</option>
            </select> {!! $errors->first('ingredient', '
            <p class="help-block">:message</p>') !!}
        </div>


        <div class="form-group {{ $errors->has('from_email') ? 'has-error' : ''}}">
            <label for="from_email" class="control-label">{{ __('m.fromEmail') }}</label>
            <input type="text" name="from_email" value="{{ isset($setting->from_email) ? $setting->from_email : ''}}"
                   class="form-control"> {!! $errors->first('from_email', '
            <p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('pagination_length') ? 'has-error' : ''}}">
            <label for="pagination_length" class="control-label">{{ __('m.paginationLength') }}</label>
            <input type="number" name="pagination_length"
                   value="{{ isset($setting->pagination_length) ? $setting->pagination_length : 5}}"
                   class="form-control"> {!! $errors->first('pagination_length', '
            <p class="help-block">:message</p>') !!}
        </div>


        <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
            <label for="phone" class="control-label">{{ __('m.phone') }}</label>
            <input type="text" class="form-control" name="phone"
                   value="{{ isset($setting->phone) ? $setting->phone : ''}}"> {!! $errors->first('phone', '
            <p class="help-block">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
            <label for="address" class="control-label">{{ __('m.address') }}</label>
            <textarea class="form-control" name="address">{{$setting->address}}</textarea> {!! $errors->first('address', '
            <p class="help-block">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('css') ? 'has-error' : ''}}">
            <label for="css" class="control-label">{{ __('m.css') }}</label>
            <textarea class="form-control" name="css">{{$setting->css}}</textarea> {!! $errors->first('css', '
            <p class="help-block">:message</p>') !!}
        </div>


        <div class="form-group {{ $errors->has('homepage_notice') ? 'has-error' : ''}}">
            <label for="address" class="control-label">{{ __('m.homepageNotice') }}</label>
            <textarea class="text-area homepage_notice form-control" name="homepage_notice"></textarea> {!! $errors->first('homepage_notice', '
            <p class="help-block">:message</p>') !!}
        </div>


        <div class="form-group {{ $errors->has('them_color') ? 'has-error' : ''}}">
            <label for="them_color" class="control-label">{{ __('m.showNotice') }}</label>
            <select class="form-control" name="show_notice">
                <option value="1" {{$setting->show_notice=="1"?"selected":""}}>{{ __('m.show') }}</option>
                <option value="0" {{$setting->show_notice=="0"?"selected":""}}>{{ __('m.hide') }}</option>

            </select>
        </div>

        <div class="form-group {{ $errors->has('hide_rate') ? 'has-error' : ''}}">
            <label for="them_color" class="control-label">{{ __('m.hideRate') }}</label>
            <select class="form-control" name="hide_rate">
                <option value="1" {{$setting->hide_rate=="1"?"selected":""}}>{{ __('m.show') }}</option>
                <option value="0" {{$setting->hide_rate=="0"?"selected":""}}>{{ __('m.hide') }}</option>

            </select>
        </div>

        <div class="form-group {{ $errors->has('hide_news') ? 'has-error' : ''}}">
            <label for="them_color" class="control-label">{{ __('m.hideNewsLetter') }}</label>
            <select class="form-control" name="hide_news">
                <option value="1" {{$setting->hide_news=="1"?"selected":""}}>{{ __('m.show') }}</option>
                <option value="0" {{$setting->hide_news=="0"?"selected":""}}>{{ __('m.hide') }}</option>

            </select>
        </div>

        <div class="form-group {{ $errors->has('hide_rate_guest') ? 'has-error' : ''}}">
            <label for="them_color" class="control-label">{{ __('m.hideRateGuest') }}</label>
            <select class="form-control" name="hide_rate_guest">
                <option value="1" {{$setting->hide_rate_guest=="1"?"selected":""}}>{{ __('m.show') }}</option>
                <option value="0" {{$setting->hide_rate_guest=="0"?"selected":""}}>{{ __('m.hide') }}</option>

            </select>
        </div>

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


    </div>
    <div class="tab-pane fade " id="smtp" role="tabpanel" aria-labelledby="smtp-tab">
        <div class="form-group {{ $errors->has('host') ? 'has-error' : ''}}">
            <label for="host" class="control-label">{{ __('m.host') }}</label>
            <input type="text" name="host" value="{{ isset($setting->host) ? $setting->host : ''}}"
                   class="form-control"> {!! $errors->first('company_id', '
            <p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('port') ? 'has-error' : ''}}">
            <label for="port" class="control-label">{{ __('m.port') }}</label>
            <input type="text" name="port" value="{{ isset($setting->port) ? $setting->port : ''}}"
                   class="form-control"> {!! $errors->first('company_id', '
            <p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('from_name') ? 'has-error' : ''}}">
            <label for="from_name" class="control-label">{{ __('m.fromName') }}</label>
            <input type="text" name="from_name" value="{{ isset($setting->from_name) ? $setting->from_name : ''}}"
                   class="form-control"> {!! $errors->first('company_id', '
            <p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('encryption') ? 'has-error' : ''}}">
            <label for="encryption" class="control-label">{{ __('m.encryption') }}</label>
            <input type="text" name="encryption" value="{{ isset($setting->encryption) ? $setting->encryption : ''}}"
                   class="form-control"> {!! $errors->first('company_id', '
            <p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('username') ? 'has-error' : ''}}">
            <label for="username" class="control-label">{{ __('m.userName') }}</label>
            <input type="text" name="username" value="{{ isset($setting->username) ? $setting->username : ''}}"
                   class="form-control"> {!! $errors->first('company_id', '
            <p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
            <label for="password" class="control-label">{{ __('m.password') }}</label>
            <input type="text" name="password" value="{{ isset($setting->password) ? $setting->password : ''}}"
                   class="form-control"> {!! $errors->first('company_id', '
            <p class="help-block">:message</p>') !!}
        </div>


    </div>
    <div class="tab-pane fade " id="footer" role="tabpanel" aria-labelledby="footer-tab">
        <div class="form-group {{ $errors->has('contact_address') ? 'has-error' : ''}}">
            <label for="contact_address" class="control-label">{{ __('m.address') }}</label>
            <input type="text" name="contact_address"
                   value="{{ isset($setting->contact_address) ? $setting->contact_address : ''}}" class="form-control"> {!! $errors->first('company_id', '
            <p class="help-block">:message</p>') !!}
        </div>

        <div class="form-group {{ $errors->has('contact_phone') ? 'has-error' : ''}}">
            <label for="contact_phone" class="control-label">{{ __('m.phone') }}</label>
            <input type="text" name="contact_phone"
                   value="{{ isset($setting->contact_phone) ? $setting->contact_phone : ''}}" class="form-control"> {!! $errors->first('company_id', '
            <p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('contact_email') ? 'has-error' : ''}}">
            <label for="contact_email" class="control-label">{{ __('m.email') }}</label>
            <input type="text" name="contact_email"
                   value="{{ isset($setting->contact_email) ? $setting->contact_email : ''}}" class="form-control"> {!! $errors->first('company_id', '
            <p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('follow_us') ? 'has-error' : ''}}">
            <label for="follow_us" class="control-label">{{ __('m.followUs') }}</label>
            <textarea class="follow_us textarea form-control" name="follow_us"></textarea> {!! $errors->first('follow_us', '
            <p class="help-block">:message</p>') !!}
        </div>


        <div class="form-group {{ $errors->has('copyright') ? 'has-error' : ''}}">
            <label for="copyright" class="control-label">{{ __('m.footerBottom') }}</label>
            <textarea class="copyright textarea form-control" name="copyright"></textarea> {!! $errors->first('copyright', '
            <p class="help-block">:message</p>') !!}
        </div>

    </div>
    <div class="tab-pane fade " id="sync" role="tabpanel" aria-labelledby="sync-tab">
        <a class="btn btn-primary btn-block" href="{{ route('syncProduct') }}">{{ __('m.syncProduct') }}</a>
        <a class="btn btn-warning btn-block" href="{{ route('syncCategory') }}">{{ __('m.syncCategory') }}</a>
        <a class="btn btn-info btn-block" href="{{ route('syncAll') }}">{{ __('m.syncAll') }}</a>
        <br>
        <div class="row">
            <div class="col-md-6 form-group {{ $errors->has('cron_hour') ? 'has-error' : ''}}">
                <label for="contact_email" class="control-label">{{ __('m.hour') }}</label>
                <select name="cron_hour" class="form-control">
                    @for($i=0;$i<24;$i++)
                        <option
                            @if($setting->cron_hour==$i)
                            selected
                            @endif
                            value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-6 form-group {{ $errors->has('cron_minute') ? 'has-error' : ''}}">
                <label for="contact_email" class="control-label">{{ __('m.minute') }}</label>
                <select name="cron_minute" class="form-control">
                    @for($i=0;$i<60;$i=$i+5)
                        <option
                            @if($setting->cron_minute==$i)
                            selected
                            @endif
                            value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>
        </div>
    </div>

</div>


<div class="form-group">
    <input class="btn btn-primary my-2" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
@section('script')

    <script>
        $(function () {
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
