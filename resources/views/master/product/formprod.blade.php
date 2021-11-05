@extends('layouts.master')

@section('tittle_bar','Product')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Master
            <small>Form Product</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-file-image-o"></i> Master</a></li>
            <li><a href="#" class="active">Form Product</a></li>
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
                                <form method="POST" @if(isset($data)) action="{{ route('master.prod.saveprod') }}" @endif>
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Customer') }}</label>

                                        <div class="col-md-6">
                                            <select name="customer_id" id="customer_id" class="form-control ">
                                            @foreach($customer as $val)
                                                <option value="{{ $val->id }}"
                                                @if(isset($data->customer_id))
                                                    @if($val->id == $data->customer_id)
                                                        selected
                                                    @endif
                                                @endif
                                                >{{ $val->customer_name }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Product Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="product_name" type="text" class="form-control @error('name') is-invalid @enderror" name="product_name" value="{{ $data->product_name ?? '' }}" required autocomplete="product_name" autofocus>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>  

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Product Desc') }}</label>

                                        <div class="col-md-6">
                                            <textarea id="product_desc" type="text" class="form-control @error('name') is-invalid @enderror" name="product_desc"  required autocomplete="product_desc" autofocus>{{ $data->product_desc ?? '' }} </textarea>

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
                                            <a href="{{ route('master.product') }}" class="btn btn-primary">
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