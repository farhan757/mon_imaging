@extends('layouts.master')

@section('tittle_bar','Customer')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Master
            <small>Form Customer</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-file-image-o"></i> Master</a></li>
            <li><a href="#" class="active">Form Customer</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- /.box-body -->
        <div class="box box-success">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                        
                            <div class="card-body">
                                <form method="POST" @if(isset($data)) action="{{ route('master.cust.savecust') }}" @endif>
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Customer Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="cust_name" type="text" class="form-control @error('name') is-invalid @enderror" name="cust_name" value="{{ $data->customer_name ?? '' }}" required autocomplete="cust_name" autofocus>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('PIC Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="cust_pic" type="text" class="form-control @error('name') is-invalid @enderror" name="cust_pic" value="{{ $data->customer_pic ?? '' }}" required autocomplete="cust_pic" autofocus>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>  

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Customer Address') }}</label>

                                        <div class="col-md-6">
                                            <textarea id="cust_add" type="text" class="form-control @error('name') is-invalid @enderror" name="cust_add"  required autocomplete="cust_add" autofocus>{{ $data->customer_add ?? '' }} </textarea>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>                                                                        

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Customer Telphone') }}</label>

                                        <div class="col-md-6">
                                            <input id="cust_telp" type="text" class="form-control @error('name') is-invalid @enderror" name="cust_telp" value="{{ $data->customer_telp ?? '' }}" required autocomplete="cust_telp" autofocus>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                            @if(isset($data)) 
                                                {{ __('Save') }}
                                            @else
                                                {{ __('Add') }}
                                            @endif
                                            </button>
                                            <a href="{{ route('master.customer') }}" class="btn btn-primary">
                                                {{ __('List') }}
                                            </a>                                            
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.container -->
@stop