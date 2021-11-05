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
            <li><a href="#"><i class="fa fa-gear"></i> Mail Blast</a></li>
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
                    <a href="{{ route('settings.bodyemail.show') }}" class="btn bg-olive margin" ><span class="fa fa-plus"></span> Add Body Email</a>
                    @endif
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="card-body table-responsive p-0">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>                                
                                <th>Desc</th>
                                <th>Subject</th>
                                <th>Create/Update By</th>
                                <th>Create at</th>
                                <th>Update at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>
                                    {{ $value->desc }}
                                </td>
                                <td>{{ $value->subject }}</td>
                                <td>{{ $value->username }}</td>
                                <td>{{ $value->created_at }}</td>
                                <td>{{ $value->updated_at }}</td>
                                <td>
                                    <a title="Edit" href="{{ route('settings.bodyemail.showid',$value->id) }}" ><span class="fa  fa-edit"></span> </a>                                    
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
                    url: "{{ route('settings.bodyemail.delete') }}",
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

    });
</script>
@endsection