@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <!-- Content Header (Page header) -->
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
                    {{__('m.sub_category')}}
                    </div>
                    <div class="card-tools">
                        {{-- <a class="btn btn-warning" href="{{ route('syncCategory') }}">{{__('m.sync_now')}}</a> --}}
                    </div>
                </div>
                <div class="card-body">
                        <div class="table-responsive">
                                <table class="table table-bordered data-table">
                                        <thead>
                                             <tr>
                                                 <th>{{__('m.category_id')}}</th><th>{{__('m.sub_category_id')}}</th><th>{{__('m.name')}}</th><th>{{__('m.image')}}</th><th>{{__('m.status')}}</th>

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

    deleteData=(id)=>{
      url=`{{URL::to('/sub-categories/${id}')}}`;
        $('<form action="'+url+'" method="post">@csrf @method("delete")</form>').appendTo('body').submit();
    }
    $(function () {

      var table = $('.data-table').DataTable({
        language: {
        url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Dutch.json'
    },
          processing: true,
          serverSide: true,
          ajax: "{{ url('/sub-categories') }}",
          columns: [
              {data: 'category_id', name: 'category_id'},
              {data: 'fid', name: 'fid'},
              {data: 'name', name: 'name'},
              {data: 'image', name: 'image','orderable':false},
              {data: 'status', name: 'status','orderable':false}
          ]
      });

    });
    function updateCategory(id, el) {
        console.log(id)
        jQuery.ajax({
            method: 'post',
            url: "{{ route('update_subcate_status') }}",
            data: {
                _token: '{{csrf_token()}}',
                fid: id,
            },
            success: function (result) {
                toastr.success("Category status update success");
            }
        });

    }
  </script>
  @endsection
