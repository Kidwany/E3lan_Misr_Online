@extends('website.layouts.layouts')
@section('title', 'My Campaigns')


@section('content')



<!--== Page Title Start ==-->
<div class="transition-none">
    <section class="parallax-effect title-hero-bg" style="background-image: url({{asset('website/assets/images/background/my-camp-bg.jpg')}}); min-height: 290px !important;">
        <div class="container">
            <div class="page-title text-center white-color">
                <h1>My Campaigns</h1>
                <h4 class="text-uppercase mt-30">List Of My Latest Campaigns</h4>
            </div>
        </div>
    </section>
</div>
<!--== Page Title End ==-->
<section>
    @include('dashboard.layouts.messages')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 section-heading ">
                <h1 class="roboto-font font-700">Campaign Items</h1>
            </div>
        </div>
        <!--======================== First Campaign =======================-->

        @if($campaigns)
        @foreach($campaigns as $campaign)
        <div class=" centerize-col col-lg-12 col-md-12 col-sm-9 col-xs-12 text-center">
            <!-- -------------------- Tabs --------------------------- -->
            <table class="table table-bordered shop-cart">
                <thead>
                    <tr>
                        <th scope="col">Item</th>
                        <th scope="col">Code</th>
                        <th scope="col">Last</th>
                        <th scope="col">Type</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Zone</th>
                        <th scope="col">Location</th>
                        <th scope="col">Price</th>
                        <th scope="col">Printing Cost</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @if($campaign)
                    @foreach($campaign->campaignItems as $item)
                    <tr>
                        <td><a href="{{url('serviceDetails/' . $item->billboard_id)}}"> <img src="{{asset($item->requestedBillboard->image->path)}}" alt=""> </a> </td>
                        <td><a href="{{url('serviceDetails/' . $item->billboard_id)}}">{{$item->requestedBillboard->code}}</a> </td>
                        <td><span>{{$item->requestedBillboard->service->{'service_' . currentLang()}->title }}</span> </td>
                        <td>
                            From: <span style="font-weight: bold" class="black">{{$item->starts->format('d M Y')}}</span><br>
                            To: <span style="font-weight: bold" class="black">{{$item->end->format('d M Y')}}</span><br>
                        </td>
                        <td><span>{{$item->requestedBillboard->parentLocation->parentLocation_en->location}}</span> </td>
                        <td><span>{{$item->requestedBillboard->childLocation->childLocation_en->location}}</span> </td>

                        <td>{{$campaign->campaignDetails->price}} L.E</td>
                        <td>{{$campaign->campaignDetails->printing_cost}} L.E</td>
                        <td>{{$campaign->campaignDetails->price + $campaign->campaignDetails->printing_cost}} L.E</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>


        </div>
        @endforeach
        @endif
        <!--======================== Second Campaign =======================-->
                <!-- Grid row -->
        <div class="row">
        <!-- Grid column -->
        <div id="map_canvas" style="width: 100%; height:500px; overflow: inherit !important;"></div>
        <!--Grid column-->
    </div>

    </div>


</section>



@endsection

@section('customizedScript')

<script src="https://maps.googleapis.com/maps/api/js?v=3.11&sensor=false" type="text/javascript"></script>
<script type="text/javascript">
    // check DOM Ready
    $(document).ready(function() {
        // execute
        (function() {
            // map options
            var options = {
                center: {
                    lat: 30.0595581,
                    lng: 31.2233591
                },
                zoom: 7,
                mapTypeId: 'roadmap'
            };

            // init map
            var map = new google.maps.Map(document.getElementById('map_canvas'), options);

            var locations = @json($list_array);

            // var locations = [
            //     ['El Qantra Shark - Ras Sedr Rd, El Qantara El Sharqiya, Ismailia Governorate, Egypt', 30.69458412564884, 32.37520693935551],
            //     ['Al Mafhama, Al Qalg, Al Khankah, Al Qalyubia Governorate, Egypt', 30.5213284, 32.37556029999996],
            //     ['El Hassana, North Sinai Governorate, Egypt', 30.543311490365426, 33.82540225185551],
            //     ['Al Qoseama - Al Hasna, Qesm Al Qosimah, North Sinai Governorate, Egypt', 30.495990354101643, 34.04512881435551],
            //     ['Maroubra Beach', -33.950198, 151.259302, 1],
            // ];

            // NY and CA sample Lat / Lng
            // var southWest = new google.maps.LatLng(40.744656, -74.005966);
            // var northEast = new google.maps.LatLng(34.052234, -118.243685);
            // var lngSpan = northEast.lng() - southWest.lng();
            // var latSpan = northEast.lat() - southWest.lat();

            // console.log(locations[0],'7789999999');
            // set multiple marker
            for (var i = 0; i < @json($list_array).length; i++) {
                // init markers
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(@json($list_array)[i]['lat'], @json($list_array)[i]['lng']),
                    map: map,
                    title: 'Click Me ' + i
                });
                console.log(locations[i]['address'], '7789999999');

                // process multiple info windows
                (function(marker, i) {
                    // add click event
                    google.maps.event.addListener(marker, 'click', function() {
                        infowindow = new google.maps.InfoWindow({
                            content: @json($list_array)[i]['address']
                        });
                        infowindow.open(map, marker);
                    });
                })(marker, i);
            }
        })();
    });
</script>

@endsection
