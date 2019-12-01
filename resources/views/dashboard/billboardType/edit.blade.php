@extends('dashboard.layouts.layouts')
@section('title', 'Dashboard')
{{--Drop Your Customized Style Codes Here--}}
@section('customizedStyle')
@endsection
{{--Drop Your Customized Scripts Codes Here--}}
@section('customizedScript')
    <script>
        //Initialize Select2 Elements
        $('.select2').select2()
    </script>
@endsection
{{-- Start of page Content --}}
@section('content')

    <section class="content-header">
        <h1>
            Billboard Type
            <small>Update Billboard Type</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{adminUrl('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{adminUrl('/billboard-type')}}">Billboard Types</a></li>
            <li class="active">Billboard Type</li>
        </ol>
    </section>



    <section class="content">
        @include('dashboard.layouts.messages')
        <form role="form" action="{{route('billboard-type.update', $type->id)}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('patch')
            <input type="hidden" name="created_by">
            <div class="row">
                <!-- English Side -->
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Supplier Info</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-lg-6">
                                    <label for="exampleInputEmail1"> Billboard Type</label>
                                    <input type="text" class="form-control" name="type" id="exampleInputEmail1" placeholder="Enter Supplier Name" value="{{$type->type}}">
                                    <p class="help-block">Enter Billboard Type</p>
                                </div>

                                <div class="col-lg-6">
                                    <label for="exampleInputEmail1"> Type Letter</label>
                                    <input type="text" class="form-control" name="letter" id="exampleInputEmail1" placeholder="Enter Owner Name" value="{{$type->letter}}">
                                    <p class="help-block">Type Letter</p>
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
    </section>


@endsection
