@include('layouts.css')

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="title-detail"><span class="fa fa-edit"></span> Detail Claim {{ $value->no_account }} </h4>
</div>
<div class="modal-body">
    <div class="card-body table-responsive p-0">
        <table class="table table-bordered table-striped example2">
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



<script>
    $(function() {
        $('.example2').DataTable();
    });
</script>