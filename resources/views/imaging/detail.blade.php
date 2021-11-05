@include('layouts.css')

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="title-detail"><span class="fa fa-edit"></span> Detail {{ $value->file_name_upload }} </h4>
</div>
<div class="modal-body">
    <div class="card-body table-responsive p-0">
        <table class="table table-bordered table-striped example2">
            <thead>
                <tr>
                    <th>No Account</th>
                    <th>No Box</th>
                    <th>No Doc</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                @foreach($detail as $value)
                <tr>
                    <td>{{ $value->no_account }}</td>
                    <td>{{ $value->no_box }}</td>
                    <td>{{ $value->no_doc }}</td>
                    <!--<td><a href="#" onclick="viewpdf({{ $value->id }})" class="btn bg-green btn-xs" id="viewpdf"> <span class="fa fa-eye"></span> View PDF</a> </td>-->
                    <td>
                        <div class="input-group-btn margin">
                            <button type="button" class="btn bg-yellow btn-xs dropdown-toggle" data-toggle="dropdown"><span class="fa fa-hand-o-up"></span> View PDF
                                <span class="fa fa-caret-down"></span></button>
                            <ul class="dropdown-menu">
                                @inject('getfile','App\Http\Controllers\Imaging\UploadController')
                                @foreach($getfile->getfile($value->no_account) as $treeview)
                                <li><a href="{{ route('imaging.listupload.renderView',['id'=>$treeview->id,'nmfile'=>$treeview->file_name]) }}" target="_safe">
                                        @if(file_exists($getfile->pathPdf.'/'.$treeview->path_file.'/'.$value->no_account.'/'.$treeview->file_name))
                                        <span class="fa fa-check-circle success"></span>
                                        @else
                                        <span class="fa fa-remove danger"></span>
                                        @endif
                                        {{ $treeview->file_name }}
                                    </a>                                    
                                </li>
                                @endforeach
                            </ul>
                        </div>
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