@extends('layouts.master')

@section('tittle_bar')
  Imaging Detail POS ({{ $kriteria }})
@endsection

@section('content')
<div class="container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Imaging
      <small>Detail POS ({{ $kriteria }}) cycle {{ $value->cycle }}</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-file-image-o"></i> Imaging</a></li>
      <li><a href="{{ route('imaging.pos.list') }}" class="fa fa-file-image-o"></i> List POS</a></li>
      <li><a href="#" class="active">Detail POS ({{ $kriteria }})</a></li>
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
        <div class="card-body table-responsive p-0">
          <table id="example1" class="table table-bordered table-striped example2">
            <thead>
              <tr>
                <th>Nama Dokumen</th>
                <th>No Box</th>
                <th>No Doc</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="tbody">
              @inject('getfile','App\Http\Controllers\Imaging\UploadController')
              @foreach($detail as $value)
              <tr>
                <td>
                  @if(file_exists($getfile->pathPdf.'/'.$value->path_file.'/'.$value->no_account.'/'.$value->file_name))
                  <span class="fa fa-check-circle success"> </span>
                  @else
                  <span class="fa fa-remove danger"> </span>
                  @endif
                  {{ $value->file_name }}
                </td>
                <td>{{ $value->no_box }}</td>
                <td>{{ $value->no_doc }}</td>
                <!--<td><a href="#" onclick="viewpdf({{ $value->id }})" class="btn bg-green btn-xs" id="viewpdf"> <span class="fa fa-eye"></span> View PDF</a> </td>-->
                <td>
                  <a class="btn bg-green btn-xs" href="{{ route('imaging.listupload.renderView',['id'=>$value->id,'nmfile'=>$value->file_name]) }}" target="_blank">
                    <span class="fa fa-eye"></span>
                    View PDF
                  </a>
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
  $(function() {
    var dataTable = $('#example1').DataTable({
      'processing': true,
    });
  });
</script>
@endsection