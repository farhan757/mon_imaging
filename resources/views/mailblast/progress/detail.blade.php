@include('layouts.css')

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="title-detail"><span class="fa fa-edit"></span> Detail {{ $data->account }} </h4>
</div>
<div class="modal-body">
    <dl class="dl-horizontal">
        <dt class="col-4" style="text-align: left;">Name</dt>
        <dd class="col-8" style="text-align: left;" id="name">{{ $data->name }}</dd>
        <dt class="col-4" style="text-align: left;">Account</dt>
        <dd class="col-8" style="text-align: left;" id="account">{{ $data->account }}</dd>
        <dt class="col-4" style="text-align: left;">SPAJ</dt>
        <dd class="col-8" style="text-align: left;" id="spaj">{{ $data->no_spaj }}</dd>
        <dt class="col-4" style="text-align: left;">To</dt>
        <dd class="col-8" style="text-align: left;" id="to">{{ $data->to }}</dd>
        <dt class="col-4" style="text-align: left;">Sent at</dt>
        <dd class="col-8" style="text-align: left;" id="sent_at">{{ $data->send_at }}</dd>
        <dt class="col-4" style="text-align: left;">Approved by</dt>
        <dd class="col-8" style="text-align: left;" id="by">{{ $data->username }}</dd>
        <dt class="col-4" style="text-align: left;">Approve at</dt>
        <dd class="col-8" style="text-align: left;" id="app_at">{{ $data->created_at }}</dd>
        <dt class="col-4" style="text-align: left;">Message</dt>
        <dd class="col-8" style="text-align: left;" id="error"><p align="justify" style="text-align: left; color: red;" class="col-8" id="msg">{{ $data->msg_error_send }}</p></dd>
    </dl>        
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>

<script>
    $(function() {
        $('.example2').DataTable();
    });
</script>