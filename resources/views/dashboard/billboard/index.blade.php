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
                'lengthChange': false,
                'searching'   : false,
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
            Billboards
            <small>All Billboards</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{adminUrl('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{adminUrl('/billboard')}}">Billboard</a></li>
            <li class="active">All Billboards</li>
        </ol>
    </section>


    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="box box-primary" style="padding: 15px">
                    <div class="box-header with-border">
                        <h3 class="box-title">All Billboards Info</h3>
                        <a href="{{adminUrl('billboard/create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New Billboard </a>
                    </div>
                    @include('dashboard.layouts.messages')
                    <!-- /.box-header -->
                    <!-- form start -->
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Image</th>
                            <th>Code</th>
                            <th>Location</th>
                            <th>Size</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Image</th>
                            <th>Code</th>
                            <th>Location</th>
                            <th>Size</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Actions</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @if($billboards)
                            @foreach($billboards as $billboard)
                                <tr>
                                    <td>{{$billboard->id}}</td>
                                    <td><img src="{{$billboard->image_id ? asset($billboard->image->path) : asset('dashboard/img/picture.png')}}" style="width: 50px" alt="slide image" > </td>
                                    <td>{{$billboard->code}}</td>
                                    <td>{{$billboard->parentLocation->parentLocation_en->location}}</td>
                                    <td>{{$billboard->billboardSize->size}}</td>
                                    <td>{{$billboard->created_at ? $billboard->created_at->diffForHumans() : ''}}</td>
                                    <td>{{$billboard->updated_at ? $billboard->updated_at->diffForHumans() : ''}}</td>
                                    <td>
                                        <a href="{{route('billboard.edit', $billboard->id)}}" class style="font-size: 20px"><i class="fa fa-pencil-square-o"></i> </a>
                                        <a href="{{adminUrl('billboard/'. $billboard->id .'/images')}}" class style="font-size: 20px"><i class="fa fa-image" title="Show Billboard Images"></i> </a>
                                        <a href="{{adminUrl('billboard/'. $billboard->id .'/calendar')}}" class style="font-size: 20px"><i class="fa fa-calendar" title="Show Billboard Calendar"></i> </a>
                                        <a href="{{adminUrl('billboard/'. $billboard->id)}}" class style="font-size: 20px"><i class="fa fa-eye" title="Show Billboard"></i> </a>
                                        <button type="button" class data-toggle="modal" data-target="#delete{{$billboard->id}}" style="font-size: 20px">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>

                    @if($billboards)
                        @foreach($billboards as $billboard)
                            <div class="modal modal-danger fade" id="delete{{$billboard->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Delete User</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are You Sure You Want To Delete Billboard <strong>{{$billboard->billboard_en->name}}</strong></p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{route('billboard.destroy', $billboard->id)}}" method="post">
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
