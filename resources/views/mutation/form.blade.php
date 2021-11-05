@extends('layouts.master')

@section('tittle_bar','Mutation')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Mutation
            <small>Form Mutation</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-exchange"></i> Mutation</a></li>
            <li><a href="#" class="active">Form Mutation</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

                @if(session()->get('msg'))
                    @if(Session::get('msg')['status'] == 1)
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i> Alert!</h4>
                            {{ Session::get('msg')['message'] }} <a href="#" target="_blank" class="btn btn-block btn-info btn-sm"><span class="fa fa-print"></span> {{ Session::get('msg')['no_bast'] }}</a>
                        </div>
                    @else
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                            {{ Session::get('msg')['message'] }}
                        </div>
                    @endif
                @endif    
        <!-- /.box-body -->
        <div class="box box-success">
            <div class="box-body">
                <form role="form" class="form-horizontal" method="post" action="">
                    @csrf()
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2">No Box</label>
                            <div class="col-sm-5">
                                <select class="form-control select2" name="nobox[]" id="nobox[]" multiple="multiple" data-placeholder=" Select No Box">
                                    @foreach($nobox as $value)
                                    <option value="{{ $value->no_box }}">{{ $value->no_box }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="selectCustomer" class="col-sm-2">Pos Location</label>
                            <div class="col-sm-3">
                                <select class="form-control select2" data-placeholder="pilih pos" id="pos" name="pos">
                                    @foreach($pos as $value)
                                    <option value="{{ $value->id }}">{{ $value->pos_name }} [{{ $value->pos_lokasi }}]</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="selectCustomer" class="col-sm-2">Pick up By</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="pu" id="pu" placeholder="Input pickup name">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" value="submit" id="submit" name="submit"><span class="fa fa-send"></span> Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.container -->

@endsection

@section('js')
<script>
    $(function() {
        $('.select2').select2();
        //Date picker
        $('.datepicker').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });
    });
</script>
@endsection