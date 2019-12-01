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

    <script>
        $(document).ready(function () {
            $('#main_services').on('change', function () {
                var mainServicetId = $(this).val();
                //alert(mainServicetId);
                if (mainServicetId)
                {
                    $.ajax({
                        header: '@csrf',
                        url: '{{adminUrl('sub-services/')}}' + '/' + mainServicetId,
                        type: "GET",
                        dataType: 'json',
                        success: function (data) {
                            $('#sub_services').empty();
                            //$('#childOfChildLocation').empty();
                            $.each(data, function (key, value) {
                                $('#sub_services').append('<option value="' + value.id +'">'+ value.service_en.title +'</option>')

                            })
                        }
                    })
                }
            });

            $('#parent_location').on('change', function () {
                var parentLocationIdId = $(this).val();
                //alert(childId);
                if (parentLocationIdId)
                {
                    $.ajax({
                        header: '@csrf',
                        url: '{{adminUrl('child-locations/')}}' + '/' + parentLocationIdId,
                        type: "GET",
                        dataType: 'json',
                        success: function (data) {
                            $('#child_location').empty();
                            $('#child_of_child_location').empty();
                            $.each(data, function (key, value) {
                                $('#child_location').append('<option value="' + value.id +'">'+ value.child_location_en.location +'</option>')

                            })
                        }
                    })
                }
            });

            $('#child_location').on('click', function () {
                var childLocationIdId = $(this).val();
                //alert(childId);
                if (childLocationIdId)
                {
                    $.ajax({
                        header: '@csrf',
                        url: '{{adminUrl('child-of-child-locations/')}}' + '/' + childLocationIdId,
                        type: "GET",
                        dataType: 'json',
                        success: function (data) {
                            $('#child_of_child_location').empty();
                            $.each(data, function (key, value) {
                                $('#child_of_child_location').append('<option value="' + value.id +'">'+ value.child_of_child_location_en.location +'</option>')

                            })
                        }
                    })
                }
            });
        });
    </script>
@endsection
{{-- Start of page Content --}}
@section('content')

    <section class="content-header">
        <h1>
            Billboards
            <small>Add Billboard</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{adminUrl('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{adminUrl('/billboard')}}">Billboard</a></li>
            <li class="active">Add Billboard</li>
        </ol>
    </section>


    <section class="content">
        @include('dashboard.layouts.messages')
        <form role="form" action="{{route('billboard.store')}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('post')
            <input type="hidden" name="created_by">
            <!--Main Info-->
            <div class="row">
                <!-- English Side -->
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Billboard Info</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="form-group">

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1"> Name</label>
                                    <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="Enter Billboard Title" value="{{old('name')}}">
                                    <p class="help-block">Enter title of service</p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1">Billboard Code</label>
                                    <input type="text" class="form-control" name="code" disabled="disabled"id="exampleInputEmail1" placeholder="Enter Billboard Code" value="{{old('code')}}">
                                    <p class="help-block">Enter Billboard Code Ex: 001</p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1">Billboard Dimensions</label>
                                    <input type="text" class="form-control" name="dimensions" id="exampleInputEmail1" placeholder="Enter Billboard Dimensions" value="{{old('dimensions')}}">
                                    <p class="help-block">Enter Billboard Dimensions </p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1">Billboard Location Url</label>
                                    <input type="url" class="form-control" name="location" id="exampleInputEmail1" placeholder="Enter Billboard Location" value="{{old('dimensions')}}">
                                    <p class="help-block">Enter Billboard Area Url on <strong>Google Maps</strong> </p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1"> Billboard Type</label>
                                    <select name="type" class="form-control">
                                        <option value="0">Choose Billboard Type</option>
                                        @if($types)
                                            @foreach($types as $type)
                                                <option value="{{$type->id}}">{{$type->type}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p class="help-block"> Choose Billboard Type</p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1"> Billboard Supplier</label>
                                    <select name="supplier" class="form-control">
                                        <option value="0">Choose Billboard Supplier</option>
                                        @if($suppliers)
                                            @foreach($suppliers as $supplier)
                                                <option value="{{$supplier->id}}">{{$supplier->supplier}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p class="help-block"> Choose Billboard Type</p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1"> Letter Location</label>
                                    <select name="letter" class="form-control">
                                        <option value="0">Choose Letter Location</option>
                                        @if($letters)
                                            @foreach($letters as $letter)
                                                <option value="{{$letter->id}}">{{$letter->letter}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1"> Billboard Service Name</label>
                                    <select name="service_id" id="main_services" class="form-control">
                                        <option value="0">Choose Service Name</option>
                                        @if($services)
                                            @foreach($services as $service)
                                                <option value="{{$service->id}}">{{$service->service_en->title}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p class="help-block"> Choose Service for this Billboard</p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1"> Billboard Sub Service Name</label>
                                    <select name="sub_service" id="sub_services" class="form-control">
                                        <option>Choose Service Name</option>
                                    </select>
                                    <p class="help-block"> Choose Sub Service for this Billboard if Exist</p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1"> Billboard Area</label>
                                    <select name="parent_location" id="parent_location" class="form-control">
                                        <option>Choose Area</option>
                                        @if($parentLocations)
                                            @foreach($parentLocations as $parentLocation)
                                                <option value="{{$parentLocation->id}}">{{$parentLocation->parentLocation_en->location}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p class="help-block"> Choose Billboard Area</p>
                                </div>


                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1"> Billboard Zone</label>
                                    <select name="child_location" id="child_location" class="form-control">
                                        <option>Choose Zone</option>
                                    </select>
                                    <p class="help-block"> Choose Billboard Zone</p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1"> Billboard Location</label>
                                    <select name="child_of_child_location" id="child_of_child_location" class="form-control">
                                        <option>Choose Location</option>
                                    </select>
                                    <p class="help-block"> Choose Billboard Location</p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1"> Billboard Size</label>
                                    <select name="size" id="size" class="form-control">
                                        <option>Choose Size</option>
                                        @if($sizes)
                                            @foreach($sizes as $size)
                                                <option value="{{$size->id}}">{{$size->size}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p class="help-block"> Choose Billboard Size</p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1"> Billboard Light</label>
                                    <select name="light" class="form-control">
                                        <option>Choose Light</option>
                                        <option value="Front">Front</option>
                                        <option value="Back">Back</option>
                                    </select>
                                    <p class="help-block">Choose Light Type</p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1"> Billboard Material</label>
                                    <select name="material" class="form-control">
                                        <option>Choose Material</option>
                                        <option value="Flex">Flex</option>
                                        <option value="Banner">Banner</option>
                                    </select>
                                    <p class="help-block">Choose Billboard Material</p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1"> Billboard Availability</label>
                                    <select name="availability" class="form-control">
                                        <option>Choose Availability</option>
                                        <option value="1">Available</option>
                                        <option value="0">Unavailable</option>
                                    </select>
                                    <p class="help-block">Choose Billboard Availability</p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1">Faces</label>
                                    <input type="number" class="form-control" name="faces" id="exampleInputEmail1" placeholder="Enter Number of Faces" value="{{old('faces')}}">
                                    <p class="help-block">Enter Number Of Billboard Faces </p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1">Price</label>
                                    <input type="number" class="form-control" name="price" id="exampleInputEmail1" placeholder="Enter Billboard Price" value="{{old('price')}}">
                                    <p class="help-block">Enter Billboard Price </p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1">Cost of Printing</label>
                                    <input type="number" class="form-control" name="cost_of_printing" id="exampleInputEmail1" placeholder="Enter Cost" value="{{old('cost_of_printing')}}">
                                    <p class="help-block">Enter Cost Of Printing </p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1"> Image</label>
                                    <input type="file" class="form-control" name="image_id" id="exampleInputEmail1" placeholder="Enter Billboard text">
                                    <p class="help-block"> Upload Billboard Image </p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1"> Images</label>
                                    <input type="file" class="form-control" multiple name="images[]" id="exampleInputEmail1" placeholder="Enter Billboard text">
                                    <p class="help-block"> Upload another Billboard Images </p>
                                </div>

                                <div class="col-lg-8">
                                    <label for="exampleInputEmail1"> Billboard Description</label>
                                    <textarea  class="form-control" name="description" id="exampleInputEmail1" placeholder="Enter Billboard Description" rows="6">{{old('description')}}</textarea>
                                    <p class="help-block">Enter Description of Billboard</p>
                                </div>

                                <div class="col-lg-8">
                                    <label for="searchMapInput" class="col-sm-2 col-form-label"> Address</label>
                                    <input type="text" id="searchMapInput" name="searchmab" class="form-control map-input">
                                    <div class="col-sm-10">
                                        <div id="map" style="height: 500px;z-index:20"></div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <label for="lat" class="col-sm-2 col-form-label"> lat</label>
                                    <div class="col-sm-10">

                                    <input type="text" id="lat" name="lat" class="form-control map-input">
                                </div>
                                </div>
                                <div class="col-lg-8">
                                    <label for="lng" class="col-sm-2 col-form-label"> lng</label>
                                    <div class="col-sm-10">

                                    <input type="text" id="lng" name="lng" class="form-control map-input">
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
    </section>


@endsection
