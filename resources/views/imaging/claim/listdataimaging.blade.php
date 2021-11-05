@extends('layouts.master')

@section('tittle_bar','Imaging Claim')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Imaging
            <small>List Data Claim</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-file-image-o"></i> Imaging</a></li>
            <li><a href="#" class="active">List Claim</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- /.box-body -->
        <div class="box box-success">
            <div class="box-header with-border">
                @if(Auth::user()->group_id != 3)
                <div class="box-header with-border">
                    <form action="" method="get" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="row" style="padding-bottom: 5px">
                            <div class="col-sm-2">
                                <input type="text" class="form-control pull-right cycle" name="cycfrom" id="cycfrom" value="{{ $cycfrom ?? '' }}" placeholder="Cycle From">
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control pull-right cycle" name="cycto" id="cycto" value="{{ $cycto ?? '' }}" placeholder="Cycle To">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" name="download" id="download" value="download" class="btn btn-default" @if(count($data)==0) disabled @endif><i class="fa fa-download"></i> Download Zip PDF</button>
                            </div>
                        </div>
                    </form>
                </div>
                @endif
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="card-body table-responsive p-0">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nomor Polis</th>
                                <th>Nomor SPAJ</th>
                                <th>Cycle</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                <td>{{ $value->no_account }}</td>
                                <td>
                                    {{ $value->no_spaj }}
                                </td>
                                <td>{{ $value->cycle }}</td>
                                <td>{{ $value->created_at }}</td>
                                <td>
                                    <a title="Detail" href="{{ route('imaging.claim.detail',['id'=>$value->id_master,'nopol'=>$value->no_account]) }}" data-toggle="modal" data-target="#modal-default-detail{{$value->id}}"><span class="fa  fa-sticky-note-o"></span> </a>
                                    @if(Auth::user()->group_id == 1)
                                    <a title="Delete" href="#" onclick="deleteList({{ $value->id_master }},'{{ $value->no_account }}', '{{ $value->cycle }}')"><span class="fa fa-remove"></span> </a>
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

@foreach($data as $value)
<div class="modal fade" id="modal-default-detail{{ $value->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="title-detail"><span class="fa fa-edit"></span> Detail Claim {{ $value->no_account }} </h4>
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
    $('.cycle').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd"
    });

    function deleteList(id, nopol, cycle) {
        var iddel = id;
        var xnopol = nopol;
        var xcyc = cycle;
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
                    url: "{{ route('imaging.claim.delete') }}",
                    type: 'POST',
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'id': iddel,
                        'nopol': xnopol,
                        'cycle': xcyc
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