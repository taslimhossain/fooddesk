@extends('layouts.admin') @section('content')
<div class="content-wrapper">
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card card-info">
                        <div class="card-header">{{__('m.change_password')}}</div>

                        <div class="card-body">
                            <form autocomplete="on" action="{{route('updatePasswordAdmin')}}" method="POST">
                                @csrf
                                <div class="row">

                                    <div class="my-2 col-12 mb-30">
                                        <input placeholder="{{__('m.old_password')}}" class="form-control" name="old_password" value="" autocomplete="off" type="password">
                                    </div>

                                    <div class="my-2 col-12 mb-30">
                                        <input class="form-control" name="password" id="new-pwd" placeholder="{{__('m.new_password')}}" type="password">
                                    </div>

                                    <div class="my-2 col-12 mb-30">
                                        <input class="form-control" name="password_confirmation" id="confirm-pwd" placeholder="{{__('m.confirm_password')}}" type="password">
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary my-2">{{__('m.save_changes')}}</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
</div>
@endsection