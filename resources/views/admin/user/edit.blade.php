@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <div class="card-title">
                       {{__('m.editUser')}}
                    </div>

                </div>
                <div class="card-body">
                <form method="post" action="{{URL::to('/')}}/update-user">
                       @csrf
                   <input type="hidden" name="id" type="hidden" value="{{$user->id}}">
                        <div class="form-group ">
                        <label for="content" class="control-label">{{__('m.first_name')}}</label>
                        <input type="text" class="form-control" name="firstname" value="{{$user->firstname}}">
                        </div>
                        <div class="form-group ">
                            <label for="content" class="control-label">{{__('m.lastname')}}</label>
                            <input type="text" class="form-control" name="lastname" value="{{$user->lastname}}">
                            </div>
                        <div class="form-group ">
                            <label for="content" class="control-label">{{__('m.email')}}</label>
                            <input type="email" class="form-control" name="email" value="{{$user->email}}">
                            </div>
                             <div class="form-group ">
                            <label for="content" class="control-label">{{__('m.phone')}}</label>
                            <input type="text" class="form-control" name="telephone" value="{{$user->telephone}}">
                            </div>
                        <div class="form-group ">
                            <label for="content" class="control-label">{{__('m.address')}}</label>
                            <input type="text" class="form-control" name="address1" value="{{$user->address1}}">
                            </div>
                           
                            <div class="form-group ">
                            <label for="content" class="control-label">{{__('m.town')}}</label>
                            <input type="text" class="form-control" name="town" value="{{$user->town}}">
                            </div>
                            <div class="form-group ">
                            <label for="content" class="control-label">{{__('m.zip')}}</label>
                            <input type="text" class="form-control" name="zip" value="{{$user->zip}}">
                            </div>
                            <div class="form-group ">
                                <button class="btn btn-info">
                                    {{__('m.update')}}

                                </button>
                            </div>
                   </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection