@extends('layouts.master')

@section('tittle_bar','User Menu')

@section('content')
<div class="container">

    <section class="content-header">
        <h1>
            Master
            <small>Menus User</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-file-image-o"></i> Master</a></li>
            <li><a href="#" class="active">Menus User</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Menu</h3>
                        <div class="box-tools pull-right">
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    @if(isset($info))
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-info"></i> Info!</h4>
                        {{ $info }}
                    </div>
                    @endif
                    <!-- /.box-header -->
                    <form class="form-horizontal" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body table-responsive p-0" style="height: 400px;">
                            <div class="box-body">
                                <table class="table table-head-fixed">
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th>Desc</th>
                                    </tr>
                                    @foreach($menu as $index=>$value)
                                    <tr>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="checkbox[]" value="{{ $value['id'] }}" {{ $value['check'] }}>
                                            </label>
                                        </td>
                                        <td>
                                            @if($value['desc']=='title')
                                            <h3>
                                                @endif
                                                <strong>{{ $value['name'] }}</strong>
                                                @if($value['desc']=='title')
                                            </h3>
                                            @endif
                                        </td>
                                        <td>{{ $value['desc'] }} </td>
                                    </tr>
                                    @if(count($value['contents'])>0)
                                    @foreach($value['contents'] as $index2=>$value2)
                                    <tr>
                                        <td>

                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="checkbox[]" value="{{ $value2['id'] }}" {{ $value2['check'] }}>
                                            </label>
                                            {{ $value2['name'] }}
                                        </td>
                                        <td>submenu</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href=".." class="btn btn-default pull-left">Cancel</a></button>
                            <button type="submit" class="btn btn-primary pull-right">Save</button>
                        </div>
                    </form>
                    </table>
                </div>
            </div>
        </div>
</div>
</div>
@endsection