@extends('layouts.master')

@section('tittle_bar','Imaging')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Mail Blast
            <small>List Data Mail Progress</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-file-envlope-o"></i> Mail Blast</a></li>
            <li><a href="#" class="active">List Mail Progress</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box box-success">
            <div class="box-body">
                <form role="form" class="form-horizontal">
                    @csrf()
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2">Nomor Polis</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="noaccount" name="noaccount" value="{{ $noaccount ?? '' }}" placeholder="Enter No Account">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2">No SPAJ</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="nospaj" name="nospaj" value="{{ $nospaj ?? '' }}" placeholder="Enter No SPAJ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2">Cycle</label>
                            <div class="col-sm-3">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control datepicker" placeholder="From" id="cycle" name="cycle" value="{{ $cycle ?? '' }}">
                                    <input type="text" class="form-control datepicker" placeholder="End" id="cycle2" name="cycle2" value="{{ $cycle2 ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="selectCustomer" class="col-sm-2">Departemen</label>
                            <div class="col-sm-3">
                                <select class="form-control select2" placeholder="pilih product" id="product_id" name="product_id">
                                    <option value="">All</option>
                                    @foreach($product as $value)
                                    <option value="{{ $value->id }}" @if(isset($product_id)) @if($value->id == $product_id)
                                        selected
                                        @endif
                                        @endif
                                        >{{ $value->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2">Paginate</label>
                            <div class="col-sm-3">
                                <select class="form-control select2" name="paginate" id="paginate">
                                    <option value="10" @if(isset($paginate)) @if($paginate==10) selected @endif @endif>10</option>
                                    <option value="25" @if(isset($paginate)) @if($paginate==25) selected @endif @endif>25</option>
                                    <option value="50" @if(isset($paginate)) @if($paginate==50) selected @endif @endif>50</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" value="submit" id="submit" name="submit"><span class="fa fa-send"></span> Submit</button>
                        <button type="submit" class="btn btn-primary" value="export" id="submit" name="submit"><span class="fa fa-download"></span> Export</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">

                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Department</th>
                                <th>No Account/No SPAJ</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status Sent</th>
                                <th>Cycle</th>
                                <th>Read Count</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                <td>{{ $value->product_name }}</td>
                                <td>
                                    {{ $value->account }}/{{ $value->no_spaj }}
                                </td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->to }}</td>
                                <td>
                                    @if($value->sent == 1)
                                    <a title="Success" href="#" class="fa fa-check bg-green"></a>
                                    @else
                                    @if($value->sent == 0)
                                    <a title="Sending.." href="#" class="fa fa-clock-o bg-gray"></a>
                                    @else
                                    <a title="{{ $value->msg_error_send }}" href="#" class="fa fa-remove bg-red"></a>
                                    @endif
                                    @endif
                                </td>
                                <td>{{ $value->cycle }}</td>
                                <td>{{$value->read}}</td>
                                <td>
                                    <a title="Detail" href="{{ route('progress.detail',Crypt::encrypt($value->id)) }}" data-toggle="modal" data-target="#modal-default-detail{{$value->id}}"><span class="fa  fa-sticky-note-o"></span> </a>
                                    @if(Auth::user()->group_id == 1)
                                    <a title="Resend Mail" href="#" onclick="resending('{{ $value->id }}')"><span class="fa fa-send-o"></span> </a>
                                    @endif

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $data->withQueryString()->links() }}
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.container -->

@include('mailblast.progress.formresend')

@foreach($data as $value)
<div class="modal fade" id="modal-default-detail{{ $value->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="title-detail"><span class="fa fa-edit"></span> Detail </h4>
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
    function resending(id) {

        $.ajax({
            url: "{{ route('progress.formresend') }}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id
            },
            dataType: "JSON",
            success: function(data) {
                console.log(data);
                $('#modalresend').modal('show');
                $('#myModalhead').text('Resending ' + data.data.account);

                $('#id').val(data.data.id);
                //reset();

            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'No Data Found',
                });
                //hideLoad();
                //reset()
            }
        });
    }

    function submitResend() {
        var id = $('#id').val();
        var email = $('#email').val();
        var desc = $('#desc').val();
        //showLoad();

        $.ajax({
            url: "{{ route('progress.resend') }}",
            type: "POST",
            data: {
                'id': id,
                'email': email,
                'desc': desc,
                "_token": "{{ csrf_token() }}",
            },
            success: function(data) {
                if (data.status == 200) {
                    Swal.fire({
                        icon: 'success',
                        title: data.message,
                        onClose: () => {
                            window.location.reload();
                        }
                    });
                } else if (data.status == 500) {
                    Swal.fire({
                        icon: 'error',
                        title: data.message,
                        onClose: () => {
                            window.location.reload();
                        }
                    });
                }
                //hideLoad();
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'error',
                    onClose: () => {
                        window.location.reload();
                    }
                });
                //hideLoad();
            }
        });
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