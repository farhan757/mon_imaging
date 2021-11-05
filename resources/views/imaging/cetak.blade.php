<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cetak List Manifest {{ $nomanifest }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    @include('layouts.css')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link href='https://fonts.googleapis.com/css?family=Libre Barcode 39' rel='stylesheet'>
    <style>
        .barcode {
            font-family: 'Libre Barcode 39';
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i> Galva Technovision
                        <small class="pull-right">Date: {{ date('Y-m-d') }}</small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-5 invoice-col">
                    <dl class="dl-horizontal">
                        <dt class="col-2" style="text-align: left;">Customer</dt>
                        <dd class="col-16" style="text-align: left;">{{ $data->customer_name }}</dd>
                        <dt class="col-2" style="text-align: left;">Departement</dt>
                        <dd class="col-16" style="text-align: left;">{{ $data->product_name }}</dd>
                        <dt class="col-2" style="text-align: left;">Cycle</dt>
                        <dd class="col-16" style="text-align: left;">{{ $data->cycle }}</dd>
                    </dl>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">

                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>MANIFEST #{{ $nomanifest }}</b><br>
                    <p class="barcode">*{{ $nomanifest }}*</p>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th>No Polis</th>
                                <th>No SPAJ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detail as $val)
                            <tr>
                                <td>{{ $val->no_account }}</td>
                                <td>{{ $val->no_spaj }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">

                <div class="col-xs-6">
                    <p>Jakarta, {{ date('d F Y') }}</p>
                </div>
                <!-- /.col -->
            </div>

            <div class="row">
                <div class="col-xs-3" style="text-align: center;">
                    
                    <p>Yang Mengerjakan</p><br><br>
                    <p>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</p>

                </div>
                <div class="col-xs-3" style="text-align: center;">
                    
                    <p>QC</p><br><br>
                    <p>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</p>

                </div>
            </div>

            <div class="row">
                <div class="row no-print">
                    <div class="col-xs-12">
                        <br><br><a onclick="window.print()" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
</body>

</html>