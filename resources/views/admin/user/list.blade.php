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
                    {{__('m.user_list')}}
                    </div>

                </div>
                <div class="card-body">
                        <div class="table-responsive">
                                <table class="table table-bordered data-table">
                                        <thead>
                                             <tr>
                                                 <th>{{__('m.first_name')}}</th><th>{{__('m.lastname')}}</th><th>{{__('m.email')}}</th><th>{{__('m.action')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>

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
          processing: true,
          serverSide: true,
          ajax: "{{ url('/user-data') }}",
          columns: [
              {data: 'firstname', name: 'firstname'},
              {data: 'lastname', name: 'lastname'},
              {data: 'email', name: 'email'},
              {data: 'action', name: 'action'},

          ]
      });

    });
  </script>
  @endsection
