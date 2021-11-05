<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><span class="fa fa-edit"></span> Form Upload File</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" name="form-item" id="form-item" method="POST" enctype="multipart/form-data">
                    @csrf()
                    <div class="box-body">
                        <div class="form-group">
                            <label for="selectCustomer" class="col-sm-3">Product</label>
                            <div class="col-sm-6">
                                <select class="form-control select2" style="width: 100%;" placeholder="pilih product" id="product_id" name="product_id" required>
                                    @foreach($product as $value)
                                    <option value="{{ $value->id }}">{{ $value->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cycle" class="col-sm-3 ">Cycle</label>

                            <div class="col-sm-6">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right datepicker" id="cycle" name="cycle" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="part" class="col-sm-3 ">Batch</label>

                            <div class="col-sm-6">
                                <select class="form-control select2" style="width: 100%;" placeholder="pilih part" id="part" name="part" required>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputfile" class="col-sm-3">Input List Email</label>

                            <div class="col-sm-6">
                                <div class="input-group upload">
                                    <div class="input-group-addon">
                                        <i class="fa fa-upload"></i>
                                    </div>
                                    <input type="file" class="form-control" id="file" name="file" required>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                        <button type="submit" class="btn btn-info pull-right"><span class="glyphicon glyphicon-upload"></span> Submit</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
                <div class="form-group" id="process" style="display:none;">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->