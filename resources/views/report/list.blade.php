@extends('layouts.master')

@section('tittle_bar','Report')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Report
            <small>List Detail Report</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-line-chart"></i> Report</a></li>
            <li><a href="#" class="active">List Detail Report</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- /.box-body -->
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
                            <label class="col-sm-2">No Box</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="nobox" name="nobox" value="{{ $nobox ?? '' }}" placeholder="Enter No Box">
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
                                    <option value="{{ $value->id }}" 
                                        @if(isset($product_id))
                                            @if($value->id == $product_id)
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
                                    <option value="10"
                                        @if(isset($paginate))
                                            @if($paginate == 10)
                                                selected
                                            @endif
                                        @endif                                     
                                    >10</option>
                                    <option value="25"
                                        @if(isset($paginate))
                                            @if($paginate == 25)
                                                selected
                                            @endif
                                        @endif                                     
                                    >25</option>
                                    <option value="50"
                                     @if(isset($paginate))
                                            @if($paginate == 50)
                                                selected
                                            @endif
                                        @endif                                     
                                    >50</option>
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

        <div class="box box-success">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nomor Polis</th>
                                <th>Tanggal Scan</th>
                                <th>Cycle</th>
                                <th>No Box</th>
                                <th>No Doc</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                <td>{{ $value->no_account }}</td>
                                <td>{{ $value->tgl_scan }}</td>
                                <td>
                                    {{ $value->cycle }}
                                </td>
                                <td>{{ $value->no_box }}</td>
                                <td>{{ $value->no_doc }}</td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                    {{ $data->links() }}
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