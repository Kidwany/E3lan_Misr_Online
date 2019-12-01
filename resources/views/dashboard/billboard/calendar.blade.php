@extends('dashboard.layouts.layouts')
@section('title', 'Dashboard')
{{--Drop Your Customized Style Codes Here--}}
@section('customizedStyle')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('dashboard/AdminLte/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/AdminLte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">

@endsection
{{--Drop Your Customized Scripts Codes Here--}}
@section('customizedScript')
    <script>
        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })
    </script>

    <script src="{{asset('dashboard/AdminLte/bower_components/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('dashboard/AdminLte/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

    <script>
        $(function () {
            //Date range picker
            $('#reservation').daterangepicker();
        })
    </script>
@endsection
{{-- Start of page Content --}}
@section('content')

    <section class="content-header">
        <h1>
            Billboard <strong>{{$billboard->code}}</strong> Calendar
            <small>Billboard Calendar</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{adminUrl('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{adminUrl('/billboard')}}">Billboard</a></li>
            <li class="active">Billboard Calendar</li>
        </ol>
    </section>


    <section class="content">
        @include('dashboard.layouts.messages')
        <form role="form" action="{{adminUrl('billboard/calendar/store')}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('post')
            <input type="hidden" name="billboard_id" value="{{$billboard->id}}">
            <div class="row">
                <!-- English Side -->
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Reservation Period</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="form-group">
                                {{--<div class="col-lg-6">
                                    <label for="exampleInputEmail1">From</label>
                                    <input type="text" class="form-control" name="from" id="exampleInputEmail1" placeholder="Enter Reservation Date From" value="{{old('from')}}">
                                    <p class="help-block">Enter Reservation Date From</p>
                                </div>

                                <div class="col-lg-6">
                                    <label for="exampleInputEmail1">To</label>
                                    <input type="text" class="form-control" name="to" id="exampleInputEmail1" placeholder="Enter Reservation Date To" value="{{old('to')}}">
                                    <p class="help-block">Enter Reservation Date To</p>
                                </div>--}}

                                <div class="col-lg-6">
                                    <label>Reservation Period:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="reservation" name="date_range" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>


        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="box box-primary" style="padding: 15px">
                    <div class="box-header with-border">
                        <h3 class="box-title">Billboard Calendar</h3>
                        {{--<a href="{{adminUrl('billboard/create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New Billboard </a>--}}
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>id</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Actions</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @if($appointments)
                            @foreach($appointments as $appointment)
                                <tr>
                                    <td>{{$appointment->id}}</td>
                                    <td>{{$appointment->starts->format('d M Y')}}</td>
                                    <td>{{$appointment->end->format('d M Y')}}</td>
                                    <td>
                                        <button type="button" class data-toggle="modal" data-target="#delete{{$appointment->id}}" style="font-size: 20px">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>

                    @if($appointments)
                        @foreach($appointments as $appointment)
                            <div class="modal modal-danger fade" id="delete{{$appointment->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Delete Appointment</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are You Sure You Want To Delete Billboard Appointment<strong>{{$appointment->billboard->billboard_en->name}}</strong></p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{adminUrl('billboard/calendar/'. $appointment->id .'/destroy')}}" method="post">
                                                @method('delete')
                                                @csrf
                                                <div class="d-flex flex-row">
                                                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal" style="margin-right: 5px">
                                                        cancel
                                                    </button>
                                                    <button type="submit" class="btn btn-danger">
                                                        Delete
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </section>

@endsection
