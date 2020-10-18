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
                       {{__('m.view_user')}}
                    </div>

                </div>
                <div class="card-body">
                    <table class="table table-bordered table-stripped">
                        <tbody>
                            <tr>
                                <th>{{__('m.first_name')}}</th>
                                <td>{{$user->firstname}}</td>
                            </tr>
                            <tr>
                                <th>{{__('m.lastname')}}</th>
                                <td>{{$user->lastname}}</td>
                            </tr>
                            <tr>
                                <th>{{__('m.email')}}</th>
                                <td>{{$user->email}}</td>
                            </tr>
                            <tr>
                                <th>{{__('m.address_one')}}</th>
                                <td>{{$user->address1}}</td>
                            </tr>
                            <tr>
                                <th>{{__('m.phone')}}</th>
                                <td>{{$user->telephone}}</td>
                            </tr>
                            <tr>
                                <th>{{__('m.zip')}}</th>
                                <td>{{$user->zip}}</td>
                            </tr>
                            <tr>
                                <th>{{__('m.town')}}</th>
                                <td>{{$user->town}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection