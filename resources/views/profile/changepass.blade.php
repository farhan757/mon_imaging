@extends('layouts.master')

@section('tittle_bar','Change Password')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Profile
            <small>Change Password</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-file-image-o"></i> Profile</a></li>
            <li><a href="#" class="active">Change Password</a></li>
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
                                <form method="POST" id="form-item">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $data->name ?? '' }}" disabled>

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
                                            <input id="username" type="text" class="form-control @error('name') is-invalid @enderror" name="username" value="{{ $data->username ?? '' }}" disabled>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div id="group-oldpass" class="form-group row">
                                        <label for="old_password" class="col-md-4 col-form-label text-md-right"><i id="old_pass" class=""></i> {{ __('Old Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="old_password" type="password" onchange="oldPass()" class="form-control" name="old_password">
                                        </div>
                                    </div>

                                    <div id="group-newpass" class="form-group row">
                                        <label for="new_password" class="col-md-4 col-form-label text-md-right"><i id="new_pass" class=""></i> {{ __('New Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="new_password" type="password" onchange="newPass()" class="form-control" name="new_password">
                                        </div>
                                    </div>

                                    <div id="group-confpass" class="form-group row">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right"><i id="con_pass" class=""></i> {{ __('Confirm Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" onchange="confPass()" class="form-control" name="password_confirmation">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Save') }}
                                            </button>
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

@section('js')
<script>
    function oldPass() {
        var val = document.getElementById("old_password").value;
        $.ajax({
            url: "{{ route('profile.check_old_pass') }}",
            method: 'GET',
            data: {
                old_password: val
            },
            success: function(response) {
                console.log(response);
                $("#group-oldpass").removeClass('has-success');
                $("#group-oldpass").removeClass('has-error');
                $("#group-oldpass").addClass('has-success');
                $("#old_pass").removeClass('fa fa-check');
                $("#old_pass").removeClass('fa fa-times-circle-o');
                $("#old_pass").addClass('fa fa-check');
            },
            error: function(response) {
                $("#group-oldpass").removeClass('has-success');
                $("#group-oldpass").removeClass('has-error');
                $("#group-oldpass").addClass('has-error');
                $("#old_pass").removeClass('fa fa-check');
                $("#old_pass").removeClass('fa fa-times-circle-o');
                $("#old_pass").addClass('fa fa-times-circle-o');
                $("#old_password").val('').focus();
            }
        });
    }

    function newPass() {
        var val = document.getElementById("new_password").value;
        $.ajax({
            url: "{{ route('profile.check_new_pass') }}",
            method: 'GET',
            data: {
                new_password: val
            },
            success: function(response) {
                console.log(response);
                $("#group-newpass").removeClass('has-success');
                $("#group-newpass").removeClass('has-error');
                $("#group-newpass").addClass('has-success');
                $("#new_pass").removeClass('fa fa-check');
                $("#new_pass").removeClass('fa fa-times-circle-o');
                $("#new_pass").addClass('fa fa-check');
            },
            error: function(response) {
                $("#group-newpass").removeClass('has-success');
                $("#group-newpass").removeClass('has-error');
                $("#group-newpass").addClass('has-error');
                $("#new_pass").removeClass('fa fa-check');
                $("#new_pass").removeClass('fa fa-times-circle-o');
                $("#new_pass").addClass('fa fa-times-circle-o');
                $("#new_password").val('').focus();
            }
        });
    }

    function confPass() {
        var val = document.getElementById("new_password").value;
        var val2 = document.getElementById("password-confirm").value;
        if (val == val2) {
            $("#group-confpass").removeClass('has-success');
            $("#group-confpass").removeClass('has-error');
            $("#group-confpass").addClass('has-success');
            $("#con_pass").removeClass('fa fa-check');
            $("#con_pass").removeClass('fa fa-times-circle-o');
            $("#con_pass").addClass('fa fa-check');
        } else {
            $("#group-confpass").removeClass('has-success');
            $("#group-confpass").removeClass('has-error');
            $("#group-confpass").addClass('has-error');
            $("#con_pass").removeClass('fa fa-check');
            $("#con_pass").removeClass('fa fa-times-circle-o');
            $("#con_pass").addClass('fa fa-times-circle-o');
            $("#password-confirm").val('').focus();
        }
    }

    $(function() {
        $("#form-item").submit(function(e) {
            e.preventDefault();
            var formdata = new FormData($("#form-item")[0]);

            $.ajax({
                url: "{{ route('profile.save_form_c_pass') }}",
                method: "POST",
                data: formdata,
                contentType: false,
                processData: false,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: response.data,
                        onClose: () => {
                            window.location.reload();
                        }
                    });
                },
                error: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: response.data,
                        onClose: () => {
                            window.location.reload();
                        }
                    });
                }
            });
        });
    });
</script>
@stop