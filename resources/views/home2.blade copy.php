@extends('layouts.master')

@section('tittle_bar','Home')

@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Home
            <small>Info 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Info</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="glyphicon glyphicon-book"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Document</span>
                        <span class="info-box-number" id="doc">0</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-file-pdf-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Pages</span>
                        <span class="info-box-number" id="pages">0</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-eye"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">View File</span>
                        <span class="info-box-number" id="v_view">0</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>-->
        <!-- /.row -->

        <!-- BASIC FORM ELELEMNTS -->
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Grafik</h3>
            </div>
            <div class="box-body">
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="col-sm-2">
                            <select class="form-control select2" name="prod_id" id="prod_id">
                                <option value="1">Document</option>
                                <option value="2">Pages</option>
                                <option value="3">View PDF</option>
                            </select>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <div class='input-group date datepicker' id='datetimepicker1'>
                                        <input type='text' class="form-control" id="cycle1" name="cycle1" placeholder="From Date" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class='input-group date datepicker' id='datetimepicker2'>
                                        <input type='text' class="form-control" id="cycle2" name="cycle2" placeholder="End Date" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="btn-group">
                                <button id="btnDaily" type="button" class="btn btn-default">Daily</button>
                                <button id="btnMonthly" type="button" class="btn btn-default">Monthly</button>
                                <button id="btnYearly" type="button" class="btn btn-default">Yearly</button>
                            </div>
                            <button id="apply" class="btn btn-primary">Apply</button>
                        </div>
                        <div class="panel-body text-center">
                            <canvas id="canvas"></canvas>
                        </div>
                    </div>
                </div><!-- /row -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.container -->
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('vendor/chart.js/Chart.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/chart.js/Chart.min.css') }}">
@stop

@section('js')
<script src="{{ asset('vendor/chart.js/Chart.bundle.js') }}"></script>
<script src="{{ asset('vendor/chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('vendor/chart.js/Chart.js') }}"></script>
<script>

    setInterval(function(){
      showGrafik();
    }, 500000);

    $.get('get-doc', function(data,status){
        $('#doc').text(data);
    });

    $.get('get-pages', function(data,status){
        $('#pages').text(data);
    });

    $.get('get-viewpdf', function(data,status){
        $('#v_view').text(data);
    });

    var method = "year";
    function showGrafik()
    {
            
            var info = $('select[name=prod_id] option:selected').val();
            var start = $('#cycle1').val();
            var end = $('#cycle2').val();

            var path = "getrange/"+method+"/"+encodeURI(info);
            if(!(start=='') && !(end==''))
            {
                path = path+"/"+start+"/"+end;
            }
            $.get(path, function(data, status){
                config.data.labels=[];
                config.data.datasets=[];

                var obj = JSON.parse(JSON.stringify(data));


                config.data.labels=obj.labels;

                var backColor = 'rgb(76, 198, 10)'; 
                var newColor = 'rgb(54, 162, 235)';
                if(info == 2){
                  newColor = 'rgb(76, 198, 10)';
                  backColor = 'rgb(54, 162, 235)';
                }
                
                var newDataset = {
                    label: 'Total '+obj.lbl_info+' '+obj.lbl_total,                    
                    backgroundColor: backColor,
                    borderColor: newColor,
                    pointStyle: 'rect',                    
                    data: obj.total,
                    fill: false
                };
                config.data.datasets.push(newDataset);

                window.myLine.update();             /*
                for (var index = 0; index < config.data.labels.length; ++index) {
                    newDataset.data.push(randomScalingFactor());
                }
                */

                //window.myLine.update();
                console.log(data);
                console.log(path);
            });
            
    }
        
        //var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        var config = {
            type: 'line',
            data: {
                labels: [],
                datasets: []
            },
            options: {
                responsive: true,
                legend: {
                  display: true,
                  position: 'top',
                  labels: {
                    boxWidth: 50,
                    fontColor: 'black',
                    fontSize: 14
                  }
                },                
                title: {
                    display: true,
                    text: 'Galva Technovision',
                    fontSize: 16,
                    fontColor: 'black'
                },
                tooltips: {
                    mode: 'index',
                    intersect: true,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Period'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        }
                    }]
                }
            }
        };

        $(function(){
            $('#apply').click(function(){              
              showGrafik();
            });

            $('#btnMonthly').click(function() {
                method='month';

            });
            $('#btnDaily').click(function() {
                method='day';
            });
            $('#btnYearly').click(function() {
                method='year';
            }); 

            $('#filterCycle').datepicker({
              autoclose: true,
              format: "yyyy-mm-dd"
            }); 
            $('#filterCycle2').datepicker({
              autoclose: true,
              format: "yyyy-mm-dd"
            });                              
    })

        window.onload = function() {
            var ctx = document.getElementById('canvas').getContext('2d');
            window.myLine = new Chart(ctx, config);
            showGrafik();
        };

        var colorNames = Object.keys(window.chartColors);        
</script>
@stop