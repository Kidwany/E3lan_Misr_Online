@extends('website.layouts.layouts')
@section('title', 'Campaign')

@section('customizedScript')
    <script>
        $(document).ready(function () {
            $('#parent_location').on('change', function () {
                var parentId = $(this).val();
                //alert(parentId);
                if (parentId)
                {
                    $.ajax({
                        header: '@csrf',
                        url: 'child_location/' + parentId,
                        type: "GET",
                        dataType: 'json',
                        success: function (data) {
                            $('#childLocation').empty();
                            $('#childOfChildLocation').empty();
                            $('#childLocation').append('<option value="">'+ " All Zone" +'</option>');
                            $.each(data, function (key, value) {
                                
                                $('#childLocation').append('<option value="' + value.id +'">'+ value.child_location_en.location +'</option>')

                            })
                        }
                    })
                }
            });

            $('#childLocation').on('change', function () {
                var childId = $(this).val();
                //alert(childId);
                if (childId)
                {
                    $.ajax({
                        header: '@csrf',
                        url: 'child_of_child_location/' + childId,
                        type: "GET",
                        dataType: 'json',
                        success: function (data) {
                            $('#childOfChildLocation').empty();
                            $.each(data, function (key, value) {
                                $('#childOfChildLocation').append('<option value="' + value.id +'">'+ value.child_of_child_location_en.location +'</option>')

                            })
                        }
                    })
                }
            });
        });
    </script>
@endsection


@section('content')

<input type="hidden" id="chekauth" value="{{auth()->check() ? "1" : "2"}} ">
  <!--== Page Title Start ==-->
  <div class="transition-none">
        <section class="title-hero-bg parallax-effect" style="background-image: url({{url('website')}}/assets/images/services/camp_cover.jpg);">
            <div class="container">
                <div class="page-title text-center white-color">
                    <h1>Build Your Campaign</h1>
                    <h4 class="text-uppercase mt-30">Build Your Next Campaign with E3lan Misr</h4>
                </div>
            </div>
        </section>
    </div>
    <!--== Page Title End ==-->

    <!--== Featured Product Start ==-->
    <section style="min-height: 350px">
        <div class="container">
            @include('dashboard.layouts.messages')
            <div class="row">
                <div class="col-md-9 col-sm-9 col-xs-12 xs-mb-50">
                    @if(count($billboards) > 0)
                        @foreach($billboards as $billboard)
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="product-item tr-products">
                                    <div class="product-image tr-product-thumbnail">
                                        <a href="{{url('serviceDetails')}}/{{$billboard->id}}">
                                            <img class="img-responsive" src="{{asset($billboard->image->path)}}" alt="torneo-product"/>
                                        </a>
                                        <div class="product-action">
                                            <form action="{{url('add-to-campaign')}}" method="POST">
                                                @method('POST')
                                                @csrf
                                               
                                                <input type="hidden" name="code" value="{{@$billboard->id}}">
                                                <input type="hidden" name="start" value="{{@$start}}">
                                                <input type="hidden" name="end" value="{{@$end}}">
                                                <button class="btn-shopping btn-light btn-md btn-square btn checkauth" value="Add to Cart"><i class="icofont icofont-mega-phone"></i><span>Add to Campaign </span></button>
                                            </form>
                                        </div>
                                        @if($billboard->created_at >= \Carbon\Carbon::today())
                                            <div class="wrap-label">
                                                <span class="label-product new-label">New</span>
                                                <!--<span class="label-product sale-label">-50%</span>-->
                                            </div>
                                        @endif
                                    </div>
                                    <div class="tr-product-content">
                                        <h4><a href="{{url('serviceDetails')}}/{{$billboard->id}}" class="tr-product-title" title="Stitchout Boot">{{@$buildCamp->service_en->title}}</a></h4>
                                        <div class="product-price tr-product-price">
                                            <span class="tr-product-price-price">{{$billboard->code}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @else
                        <p class="text-center">No Results Found</p>
                    @endif
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <form action="{{url('filter')}}" method="get">
                        <!--@csrf-->
                        @method('get')
                        <!-- Parent Location -->
                        <div class="widget sidebar_widget">
                            <h5 class="aside-title text-uppercase">Choose Area</h5>
                            <!-- <form method="get"> -->
                            <select name="parent" style="color: #333" id="parent_location">
                                <option value="menu_order" selected="selected">All Areas </option>
                                @foreach($locations as $location)
                                    <option value="{{$location->id}}">{{$location->parentLocation_en->location}}</option>
                                @endforeach
                            </select>
                            <!--<input type="text" name="name" class="md-input" id="search" required="" placeholder="Type what it's your mind...">-->
                            <!-- </form> -->
                        </div>

                        <!-- Child Location -->
                        <div class="widget sidebar_widget">
                            <h5 class="aside-title text-uppercase">Choose Zone</h5>
                            <select name="child" style="color: #333" id="childLocation">
                                <option selected="selected">All Zone </option>
                            </select>
                        </div>

                        <!-- Child of Child Location -->
                        <div class="widget sidebar_widget">
                            <h5 class="aside-title text-uppercase">Choose Location</h5>
                            <select name="child_of_child" style="color: #333" id="childOfChildLocation">
                                <option value="" selected="selected">All Locations </option>
                            </select>
                        </div>

                        <!-- Size -->
                        <div class="widget sidebar_widget display-block">
                            <h5 class="aside-title text-uppercase">Choose Sizes</h5>
                            <div class="row">
                                <div class="container-fluid">
                                    @if($sizes)
                                        @foreach($sizes as $size)
                                            <div class="col-lg-6">
                                                <div class="form-check">
                                                    <input type="checkbox" name="size[]" value="{{$size->id}}"> {{$size->size}}<br>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mt-40" style="display: flex; flex-direction: row; justify-content: center">
                                <button class="btn btn-color btn-md btn-default" type="submit" ><i class="fa fa-filter"></i> Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mt-100">
                <div class="col-md-12">
                    <div class="text-center">
                        <div class="pagination text-uppercase dark-color">
                            <ul>
                                {!! $billboards->appends(request()->except('page'))->links() !!}
                                <!--<li><a href="{{@$billboards->previousPageUrl()}}"><i class="icofont icofont-long-arrow-left mr-5 xs-display-none"></i> Prev</a></li>-->
                                <!--@for($i=1; $i <= $billboards->lastPage(); $i++)-->
                                <!--    <li class="{{$i == $billboards->currentPage() ? 'active' : ''}}"><a href="?page={{$i}}">{{$i}}</a></li>-->
                                <!--@endfor-->
                                <!--<li><a href="{{@$billboards->nextPageUrl()}}">Next <i class="icofont icofont-long-arrow-right ml-5 xs-display-none"></i></a></li>-->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="details-popup" class="white-bg all-padding-30 mfp-with-anim mfp-hide centerize-col col-lg-4 col-md-6 col-sm-7 col-xs-11 text-center">
            <span class="text-uppercase font-25px font-600 mb-10 display-block dark-color">Enter Duration</span>

            <!-- -------------------- Tabs --------------------------- -->
            <div class="row mt-30 tabs-style-01">
                <div class="col-md-12">
                    <form name="contact-form" action="{{url('add/buildCamp')}}" method="POST" class="contact-form-style-01">
                    @csrf
                        <div class="messages"></div>
                        <div class="row">
                     <div class="container">
                        <div class="col-sm-6" style="height:130px;">
                            <div class="form-group">
                            <label for="from">From</label>
                                <div class='input-group date' id='datetimepicker1'>
                                    <input type='text' class="form-control" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar">
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="col-sm-6" style="height:130px;">
                            <div class="form-group">
                            <label for="to">To</label>
                                <div class='input-group date' id='datetimepicker2'>
                                    <input type='text' class="form-control" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar">
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                        </div>
                        <div class="row">
                            <div class="mt-10" style="display: flex; flex-direction: row; justify-content: center">
                                <button type="submit" class="btn btn-color btn-md btn-default"><i class="fa fa-filter"></i> Add To Campaign</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        @foreach($billboards as $billboard)

            <div id="details-popup{{$billboard->id}}" class="tesauth  white-bg all-padding-30 mfp-with-anim mfp-hide centerize-col col-lg-4 col-md-6 col-sm-7 col-xs-11 text-center">
                <span class="text-uppercase font-25px font-600 mb-10 display-block dark-color">Enter Duration</span>

                <!-- -------------------- Tabs --------------------------- -->
                <div class="row mt-30 tabs-style-01">
                    <div class="col-md-12">
                        <form name="contact-form" action="{{url('add-to-campaign')}}" method="POST" class="contact-form-style-01">
                            @csrf
                            @method('post')
                            <input type="hidden" name="code" value="{{$billboard->id}}">
                            <div class="messages"></div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="from">From</label>
                                        <input type="date" name="from" class="md-input" id="from"  placeholder="Email *" required data-error="Please Enter Valid Email">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="to">To</label>
                                        <input type="date" name="to" class="md-input" id="to" placeholder="Password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mt-10" style="display: flex; flex-direction: row; justify-content: center">
                                    <button type="submit" class="btn btn-color btn-md btn-default" href="clients.html"><i class="fa fa-filter"></i> Add To Campaign</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        @endforeach

    </section>
    <!--== Featured Product End ==-->

 



  

@endsection
