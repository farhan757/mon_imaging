@extends('layouts.master')

@section('tittle_bar','List Mutation')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Mutation
            <small>List Mutation</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-exchange"></i> Mutation</a></li>
            <li><a href="#" class="active">List Mutation</a></li>
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
                            <label class="col-sm-2">No BAST</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="nobast" name="nobast" value="{{ $nobast ?? '' }}" placeholder="Enter No BAST">
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
                                <th>No Bast</th>
                                <th>Jumlah Box</th>
                                <th>Created At</th>
                                <th>Pick Up By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                <td>{{ $value->no_bast }}</td>
                                <td>{{ $value->jml_box }}</td>
                                <td>
                                    {{ $value->created_at }}
                                </td>
                                <td>{{ $value->pickupBy }}</td>
                                <td><a href="{{ route('mutation.cetak',$value->no_bast) }}" target="_blank"><span class="fa fa-print"></span> Print</a></td>
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