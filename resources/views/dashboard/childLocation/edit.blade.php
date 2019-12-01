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
            Zones
            <small>Update Zone</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{adminUrl('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{adminUrl('/child-location')}}">Zones</a></li>
            <li class="active">Update Zone</li>
        </ol>
    </section>



    <section class="content">
        @include('dashboard.layouts.messages')
        <form role="form" action="{{route('child-location.update', $location->id)}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('patch')
            <input type="hidden" name="created_by">
            <div class="row">
                <!-- English Side -->
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Zone Info</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-lg-5">
                                    <label for="exampleInputEmail1"> Zone Name</label>
                                    <input type="text" class="form-control" name="location" id="exampleInputEmail1" placeholder="Enter Zone Name" value="{{$location->childLocation_en->location}}">
                                    <p class="help-block">Enter Zone Name</p>
                                </div>

                                <div class="col-lg-5">
                                    <label for="exampleInputEmail1"> Choose Area</label>
                                    <select name="parent_location_id" id="admin_type" class="form-control">
                                        <option value="0">Choose Area</option>
                                        @if($parent_locations)
                                            @foreach($parent_locations as $parent_location)
                                                <option value="{{$parent_location->id}}" {{$parent_location->id == $location->parent_location_id ? 'selected' : ''}}>{{$parent_location->parentLocation_en->location}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p class="help-block"> Choose Area for this Zone</p>
                                </div>

                                <!-- <div class="col-lg-2">
                                    <label for="exampleInputEmail1"> Zone Letter</label>
                                    <input type="text" class="form-control" name="letter" id="exampleInputEmail1" placeholder="Enter Letter" value="{{$location->letter}}">
                                    <p class="help-block">Enter letter</p>
                                </div> -->

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
