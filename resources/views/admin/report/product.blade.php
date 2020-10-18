@extends('layouts.admin') @section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Report Per Product</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('orderList')}}">Home</a></li>
                        <li class="breadcrumb-item active">Product Report</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <section class="content">
        <img id="labelImage" src="" alt="">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <form method="post" action="{{route('productReportResult')}}">
                        @csrf
                        <div class="row">

                            <div class="col-md-5">
                                <div class="form-group form-inline">
                                    <label>Start Date</label>
                                    <input required name="start" id="start" class="ml-2 form-control" type="date">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group form-inline">
                                    <label>End Date</label>
                                    <input required name="end" id="end" class="ml-2 form-control" type="date">
                                </div>
                            </div>
                            <div class="form-group form-inline">
                                <button  class="btn btn-success ">{{ __('m.search') }}</button>
                            </div>

                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-6">
                        <form method="post" action="{{route('productReportResult')}}">
                        @csrf
                        <input name="start" value="{{date('Y-m-d', strtotime('+1 day'))}}" class="ml-2 form-control" type="hidden">
                        <input name="end" value="{{date('Y-m-d', strtotime('+1 day'))}}"  class="ml-2 form-control" type="hidden">
                        <button  class="btn btn-warning ">Tomorrow {{date('Y-m-d', strtotime('+1 day'))}}</button>
                        </form>
                        </div>
                        <div class="col-md-6">
                    <form method="post" action="{{route('productReportResult')}}">
                        @csrf
                        <input name="start" value="{{date('Y-m-d', strtotime('+2 day'))}}" class="ml-2 form-control" type="hidden">
                        <input name="end" value="{{date('Y-m-d', strtotime('+2 day'))}}"  class="ml-2 form-control" type="hidden">
                        <button  class="btn btn-warning ">Day after tomorrow {{date('Y-m-d', strtotime('+2 day'))}}</button>
                    </form>
                        </div>
                    </div>



                </div>
                <div class="card-body">
                @if(isset($start))
                            <h4>Result showing for {{$start}} to {{$end}}</h4>

                    <div class="table-responsive">

                        <table class="table table-hover table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($total=0)
                                @php($products=[])
                                @foreach($orders as $order)
                                @if(array_key_exists($order->product_id,$products))

                                @else
                                    @php($products[$order->product_id]="sas")
                                <tr>
                                    <td>{{$order->product->product_name_dch}}</td>
                                    <td>
                                    @if($order->product->sell_product_option=="weight_wise")
                                    {{$quantities[$order->product_id]>999?($quantities[$order->product_id]/1000)." kg":($quantities[$order->product_id])." gr"}}
                                        {{--  @elseif($order->product->sell_product_option=="per_unit")
                                        {{$quantities[$order->product_id]}} stuck  --}}
                                        @else
                                        {{$quantities[$order->product_id]}}
                                        {{--  person  --}}
                                         @endif</td>
                                    <td>
                                        @if($order->product->sell_product_option=="weight_wise")
                                        €{{number_format((float)$order->product->price_weight*1000, 2, ',', '')}}/kg
                                        @elseif($order->product->sell_product_option=="per_unit")
                                        €{{number_format((float)$order->product->price_per_unit, 2, ',', '')}}/ stuk
                                        @else
                                        €{{number_format((float)$order->product->price_per_person, 2, ',', '')}}/ Person

                                        @endif
                                    </td>
                                    <td>@if($order->product->sell_product_option=="weight_wise")
                                        @php($total+=$order->product->price_weight*$quantities[$order->product_id])
                                        €{{number_format((float)$order->product->price_weight*$quantities[$order->product_id], 2, ',', '')}}
                                        @elseif($order->product->sell_product_option=="per_unit")
                                        @php($total+=$order->product->price_per_unit*$quantities[$order->product_id])
                                        €{{number_format((float)$order->product->price_per_unit*$quantities[$order->product_id], 2, ',', '')}}
                                        @else
                                        @php($total+=$order->product->price_per_person*$quantities[$order->product_id])
                                        €{{number_format((float)$order->product->price_per_person*$quantities[$order->product_id], 2, ',', '')}}

                                        @endif</td>
                                    <td>
                                        <a onclick="print_labeler_product_report('{{$order->product_id}}','{{$start}}','{{$end}}','{{route('printOrderProduct')}}')" href="javascript:void(0);">
                                        <img src="{{asset('assets/images/per_product.png')}}" alt="Print">
                                        </a>
                                        <a href="{{route('exportProductReport')}}?product_id={{$order->product_id}}&start={{$start}}&end={{$end}}" class="btn btn-warning">Export</a>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td >Total</td>

                                <td >€{{number_format((float)$total, 2, ',', '')}}</td>
                                <td></td>

                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
    </section>
    </div>

    @endsection

    @section('script')
        <script src="{{asset('admin/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script src="http://labelwriter.com/software/dls/sdk/js/DYMO.Label.Framework.latest.js"
        type="text/javascript" charset="UTF-8"> </script>
<script src="{{asset('js/product_all.js')}}"></script>
    <script>

    @if(isset($start))
    var table = $('.data-table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'product_report {{$start}} to {{$end}}',
                exportOptions: {
                     columns: [ 0, 1, 2, 3 ]
                }
            },
            {
                extend: 'pdfHtml5',
                customize: function (doc) {
    doc.content[1].table.widths =
        Array(doc.content[1].table.body[0].length + 1).join('*').split('');
  },
                title: 'product report {{$start}} to {{$end}}',
                exportOptions: {
                    columns: [ 0, 1, 2, 3 ]
                }
            }
        ]
    })
    @endif
    </script>

    @endsection
