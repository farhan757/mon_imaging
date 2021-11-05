@extends('layouts.master')

@section('tittle_bar','Settings')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Settings
            <small>Form Body Email</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
            <li><a href="#" class="active">Form Body Email</a></li>
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
                    <div class="col-md-12">
                        <div class="card">

                            <div class="card-body pad">
                                <form method="POST" action="@if(isset($data)) {{ route('settings.bodyemail.update',$data->id) }}  @else {{ route('settings.bodyemail.save') }} @endif">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                                    <div class="form-group row">
                                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Variable Field') }}</label>

                                        <div class="col-md-6">
                                            <select class="form-control select2" onchange="getSet()" style="width: 100%;" placeholder="Select here" id="setting" name="setting" required>
                                                <option value="0">Select here</option>
                                                @foreach($setting as $value)
                                                <option value="{{ $value->id }}" @if(isset($data)) @if($data->mv_id == $value->id)
                                                    selected
                                                    @endif
                                                    @endif
                                                    >{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Detail Variable') }}</label>

                                        <div class="col-md-6">
                                            <div class="callout callout">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Variable Name</th>
                                                            <th>Field Name</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="keterangan">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Subject Email') }}</label>

                                        <div class="col-md-6">
                                            <input id="subject" type="text" class="form-control @error('name') is-invalid @enderror" name="subject" required autocomplete="subject" value="{{ $data->subject ?? '' }}" autofocus> </input>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Desc') }}</label>

                                        <div class="col-md-6">
                                            <textarea id="desc" type="text" class="form-control @error('name') is-invalid @enderror" name="desc" required autocomplete="desc" autofocus>{{ $data->desc ?? '' }} </textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Body Email') }}</label>
                                        <div class="col-md-10 offset-md-10">
                                            <textarea id="konten" name="konten" cols="80" rows="80">{{ $data->body_mail ?? '' }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <a href="{{ route('settings.bodyemail') }}" class="btn btn-primary">
                                                {{ __('Cancel') }}
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
<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('assets/ckeditor/adapters/jquery.js')}}"></script>
<script>
    var url = 'bodyemail';
    var route_prefix = "{{ url('') }}/filemanager";
    editor();

    function editor() {
        var konten = document.getElementById("konten");
        CKEDITOR.replace(konten, {


            filebrowserImageBrowseUrl: route_prefix + '?type=Images',
            filebrowserImageUploadUrl: route_prefix + '/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: route_prefix + '?type=Files',
            filebrowserUploadUrl: route_prefix + '/upload?type=Files&_token={{csrf_token()}}'
        });
        CKEDITOR.config.allowedContent = true;
    }
    getSet();

    function getSet() {
        var id = $('#setting').val();
        $.ajax({
            url: "{{ route('getset') }}",
            type: "POST",
            data: {
                '_token': "{{ csrf_token() }}",
                "id": id,
            },
            success: function(data) {
                var tmp = "";
                $.each(data.data, function(index, value) {
                    tmp += "<tr>";
                    tmp += "<td>" + value['nm_variable'] + "</td>";
                    tmp += "<td>" + value['nm_field'] + "</td>";
                    tmp += "</tr>";
                });
                $('#keterangan').replaceWith($('#keterangan').html(tmp));
            }
        });
    }
</script>
@endsection