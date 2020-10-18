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
                        {{-- <a class="btn btn-warning" href="{{ route('syncProduct') }}">Sync Now</a> --}}
                    </div>
                </div>
                <div class="card-body">
                        <div class="table-responsive">
                                <table class="table table-bordered data-table">
                                        <thead>
                                             <tr>
                                                 <th>#</th><th>{{__('m.product_name')}}</th><th>{{__('m.content')}}</th><th>{{__('m.image')}}</th><th>{{__('m.category')}}</th>
                                                 <th>SubCategorie</th>
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
      url=`{{URL::to('/products/${id}')}}`;
        $('<form action="'+url+'" method="post">@csrf @method("delete")</form>').appendTo('body').submit();
    }
    $(function () {

      var table = $('.data-table').DataTable({
        language: {
        url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Dutch.json'
    },
          processing: true,
          serverSide: true,
          ajax: "{{ url('/products') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'product_name_dch', name: 'product_name_dch'},{data: 'product_description_dch', name: 'product_description_dch'},{data: 'image', name: 'image'},{data: 'category', name: 'category'},{data: 'subCategory', name: 'subCategory'},

          ]
      });

    });
  </script>
  @endsection
