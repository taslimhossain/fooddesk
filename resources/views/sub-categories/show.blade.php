@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">


            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">SubCategory {{ $subcategory->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/sub-categories') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/sub-categories/' . $subcategory->id . '/edit') }}" title="Edit SubCategory"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('subcategories' . '/' . $subcategory->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete SubCategory" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $subcategory->id }}</td>
                                    </tr>
                                    <tr><th> Fid </th><td> {{ $subcategory->fid }} </td></tr><tr><th> Category Id </th><td> {{ $subcategory->category_id }} </td></tr><tr><th> Name </th><td> {{ $subcategory->name }} </td></tr><tr><th> Image </th><td> {{ $subcategory->image }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
