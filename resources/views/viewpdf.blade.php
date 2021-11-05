<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>View PDF</title>
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
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link href='https://fonts.googleapis.com/css?family=Libre Barcode 39' rel='stylesheet'>
    <script type="text/javascript" src="{{ asset('assets/blocked.js') }}"></script>
    <style>
        .barcode {
            font-family: 'Libre Barcode 39';
            font-size: 35px;
        }
    </style>
</head>

<body>

    @if(isset($id))
        <iframe src="{{ route('imaging.listupload.viewpdf',['id'=>$id,'nmfile'=>$nmfile]) }}#readonly=true;" width="100%" height="100%"></iframe>
    @else
        <iframe src="{{ route('viewpdflangsung',['cycle'=>$cycle,'nopolis'=>$nopol,'nmfile'=>$nmfile]) }}#readonly=true;" width="100%" height="100%"></iframe>
    @endif
</body>

</html>