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
            <div class="container">
                <div class="row">


                    <div class="col-md-12">
                        <div class="card card-primary">
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
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">API</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="theme-tab" data-toggle="tab" href="#theme" role="tab" aria-controls="theme" aria-selected="false">Theme</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="other-tab" data-toggle="tab" href="#other" role="tab" aria-controls="other" aria-selected="false">Website</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="smtp-tab" data-toggle="tab" href="#smtp" role="tab" aria-controls="smtp" aria-selected="false">SMTP</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="footer-tab" data-toggle="tab" href="#footer" role="tab" aria-controls="footer" aria-selected="false">Footer</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="sync-tab" data-toggle="tab" href="#sync" role="tab" aria-controls="sync" aria-selected="false">Sync</a>
                                </li>
                                </ul>
                                <form class="my-2" method="POST"
                                    action="{{ url('/settings/' . $setting->id) }}"
                                    accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                                    {{ method_field('PATCH') }}
                                    {{ csrf_field() }}

                                    @include ('settings.form', ['formMode' => 'edit'])

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
