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
                        <div class="card-header">{{__('m.change_email')}}</div>

                        <div class="card-body">
                            <form autocomplete="on" action="{{route('updatePasswordAdmin')}}" method="POST">
                                @csrf
                                <div class="row">



                                    <div class="col-12 mb-30">
                                        <input placeholder="{{__('m.old_email')}}" class="form-control" name="old_email" value="" autocomplete="off" type="email">
                                    </div>

                                    <div class="my-2 col-12 mb-30">
                                        <input placeholder="{{__('m.new_email')}}" class="form-control" name="new_email" value="" autocomplete="off" type="email">
                                    </div>
                                   

                                    <div class="my-2 col-12 mb-30">
                                        <input placeholder="{{__('m.confirm_email')}}" class="form-control" name="confirm_email" value="" autocomplete="off" type="email">
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