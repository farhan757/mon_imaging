<div class="modal fade" id="modalresend">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalhead">Default Modal</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" name="form-item" id="form-item" method="POST" enctype="multipart/form-data">
                    @csrf()
                    <input type="hidden" name="id" id="id">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="selectCustomer" class="col-sm-3">Email</label>
                            <div class="col-sm-6">
                                <input type="email" class="form-control pull-right" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cycle" class="col-sm-3 ">Desc</label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control pull-right" id="desc" name="desc" required>
                            </div>
                        </div>                        
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" onclick="submitResend()" class="btn btn-primary">Send</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->