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
                    <th>No SPAJ</th>
                    <th>Name</th>
                    <th>To</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="tbody">
                @foreach($detail as $value)
                <tr>
                    <td>{{ $value->account }}</td>
                    <td>{{ $value->no_spaj }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->to }}</td>
                    <!--<td><a href="#" onclick="viewpdf({{ $value->id }})" class="btn bg-green btn-xs" id="viewpdf"> <span class="fa fa-eye"></span> View PDF</a> </td>-->
                    <td>
                        @if($value->app == 1)
                            Approved
                        @else
                            Waiting Approval
                        @endif
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