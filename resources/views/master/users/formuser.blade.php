@extends('layouts.master')

@section('tittle_bar','Users')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Master
            <small>Form Users</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-file-image-o"></i> Master</a></li>
            <li><a href="#" class="active">Form Users</a></li>
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
                                <form method="POST" @if(isset($data)) action="{{ route('master.saveuser') }}" @endif>
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $data->name ?? '' }}" required autocomplete="name" autofocus>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('User Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="username" type="text" class="form-control @error('name') is-invalid @enderror" name="username" value="{{ $data->username ?? '' }}" required autocomplete="username" autofocus>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Group Access') }}</label>

                                        <div class="col-md-6">
                                            <select name="group" id="group" class="form-control ">
                                                @foreach($group as $val)
                                                <option value="{{ $val->id }}" @if(isset($data->group_id))
                                                    @if($val->id == $data->group_id)
                                                    selected
                                                    @endif
                                                    @endif
                                                    >{{ $val->group_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $data->email ?? '' }}" required autocomplete="email">

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" @if(!isset($data)) required @endif autocomplete="new-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" @if(!isset($data)) required @endif autocomplete="new-password">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Status User') }}</label>
                                        <div class="col-md-6">
                                            <label>
                                                <input id="aktif" name="aktif" type="checkbox" class="flat-red" 
                                                @if(isset($data)) 
                                                    @if($data->aktif == '1') 
                                                        checked 
                                                    @endif
                                                @endif
                                                > Active
                                            </label>
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
                                            <a href="{{ route('master.users') }}" class="btn btn-primary">
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
