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



        function initAutocomplete() {
    var map = new google.maps.Map(document.getElementById('map_edit'), {
        center: {
            lat: {{$billboard->lat ? $billboard->lat : 30.0595581 }},
            lng: {{$billboard->lng ? $billboard->lng : 31.2233591}}
        },
        zoom: 7,
        mapTypeId: 'roadmap'
    });

    var input = document.getElementById('searchMapInput');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);

    var infowindow = new google.maps.InfoWindow();
    var marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
    });

    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();

        /* If the place has a geometry, then present it on a map. */
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
        marker.setIcon(({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
        }));
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);


        var address = '';
        if (place.address_components) {
            address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }

        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
        infowindow.open(map, marker);


        /* Location details */
        $('#lat').val(marker.getPosition().lat());
        $('#lng').val(marker.getPosition().lng());

        document.getElementById('location-snap').innerHTML = place.formatted_address;
        document.getElementById('lat').innerHTML = place.geometry.location.lat();
        document.getElementById('lng').innerHTML = place.geometry.location.lng();
    });

    // Create the search box and link it to the UI element.
    var marker = new google.maps.Marker({
        position: {
            lat: {{$billboard->lat ? $billboard->lat : 30.0595581 }},
            lng: {{$billboard->lng ? $billboard->lng : 31.2233591}}
        },
        map: map,
        draggable: false,
        animation: google.maps.Animation.DROP
    });

    google.maps.event.addListener(map, 'click', function(event) {
        if (marker) {
            marker.setMap(null);
            var myLatLng = event.latLng;
        }
        marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
        });
            var geocoder;

            // 

            var reverseGeocoder = new google.maps.Geocoder();
            var currentPosition = new google.maps.LatLng(marker.getPosition().lat(), marker.getPosition().lng());
        
            reverseGeocoder.geocode({'latLng': currentPosition}, function(results, status) {
                console.log(results[0].formatted_address ,'7777777777777');
                $('#searchMapInput').val(results[0].formatted_address);

    
            });
    
        // console.log(event.latLng);
        $('#lat').val(marker.getPosition().lat());
        $('#lng').val(marker.getPosition().lng());
        console.log(marker.getPosition().lat());
        console.log(marker.getPosition().lng());
    })

    google.maps.event.addListener(map, 'zoom_changed', function() {
        $('#zoom').val(map.getZoom())
    });

    $("#jstree").on('changed.jstree', function(e, data) {
        var lat = parseFloat($('#' + data.selected).attr('lat'));
        var lng = parseFloat($('#' + data.selected).attr('lng'));
        var zoom = parseInt($('#' + data.selected).attr('zoom'));
        $('#lat').val(lat);
        $('#lng').val(lng);
        $('#zoom').val(zoom);
        console.log(lat1);
        marker.setPosition({
            lat: lat1,
            lng: lng1
        });
        map.setCenter(new google.maps.LatLng(lat1, lng1));
        map.setZoom(zoom);
    })
}
$("#jstree").on('changed.jstree', function(e, data) {
    $('#location').select2('val', data.selected);
    $('#get_group').text($('#' + data.selected).attr('data-title'));
    $('#get_location').attr('lat', $('#' + data.selected).attr('lat'));
    $('#get_location').attr('lng', $('#' + data.selected).attr('lng'));
    $('#get_location').attr('zoom', $('#' + data.selected).attr('zoom'));
    var id = data.selected;
    $('#parent_id').val(id);
    $('#location_id').val(id);
    $('#del_loc').val(id);
    //marker.setPosition(place.geometry.location);
}).jstree({
    'core': {
        "themes": {
            "dots": false,
            "icons": false
        }
    },
    'plugins': ['types', 'contextmenu', 'wholerow', 'ui']
});
var id = "{{ old('location_id') }}";
$('#jstree').jstree(true).select_node(id);
$('#location').on('change', function() {
    var id = $(this).val();
    var old = $(this).attr('old');
    $('#jstree').jstree(true).deselect_node(old);
    $('#jstree').jstree(true).select_node(id);
    $(this).attr('old', id);
});


    </script>
@endsection
{{-- Start of page Content --}}
@section('content')

    <section class="content-header">
        <h1>
            Billboards
            <small>Edit Billboard</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{adminUrl('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{adminUrl('/billboard')}}">Billboard</a></li>
            <li class="active">Add Billboard</li>
        </ol>
    </section>


    <section class="content">
        @include('dashboard.layouts.messages')
        <form role="form" action="{{route('billboard.update', $billboard->id)}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('patch')
            <input type="hidden" name="created_by">
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
                                    <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="Enter Billboard Title" value="{{$billboard->billboard_en->name}}">
                                    <p class="help-block">Enter title of service</p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1">Billboard Code</label>
                                    <input type="text" class="form-control" name="code" disabled="disabled" id="exampleInputEmail1" placeholder="Enter Billboard Code" value="{{$billboard->code}}">
                                    <p class="help-block">Enter Billboard Code Ex: #E52S48</p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1">Billboard Dimensions</label>
                                    <input type="text" class="form-control" name="dimensions" id="exampleInputEmail1" placeholder="Enter Billboard Dimensions" value="{{$billboard->dimension}}">
                                    <p class="help-block">Enter Billboard Dimensions </p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1">Billboard Location Url</label>
                                    <input type="url" class="form-control" name="location" id="exampleInputEmail1" placeholder="Enter Billboard Location" value="{{$billboard->location}}">
                                    <p class="help-block">Enter Billboard Area Url on <strong>Google Maps</strong> </p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1"> Billboard Type</label>
                                    <select name="type" class="form-control">
                                        <option value="0">Choose Billboard Type</option>
                                        @if($types)
                                            @foreach($types as $type)
                                                <option value="{{$type->id}}" {{$type->id == $billboard->type_id ? 'selected' : ''}}>{{$type->type}}</option>
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
                                                <option value="{{$supplier->id}}" {{$supplier->id == $billboard->supplier_id ? 'selected' : ''}}>{{$supplier->supplier}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p class="help-block"> Choose Billboard Type</p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1"> Letter Location</label>
                                    <select name="letter_id" class="form-control">
                                        <option value="0">Choose Letter Location</option>
                                        @if(@$letters)
                                            @foreach(@$letters as $letter)
                                                <option value="{{$letter->id}}" {{$letter->id == $billboard->letter_id ? 'selected' : ''}}>{{@$letter->letter}}</option>
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
                                                <option value="{{$service->id}}" {{$service->id == $billboard->service_id ? 'selected' : ''}}>{{$service->service_en->title}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p class="help-block"> Choose Service for this Billboard</p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1"> Billboard Sub Service Name</label>
                                    <select name="sub_service" id="sub_services" class="form-control">
                                        <option>Choose Service Name</option>
                                        @if($subServices)
                                            @foreach($subServices as $subService)
                                                <option value="{{$subService->id}}" {{$subService->id == $billboard->sub_service_id ? 'selected' : ''}}>{{$subService->service_en->title}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p class="help-block"> Choose Sub Service for this Billboard if Exist</p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1"> Billboard Location</label>
                                    <select name="parent_location" id="parent_location" class="form-control">
                                        <option>Choose Area</option>
                                        @if($parentLocations)
                                            @foreach($parentLocations as $parentLocation)
                                                <option value="{{$parentLocation->id}}" {{$parentLocation->id == $billboard->parent_location_id ? 'selected' : ''}}>{{$parentLocation->parentLocation_en->location}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p class="help-block"> Choose Billboard Location</p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1"> Billboard Zone</label>
                                    <select name="child_location" id="child_location" class="form-control">
                                        <option>Choose Zone</option>
                                        @if($childLocations)
                                            @foreach($childLocations as $childLocation)
                                                <option value="{{$childLocation->id}}" {{$childLocation->id == $billboard->child_location_id ? 'selected' : ''}}>{{$childLocation->childLocation_en->location}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p class="help-block"> Choose Billboard Zone</p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1"> Billboard Area</label>
                                    <select name="child_of_child_location" id="child_of_child_location" class="form-control">
                                        <option>Choose Location</option>
                                        @if($childOfChildLocations)
                                            @foreach($childOfChildLocations as $childOfChildLocation)
                                                <option value="{{$childOfChildLocation->id}}" {{$childOfChildLocation->id == $billboard->child_location_id ? 'selected' : ''}}>{{$childOfChildLocation->childOfChildLocation_en->location}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p class="help-block"> Choose Billboard Area</p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1"> Billboard Size</label>
                                    <select name="size" id="size" class="form-control">
                                        <option>Choose Size</option>
                                        @if($sizes)
                                            @foreach($sizes as $size)
                                                <option value="{{$size->id}}" {{$billboard->size_id == $size->id ? 'selected' : ''}}>{{$size->size}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p class="help-block"> Choose Billboard Size</p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1"> Billboard Light</label>
                                    <select name="light" class="form-control">
                                        <option>Choose Light</option>
                                        <option value="Front" {{$billboard->light == 'Front' ? 'selected' : ''}}>Front</option>
                                        <option value="Back" {{$billboard->light == 'Back' ? 'selected' : ''}}>Back</option>
                                    </select>
                                    <p class="help-block">Choose Light Type</p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1"> Billboard Material</label>
                                    <select name="material" class="form-control">
                                        <option>Choose Material</option>
                                        <option value="Flex" {{$billboard->material == 'Flex' ? 'selected' : ''}}>Flex</option>
                                        <option value="Banner" {{$billboard->material == 'Banner' ? 'selected' : ''}}>Banner</option>
                                    </select>
                                    <p class="help-block">Choose Billboard Material</p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1"> Billboard Availability</label>
                                    <select name="availability" class="form-control">
                                        <option>Choose Availability</option>
                                        <option value="1" {{$billboard->availability == '1' ? 'selected' : ''}}>Available</option>
                                        <option value="0" {{$billboard->availability == '0' ? 'selected' : ''}}>Unavailable</option>
                                    </select>
                                    <p class="help-block">Choose Billboard Availability</p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1">Faces</label>
                                    <input type="number" class="form-control" name="faces" id="exampleInputEmail1" placeholder="Enter Number of Faces" value="{{$billboard->faces}}">
                                    <p class="help-block">Enter Number Of Billboard Faces </p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1">Price</label>
                                    <input type="number" class="form-control" name="price" id="exampleInputEmail1" placeholder="Enter Billboard Price" value="{{$billboard->price}}">
                                    <p class="help-block">Enter Billboard Price </p>
                                </div>

                                <div class="col-lg-4">
                                    <label for="exampleInputEmail1">Cost of Printing</label>
                                    <input type="number" class="form-control" name="cost_of_printing" id="exampleInputEmail1" placeholder="Enter Cost" value="{{$billboard->printing_cost}}">
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
                                    <textarea  class="form-control" name="description" id="exampleInputEmail1" placeholder="Enter Billboard Description" rows="6">{{$billboard->billboard_en->description}}</textarea>
                                    <p class="help-block">Enter Description of Billboard</p>
                                </div>

                                <div class="col-lg-8">
                                    <label for="searchMapInput" class="col-sm-2 col-form-label"> Address</label>
                                    <input type="text" id="searchMapInput" name="searchmab" value="{{$billboard->searchmab}}" class="form-control map-input">
                                    <div class="col-sm-10">
                                        <div id="map_edit" style="height: 500px;z-index:20"></div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <label for="lat" class="col-sm-2 col-form-label"> lat</label>
                                    <div class="col-sm-10">

                                    <input type="text" id="lat" name="lat" value="{{$billboard->lat}}" class="form-control map-input">
                                </div>
                                </div>
                                <div class="col-lg-8">
                                    <label for="lng" class="col-sm-2 col-form-label"> lng</label>
                                    <div class="col-sm-10">

                                    <input type="text" id="lng" name="lng" value="{{$billboard->lng}}" class="form-control map-input">
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
