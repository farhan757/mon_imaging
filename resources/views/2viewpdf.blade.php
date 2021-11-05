<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="title-detail"><span class="fa fa-edit"></span>  </h4>
</div>
<div class="modal-body">
    <div class="card-body table-responsive p-0" >
        <embed onload="disableContextMenu();" onMyLoad="disableContextMenu();" src="{{ route('imaging.listupload.viewpdf',['id'=>$id,'nmfile'=>$nmfile]) }}#toolbar=0&readonly=true;" width="100%" height="800px"></embed>
    </div>
</div>