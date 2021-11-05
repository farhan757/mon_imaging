@extends('layouts.master')

@section('tittle_bar','Imaging')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Mail Blast
            <small>List Data Mail Blast</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-file-envlope-o"></i> Mail Blast</a></li>
            <li><a href="#" class="active">List Mail Blast</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- /.box-body -->
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">
                    @if(Auth::user()->group_id == 1)
                    <button type="button" class="btn bg-olive margin" data-toggle="modal" data-target="#modal-default"><span class="fa fa-upload"></span> List Mail Blast</button>
                    @endif
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="card-body table-responsive p-0">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name Product</th>
                                <th>Cycle/Part</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                <td>{{ $value->product_name }}</td>
                                <td>
                                    {{ $value->cycle }}/{{ $value->batch }}
                                </td>
                                <td>{{ $value->created_at }}</td>
                                <td>
                                    <a title="Detail" href="{{ route('startmail.detail',Crypt::encrypt($value->id)) }}" data-toggle="modal" data-target="#modal-default-detail{{$value->id}}"><span class="fa  fa-sticky-note-o"></span> </a>                                    
                                    @if(Auth::user()->group_id == 1)
                                    <a title="Delete" href="#" onclick="deleteList('{{ $value->id }}')"><span class="fa fa-remove"></span> </a>
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
@include('mailblast.startemail.formupload')

@foreach($data as $value)
<div class="modal fade" id="modal-default-detail{{ $value->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="title-detail"><span class="fa fa-edit"></span> Detail {{ $value->file_name_upload }} </h4>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endforeach

@endsection

@section('js')
<script>
    function deleteList(id) {
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
                    url: "{{ route('startmail.delete') }}",
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

        var dataTable = $('#example1').DataTable({
            'processing': true,
        });

        $('.select2').select2();
        //Date picker
        $('.datepicker').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });

        $('#form-item').submit(function(e) {
            e.preventDefault();
            var url = "{{ route('startmail.upload') }}";
            var formData = new FormData($('#form-item')[0]);
            //showLoad();

            Swal.fire({
                title: 'Form Upload List Email',
                text: 'Yakin Mau Lanjut Upload ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Lanjut !',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            $('#process').css('display', 'block');
                            var percentage = 0;

                            var timer = setInterval(function() {
                                percentage = percentage + 20;
                                progress_bar_process(percentage, timer);
                            }, 500);
                        },
                        success: function(response) {
                            //alert(JSON.stringify(response));
                            //hideLoad(); 
                            if (response.status == 200) {
                                var percentage = 100;

                                var timer = setInterval(function() {
                                    percentage = percentage;
                                    progress_bar_process(percentage, timer, response);
                                }, 500);
                            } else {
                                if (response.status == 302) {
                                    var errors = '';
                                    for (var i = 0, l = response.error.length; i < l; i++) {
                                        errors += "<p>" + response.error[i] + "</p>";
                                    }
                                    Swal.fire({
                                        icon: 'error',
                                        title: response.message + " ?? " + response.error,
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
                }
            });
        });

        function progress_bar_process(percentage, timer, response = null) {
            $('.progress-bar').css('width', percentage + '%');
            if (percentage == 100) {

                if (response != null) {
                    clearInterval(timer);
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        html: response.info_path,
                        onClose: () => {
                            window.location.reload();
                            $('#form-item')[0].reset();
                            $('#process').css('display', 'none');
                            $('.progress-bar').css('width', percentage + '%');
                        }
                    });
                }
            }
        }
    });
</script>
@endsection