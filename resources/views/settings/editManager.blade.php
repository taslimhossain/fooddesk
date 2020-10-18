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
    
                <div class="row">


                    <div class="col-md-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Edit Settings
                                </h3>
                                <div class="card-tools">

                                </div>
                            </div>
                            <div class="card-body">


                                @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                @endif
                              
                                <form class="my-2" method="POST"
                                    action="{{ url('/settings/' . $setting->id) }}"
                                    accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                                    {{ method_field('PATCH') }}
                                    {{ csrf_field() }}

                                    @include ('settings.managerForm', ['formMode' => 'edit'])

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
           
        </div>
    </section>
</div>

@endsection
