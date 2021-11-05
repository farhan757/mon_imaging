@extends('layouts.master')

@section('tittle_bar','Users')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Master
            <small>List Users</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-file-image-o"></i> Master</a></li>
            <li><a href="#" class="active">List Users</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- /.box-body -->
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <a href="{{ route('master.form') }}" type="button" class="btn bg-olive margin"><span class="fa fa-upload"></span> Add User</a>
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="card-body table-responsive p-0">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>UserName</th>
                                <th>Email</th>
                                <th>Active</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->username }}</td>
                                <td>
                                    {{ $value->email }}
                                </td>
                                <th>
                                    @if($value->aktif == '1')
                                    <span class="fa fa-check"></span>
                                    @else
                                    <span class="fa fa-remove"></span>
                                    @endif
                                </th>
                                <td>{{ $value->created_at }}</td>
                                <td>
                                    <a title="Menu" href="{{ 'users/menu/'.$value->id }}"><span class="fa fa-list"></span> </a>
                                    @if(Auth::user()->group_id == 1)
                                    <a title="Edit" href="{{ route('master.edit',$value->id) }}"><span class="fa fa-edit"></span> </a>
                                    <a title="Delete" href="{{ route('master.del.user',$value->id) }}"><span class="fa fa-remove"></span> </a>                                    
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.container -->

@endsection

@section('js')
<script>
    function deleteuser(id) {
        var iddel = id;
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            showLoaderOnConfirm: true,
            preConfirm: (login) => {
                $.ajax({
                    url: "{{ route('imaging.listupload.delete') }}",
                    type: 'POST',
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'id': iddel
                    },
                    success: function(respon) {
                        if (respon.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: respon.message,
                                onClose: () => {
                                    window.location.reload();
                                }
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: respon.message,
                                onClose: () => {
                                    window.location.reload();
                                }
                            })
                        }

                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            onClose: () => {
                                window.location.reload();
                            }
                        })
                    }
                });
            }
        })
    }

    $(function() {
        $('#example1').DataTable();

        $('.select2').select2();
        //Date picker
        $('.datepicker').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });

        $('#form-item').submit(function(e) {
            e.preventDefault();
            var url = "{{ route('imaging.listupload.savefile') }}";
            var formData = new FormData($('#form-item')[0]);
            //showLoad();
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    //alert(JSON.stringify(response));
                    //hideLoad();
                    if (response.status == 200) {
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            html: response.info_path,
                            onClose: () => {
                                window.location.reload();
                            }
                        });
                    } else {
                        if (response.status == 302) {
                            var errors = '';
                            for (var i = 0, l = response.error.length; i < l; i++) {
                                errors += "<p>" + response.error[i] + "</p>";
                            }
                            Swal.fire({
                                icon: 'error',
                                title: response.message + " " + response.error,
                                text: errors
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: response.message,
                                onClose: () => {

                                }
                            });
                        }
                    }
                },
                error: function(response) {
                    //hideLoad();
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                    });
                }
            });
        });
    });
</script>
@endsection