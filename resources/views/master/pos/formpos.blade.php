@extends('layouts.master')

@section('tittle_bar','Pos')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Master
            <small>Form Pos</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-file-image-o"></i> Master</a></li>
            <li><a href="#" class="active">Form Pos</a></li>
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
                                <form method="POST" @if(isset($data)) action="{{ route('master.pos.savepos') }}" @endif>
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Pos Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="pos_name" type="text" class="form-control @error('name') is-invalid @enderror" name="pos_name" value="{{ $data->pos_name ?? '' }}" required autocomplete="pos_name" autofocus>

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
                                            <input id="pos_lokasi" type="text" class="form-control @error('name') is-invalid @enderror" name="pos_lokasi" value="{{ $data->pos_lokasi ?? '' }}" required autocomplete="pos_lokasi" autofocus>

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
                                            <textarea id="pos_alamat" type="text" class="form-control @error('name') is-invalid @enderror" name="pos_alamat"  required autocomplete="pos_alamat" autofocus>{{ $data->pos_alamat ?? '' }}</textarea>

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
                                            <a href="{{ route('master.posloc') }}" class="btn btn-primary">
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