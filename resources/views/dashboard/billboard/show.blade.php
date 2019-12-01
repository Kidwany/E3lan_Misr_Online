@extends('dashboard.layouts.layouts')
@section('title', 'Dashboard')
{{--Drop Your Customized Style Codes Here--}}
@section('customizedStyle')
@endsection
{{--Drop Your Customized Scripts Codes Here--}}
@section('customizedScript')
    <script>
        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })
    </script>
@endsection
{{-- Start of page Content --}}
@section('content')

    <section class="content-header">
        <h1>
            Billboard Details
            <small><strong>{{$billboard->billboard_en->name}} </strong>Details</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{adminUrl('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{adminUrl('/campaign-request')}}">Campaigns Requests</a></li>
            <li class="active">All Requests</li>
        </ol>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary" style="padding: 15px">
                    <div class="box-header with-border">
                        <h3 class="box-title">Request INFO</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <div class="col-md-12">
                            <div class="box">

                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <th class="text-center">Attribute</th>
                                            <th class="text-center">Details</th>
                                        </tr>
                                        <tr>
                                            <td><strong>ID</strong> </td>
                                            <td>{{$billboard->id}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Code</strong> </td>
                                            <td>{{$billboard->code}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Name</strong> </td>
                                            <td>{{$billboard->billboard_en->name}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Description</strong> </td>
                                            <td>{{$billboard->billboard_en->name}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Main Service</strong> </td>
                                            <td>{{$billboard->service_id ? $billboard->service->service_en->title : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Sub Service</strong> </td>
                                            <td>{{$billboard->sub_service_id ? $billboard->subService->service_en->title : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Area</strong> </td>
                                            <td>{{$billboard->parentLocation->parentLocation_en->location}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Zone</strong> </td>
                                            <td>{{$billboard->child_location_id ? $billboard->childLocation->childLocation_en->location : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Location</strong></td>
                                            <td>{{$billboard->child_of_child_location_id ? $billboard->childOfChildLocation->childOfChildLocation_en->location : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Size</strong></td>
                                            <td>{{$billboard->billboardSize->size}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Billboard Type</strong></td>
                                            <td>{{$billboard->type_id ? $billboard->type->type : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Billboard Supplier</strong></td>
                                            <td>{{$billboard->supplier_id ? $billboard->supplier->supplier : ''}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Dimensions</strong></td>
                                            <td>{{$billboard->dimension}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Light</strong></td>
                                            <td>{{$billboard->light}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Faces</strong></td>
                                            <td>{{$billboard->faces}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Material</strong></td>
                                            <td>{{$billboard->material}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Price</strong></td>
                                            <td>{{$billboard->price}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Printing Cost</strong></td>
                                            <td>{{$billboard->printing_cost}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Availability</strong></td>
                                            <td>{{$billboard->availability == 1 ? 'Available' : 'Unavailable'}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Created By</strong></td>
                                            <td>{{$billboard->createdBy->name}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Created At</strong></td>
                                            <td>{{$billboard->created_at->diffForHumans()}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->

                            <!-- /.box -->
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>

@endsection
