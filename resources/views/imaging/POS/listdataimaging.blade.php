@extends('layouts.master')

@section('tittle_bar','Imaging POS')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Imaging
            <small>List Data POS</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-file-image-o"></i> Imaging</a></li>
            <li><a href="#" class="active">List POS</a></li>
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
                                <th>Nama Dokumen</th>
                                <th>Nama Kriteria</th>
                                <th>Cycle</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @inject('getfile','App\Http\Controllers\Imaging\UploadController')
                            @foreach($data as $value)
                            <tr>
                                <td>{{ $value->no_account }}</td>
                                <td>
                                    @if(file_exists($getfile->pathPdf.'/'.$value->path_file.'/'.$value->no_account.'/'.$value->file_name))
                                        <a href="#" title="File Pdf Sudah Diupload"><span class="fa fa-check bg-green"> </span> {{ $value->file_name }}</a>
                                    @else
                                        <a href="#" title="File Pdf Belum Diupload"><span class="fa fa-remove bg-red"> </span> {{ $value->file_name }}</a>
                                    @endif
                                    
                                </td>                                
                                <td>
                                    {{ $value->nama_kriteria }}
                                </td>
                                <td>{{ $value->cycle }}</td>
                                <td>{{ $value->created_at }}</td>
                                <td>
                                    <a class="btn bg-green btn-xs" href="{{ route('imaging.listupload.renderView',['id'=>$value->id,'nmfile'=>$value->file_name]) }}" target="_blank">
                                        <span class="fa fa-file-pdf-o"></span>
                                        PDF
                                    </a>                                                                        
                                    @if(Auth::user()->group_id == 1)
                                        <a title="Delete" href="#" onclick="deleteList({{ $value->id }})"><span class="fa fa-remove"></span> </a>
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
    $('.cycle').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd"
    });

    function deleteList(id) {
        var iddel = id;
        //var xnopol = nopol;
        //var xcyc = cycle;
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
                    url: "{{ route('imaging.pos.delete') }}",
                    type: 'POST',
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'id': iddel,
                        //'nopol': xnopol,
                        //'cycle': xcyc
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