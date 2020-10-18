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
                       {{__('m.products')}}
                    </div>
                    <div class="card-tools">
                        <a class="btn btn-warning" href="{{ url('/admin/products/create') }}">{{__('m.add_new')}}</a>
                    </div>
                </div>
                <div class="card-body">
                        <div class="table-responsive">
                                <table class="table table-bordered data-table">
                                        <thead>
                                             <tr>
                                                 <th>#</th><th>{{__('m.title')}}</th><th>{{__('m.content')}}</th><th>{{__('m.image')}}</th><th>{{__('m.category')}}</th><th>{{__('m.subCategory')}}</th><th>{{__('m.actions')}}</th>

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
      url=`{{URL::to('/admin/products/${id}')}}`;
        $('<form action="'+url+'" method="post">@csrf @method("delete")</form>').appendTo('body').submit();
    }
    $(function () {

      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ url('/admin/products') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'title', name: 'title'},
              {data: 'content', name: 'content'},
              {data: 'image', name: 'image'},
              {data: 'category', name: 'category'},
              {data: 'subCategory', name: 'subCategory'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

    });
  </script>
  @endsection
