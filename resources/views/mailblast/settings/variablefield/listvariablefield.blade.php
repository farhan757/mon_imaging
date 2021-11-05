@extends('layouts.master')

@section('tittle_bar','Mail Blast')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Settings
            <small>List Variable Field</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
            <li><a href="#" class="active">List Variable Field</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- /.box-body -->
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">                    
                    <a href="{{ route('settings.variablefield.newform') }}" type="button" class="btn bg-olive margin" ><span class="fa fa-plus"></span> Add Variable Field</a>                    
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="card-body table-responsive p-0">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>                                   
                                <th>Create by</th> 
                                <th>Created at</th>                             
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>
                                    {{ $value->name }}
                                </td>   
                                <td>
                                    {{ $value->user_name }}
                                </td>   
                                <td>
                                    {{ $value->created_at }}
                                </td>                                                           
                                <td>
                                <a title="Edit" href="{{ route('settings.variablefield.edit',$value->id) }}" ><span class="fa  fa-edit"></span> </a>                                    
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
                    url: "{{ route('settings.variablefield.delete') }}",
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
    });
</script>
@endsection