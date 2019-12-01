@extends('website.layouts.layouts')
@section('title', 'My Campaigns')

@section('customizedScript')
@endsection

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

    <section class="">
        @include('dashboard.layouts.messages')
        <div class="container">
            <!--======================== First Campaign =======================-->
            @if(count($campaigns) > 0)
                @foreach($campaigns as $campaign)
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12 xs-mb-30">
                            <h2 class="font-700 font-40px mt-20">{{$campaign->campaignDetails->name}}</h2>
                            <hr class="left-line white-bg">
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <div class="row mt-50 ">
                                <div class="col-md-3 col-sm-6 col-xs-12 xs-mb-20">
                                    <ul class="portfolio-meta">
                                        <li><span> Requested at </span> </li>
                                        <li>{{$campaign->created_at->format('d M Y')}}</li>
                                    </ul>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 xs-mb-20">
                                    <ul class="portfolio-meta">
                                        <li><span> Company </span></li>
                                        <li>{{$campaign->campaignDetails->company}}</li>
                                    </ul>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 xs-mb-20">
                                    <ul class="portfolio-meta">
                                        <li><span> Status </span></li>
                                        <li>
                                            @if($campaign->status == 2)
                                                Submitted
                                                @elseif($campaign->status == 3)
                                                Accepted
                                                @elseif($campaign->status == 4)
                                                Rejected
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-3 col-sm-6 col-xs-12 xs-mb-20">
                                    <ul class="portfolio-meta">
                                        <li><span> Availability </span></li>
                                        <li>Available</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="check-btns">
                            <div >
                                <a href="{{url('my-campaigns/details')}}/{{$campaign->id}}" class="btn btn-color btn-md btn-animate" data-effect="mfp-zoom-in">
                                <span>Campaign Items <i class="ion-checkmark"></i></span></a>
                                <!-- <a href="#camp-details{{$campaign->id}}" class="btn btn-color btn-md btn-animate" data-effect="mfp-zoom-in"><span>Campaign Items <i class="ion-checkmark"></i></span></a> -->
                            </div>
                        </div>
                    </div>
                    <div class="line-horizontal grey-bg width-100-percent centerize-col mt-10"></div>
                @endforeach
                @else
                <p class="text-center">No Campaigns Found</p>
            @endif
            <!--======================== Second Campaign =======================-->
        </div>
    </section>

    @if($campaigns)
        @foreach($campaigns as $campaign)
            <div id="camp-details{{$campaign->id}}" class="white-bg all-padding-30 mfp-with-anim mfp-hide centerize-col col-lg-10 col-md-10 col-sm-9 col-xs-11 text-center">
                <span class="text-uppercase font-25px font-600 mb-10 display-block dark-color">Campaign Items</span>
                <!-- -------------------- Tabs --------------------------- -->
                <div class="container">
                    <div class="col-md-11">
                        <div class="table-responsive">
                            <table class="table table-bordered shop-cart">
                                <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Code</th>
                                    <th>Type</th>
                                    <th>Duration</th>
                                    <th>Zone</th>
                                    <th>Location</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($campaign)
                                    @foreach($campaign->campaignItems as $item)
                                        <tr class="cart_item">
                                            <td><a href="{{url('serviceDetails/' . $item->billboard_id)}}"> <img src="{{asset($item->requestedBillboard->image->path)}}" alt=""> </a> </td>
                                            <td><a href="{{url('serviceDetails/' . $item->billboard_id)}}">{{$item->requestedBillboard->code}}</a> </td>
                                            <td><span>{{$item->requestedBillboard->service->{'service_' . currentLang()}->title }}</span> </td>
                                            <td>
                                                From: <span style="font-weight: bold" class="black">{{$item->starts->format('d M Y')}}</span><br>
                                                To: <span style="font-weight: bold" class="black">{{$item->end->format('d M Y')}}</span><br>
                                            </td>
                                            <td><span>{{$item->requestedBillboard->parentLocation->parentLocation_en->location}}</span> </td>
                                            <td><span>{{$item->requestedBillboard->childLocation->childLocation_en->location}}</span> </td>
                                        </tr>
                                    @endforeach
                                @endif

                                </tbody>
                            </table>
                        </div>
                        <div class="summary-cart">
                            <h6 class="upper-case">Financial Details</h6>
                            <table class="order_table table-responsive table">
                                <tbody>
                                <tr>
                                    <th>Price</th>
                                    <td><span>{{$campaign->campaignDetails->price}} L.E</span> </td>
                                </tr>
                                <tr>
                                    <th>Printing Cost</th>
                                    <td><span>{{$campaign->campaignDetails->printing_cost}} L.E</span> </td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td><h6><strong>{{$campaign->campaignDetails->price + $campaign->campaignDetails->printing_cost}} L.E</strong></h6></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
    @endif


@endsection
