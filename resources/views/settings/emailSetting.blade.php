<style>
a.btn.btn-emailsetting {
    background: #1c88ca;
    display: block;
    color: #fff;
    border-radius: 0px;
}
</style>

    <table class="table table-striped">
            <tbody>
                <tr>
                    <th>
                        {{ __('m.name') }}
                    </th>
                    <td>
                        #name
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('m.orderId') }}
                    </th>
                    <td>
                        #id
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('m.orderDate') }}
                    </th>
                    <td>
                        #date
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('m.pickupTime') }}
                    </th>
                    <td>
                        #pickup
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('m.orderDetail') }}
                    </th>
                    <td>
                        #detail
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('m.total') }}
                    </th>
                    <td>
                        #total
                    </td>
                </tr>
            </tbody>

    </table>
    <a style="" href="#ok_mail" class="btn btn-emailsetting" data-toggle="collapse">{{ __('m.okMail') }}</a>
    <br>
    <br>
    <div id="ok_mail" class="collapse">
        <div class="form-group {{ $errors->has('ok_mail_subject') ? 'has-error' : ''}}">
            <label for="address" class="control-label">{{ __('m.okMailSubject') }}</label>
            <input type="text" class="form-control" name="ok_mail_subject" value="{{$setting->ok_mail_subject}}"> {!! $errors->first('ok_mail_subject', '
            <p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('ok_mail') ? 'has-error' : ''}}">
            <label for="address" class="control-label">{{ __('m.okMailBody') }}</label>
            <textarea class="ok_mail textarea form-control" name="ok_mail"></textarea> {!! $errors->first('ok_mail', '
            <p class="help-block">:message</p>') !!}
        </div>
    </div>


    <a href="#success_mail" class="btn btn-emailsetting" data-toggle="collapse">{{ __('m.successMail') }}</a>
    <br>
    <br>
    <div id="success_mail" class="collapse">
        <div class="form-group {{ $errors->has('success_mail_subject') ? 'has-error' : ''}}">
            <label for="address" class="control-label">{{ __('m.successMailSubject') }}</label>
            <input type="text" class="form-control" name="success_mail_subject" value="{{$setting->success_mail_subject}}"> {!! $errors->first('success_mail_subject', '
            <p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('success_mail') ? 'has-error' : ''}}">
            <label for="address" class="control-label">{{ __('m.successMailBody') }}</label>
            <textarea class="textarea form-control success_mail" name="success_mail"></textarea> {!! $errors->first('success_mail', '
            <p class="help-block">:message</p>') !!}
        </div>

    </div>

    <a href="#hold_mail" class="btn btn-emailsetting" data-toggle="collapse">{{ __('m.holdMail') }}</a>
    <br>
    <br>
    <div id="hold_mail" class="collapse">
        <div class="form-group {{ $errors->has('hold_mail_subject') ? 'has-error' : ''}}">
            <label for="address" class="control-label">{{ __('m.holdMailSubject') }}</label>
            <input type="text" class="form-control" name="hold_mail_subject" value="{{$setting->hold_mail_subject}}"> {!! $errors->first('hold_mail_subject', '
            <p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('hold_mail') ? 'has-error' : ''}}">
            <label for="address" class="control-label">{{ __('m.holdMailBody') }}</label>
            <textarea class="textarea form-control hold_mail" name="hold_mail"></textarea> {!! $errors->first('hold_mail', '
            <p class="help-block">:message</p>') !!}
        </div>
    </div>

    <a href="#delivery_mail" class="btn btn-emailsetting" data-toggle="collapse">{{ __('m.deliveryCompleteMail') }}</a>
    <br>
    <br>
    <div id="delivery_mail" class="collapse">
        <div class="form-group {{ $errors->has('delivery_complete_subject') ? 'has-error' : ''}}">
            <label for="address" class="control-label">{{ __('m.deliveryCompleteSubject') }}</label>
            <input type="text" class="form-control" name="delivery_complete_subject" value="{{$setting->delivery_complete_subject}}"> {!! $errors->first('delivery_complete_subject', '
            <p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('delivery_complete') ? 'has-error' : ''}}">
            <label for="address" class="control-label">{{ __('m.deliveryCompleteBody') }}</label>
            <textarea class="textarea form-control delivery_complete" name="delivery_complete"></textarea> {!! $errors->first('delivery_complete', '
            <p class="help-block">:message</p>') !!}
        </div>
    </div>

<a href="#home_delivery_mail" class="btn btn-emailsetting" data-toggle="collapse">{{ __('m.homeDeliveryMail') }}</a>
    <br>
    <br>
    <div id="home_delivery_mail" class="collapse">
        <div class="form-group {{ $errors->has('home_delivery_subject') ? 'has-error' : ''}}">
            <label for="address" class="control-label">{{ __('m.homeDeliverySubject') }}</label>
            <input type="text" class="form-control" name="home_delivery_subject" value="{{$setting->home_delivery_subject}}"> {!! $errors->first('home_delivery_subject', '
            <p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('home_delivery_body') ? 'has-error' : ''}}">
            <label for="address" class="control-label">{{ __('m.homeDeliveryBody') }}</label>
            <textarea class="textarea form-control home_delivery" name="home_delivery_body"></textarea> {!! $errors->first('home_delivery_body', '
            <p class="help-block">:message</p>') !!}
        </div>
    </div>

    <a href="#collection" class="btn btn-emailsetting" data-toggle="collapse">{{ __('m.collectionCompleteMail') }}</a>
    <br>
    <br>
    <div id="collection" class="collapse">
        <div class="form-group {{ $errors->has('collection_complete_subject') ? 'has-error' : ''}}">
            <label for="address" class="control-label">{{ __('m.collectionCompleteSubject') }}</label>
            <input type="text" class="form-control" name="collection_complete_subject" value="{{$setting->collection_complete_subject}}"> {!! $errors->first('collection_complete_subject', '
            <p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('collection_complete') ? 'has-error' : ''}}">
            <label for="address" class="control-label">{{ __('m.collectionCompleteBody') }}</label>
            <textarea class="textarea form-control collection_complete" name="collection_complete"></textarea> {!! $errors->first('collection_complete', '
            <p class="help-block">:message</p>') !!}
        </div>
    </div>

    <a href="#signup" class="btn btn-emailsetting" data-toggle="collapse">{{ __('m.signupMail') }}</a>
    <br>
    <br>
    <div id="signup" class="collapse">
        <div class="form-group {{ $errors->has('signup_title') ? 'has-error' : ''}}">
            <label for="address" class="control-label">{{ __('m.signupTitle') }}</label>
            <input type="text" class="form-control" name="signup_title" value="{{$setting->signup_title}}"> {!! $errors->first('ok_mail_subject', '
            <p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('signup_message') ? 'has-error' : ''}}">
            <label for="address" class="control-label">{{ __('m.signupMailBody') }}</label>
            <textarea class="signup_message textarea form-control" name="signup_message"></textarea> {!! $errors->first('signup_message', '
            <p class="help-block">:message</p>') !!}
        </div>
    </div>

    <a href="#order_place" class="btn btn-emailsetting" data-toggle="collapse">{{ __('m.orderPlace') }}</a>
    <br>
    <br>
    <div id="order_place" class="collapse">
        <div class="form-group {{ $errors->has('order_place_title') ? 'has-error' : ''}}">
            <label for="address" class="control-label">{{ __('m.orderPlaceTitle') }}</label>
            <input type="text" class="form-control" name="order_place_title" value="{{$setting->order_place_title}}"> {!! $errors->first('order_place_title', '
            <p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('order_place_body') ? 'has-error' : ''}}">
            <label for="address" class="control-label">{{ __('m.orderPlaceBody') }}</label>
            <textarea class="order_place_body textarea form-control" name="order_place_body"></textarea> {!! $errors->first('order_place_body', '
            <p class="help-block">:message</p>') !!}
        </div>
    </div>


    <a href="#order_place_admin" class="btn btn-emailsetting" data-toggle="collapse">{{ __('m.orderPlaceShopManager') }}</a>
    <br>
    <br>
    <div id="order_place_admin" class="collapse">
        <div class="form-group {{ $errors->has('order_email') ? 'has-error' : ''}}">
            <label for="address" class="control-label">{{ __('m.emailAddress') }}</label>
            <input type="text" class="form-control" name="order_email" value="{{$setting->order_email}}"> {!! $errors->first('order_email', '
            <p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('order_admin_title') ? 'has-error' : ''}}">
            <label for="address" class="control-label">{{ __('m.orderPlaceTitle') }}</label>
            <input type="text" class="form-control" name="order_admin_title" value="{{$setting->order_admin_title}}"> {!! $errors->first('order_admin_title', '
            <p class="help-block">:message</p>') !!}
        </div>
        <div class="form-group {{ $errors->has('order_admin_body') ? 'has-error' : ''}}">
            <label for="address" class="control-label">{{ __('m.orderPlaceBody') }}</label>
            <textarea class="order_admin_body textarea form-control" name="order_admin_body"></textarea> {!! $errors->first('order_admin_body', '
            <p class="help-block">:message</p>') !!}
        </div>
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
        $('.home_delivery').summernote('code', `{!! $setting->home_delivery_body !!}`);
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
