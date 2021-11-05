@extends('layouts.master')

@section('tittle_bar','Sales')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Settings
            <small>Form Variable Field</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
            <li><a href="#" class="active">Form Variable Field</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- /.box-body -->
        <div class="box box-success">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">

                            <div class="card-body">
                                <form method="POST" action="@if(isset($data)) {{ route('settings.variablefield.save') }} @else {{ route('settings.variablefield.submit') }} @endif">
                                    @csrf
                                    <input type="hidden" name="id" id="id" value="{{ $data->id ?? '' }}">
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nama Variable Master') }}</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control" name="name" value="{{ $data->name ?? '' }}" required autocomplete="name" autofocus>
                                        </div>
                                    </div>

                                    <div class="card-body table-responsive p-0" style="height: 400px;">
                                        <table class="table table-bordered" style="font-size:12px;">
                                            <thead>
                                                <tr>
                                                    <th width="24%">Variable</th>
                                                    <th width="24%">Field</th>
                                                    <th width="1%">Action</th>
                                                </tr>
                                            </thead>

                                            <input type="hidden" id="sdf" value=0>
                                            <tbody id="data-input">

                                                @php
                                                $x = 1;
                                                @endphp
                                                @if(isset($detail))
                                                @foreach ($detail as $row)
                                                <tr id="row{{ $x }}">
                                                    <td><input type="text" name="nm_variable[]" class="form-control" value="{{ $row->nm_variable }}" /></td>
                                                    <td>                                                        
                                                        <select name="nm_field[]" id="nm_field" class="form-control">
                                                            @foreach($field as $val)
                                                            <option value="{{ $val }}" 
                                                                @if(isset($data))
                                                                    @if($val == $row->nm_field)
                                                                    selected
                                                                    @endif
                                                                @endif
                                                                >{{ $val }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td><a href="#" class="btn btn-danger hapus-baris" id="{{ $x }}"><i class="fa fa-trash"></i></a></td>
                                                </tr>
                                                @php
                                                $x++;
                                                @endphp
                                                @endforeach
                                                @endif
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="2" align="right" style="font-weight: bold;"></th>
                                                    <th><a id="addForm" class="btn btn-primary"><span class="fa fa-plus"></span></a></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                @if(isset($data))
                                                {{ __('Save') }}
                                                @else
                                                {{ __('Add') }}
                                                @endif
                                            </button>
                                            <a href="{{ route('settings.variablefield') }}" class="btn btn-primary">
                                                {{ __('Back') }}
                                            </a>
                                        </div>
                                    </div>                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.container -->
@stop

@section('js')
<script>
    $(function() {
        var urutan = 0;
        $('#addForm').on("click", function() {
            data_form = "{{ route('settings.variablefield.addform') }}";
            //no = parseInt($('#sdf').val());      
            urutan++; //= no + 1;
            ke = 1;
            ke = ke + 1;
            $.get(data_form, {
                id: urutan
            }, function(data) {
                $('#data-input').append(data);
                $('#sdf').val(urutan);
            });
        });

        $('.hapus-baris').on("click", function() {
		id = this.id;

		$('#row' + id).remove();

        
	});
        
    });
</script>
@stop