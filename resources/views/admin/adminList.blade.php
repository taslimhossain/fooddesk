@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <div class="card-title">
                        {{ __('m.adminList') }}
                    </div>
                    <div class="card-tools">
                        <a class="btn btn-warning" href="{{ route('addAdmin') }}">{{ __('m.addNew') }}</a>
                    </div>
                </div>
                <div class="card-body">
                        <div class="table-responsive">
                                <table class="table table-bordered data-table">
                                        <thead>
                                             <tr>
                                                 <th>{{ __('m.firstName') }}</th><th>{{ __('m.lastName') }}</th><th>{{ __('m.email') }}</th><th>{{ __('m.action') }}</th>
                                          
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($admins as $admin)
                                                <tr>
                                                    <td>{{$admin->firstname}}</td>
                                                    <td>{{$admin->lastname}}</td>
                                                    <td>{{$admin->email}}</td>
                                                    <td>
                                                        <a class="btn btn-danger" onclick="return confirm('Are you sure to delete?')" href="{{route('deleteAdmin',$admin->id)}}">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                        </div>
                </div>
            </div>
        </div>
    </section>
</div>
    @endsection
@section('script')
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script type="text/javascript">

    $(function () {
      
      var table = $('.data-table').DataTable({
        language: {
        url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Dutch.json'
    },
      });
      
    });
  </script>
  @endsection
