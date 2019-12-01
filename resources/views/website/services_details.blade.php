@extends('website.layouts.layouts')
@section('title', 'Campaign')
@section('content')
    <!--== Project Banner Start ==-->
    <section class="remove-padding cover-bg" style="background-image: url({{asset($billboard->image->path)}}); height: 80vh">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 remove-padding">
                </div>
            </div>
        </div>
    </section>
    <!--== Project Banner End ==-->


    <section class="white-bg bordered-bg">
        @include('dashboard.layouts.messages')
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-12 xs-mb-30">
                    <h2 class="roboto-font font-300">{{$billboard->billboard_en->name}}</h2>
                    <p> {{$billboard->billboard_en->description}}</p>
                    <p class="mt-30">
                    <div class="tr-modal-popup">
                        <a href="#details-popup"  data-effect="mfp-zoom-in" class="btn btn-md btn-dark-outline btn-animate btn-square">
                            <span>Add To Your Next Campaign <i class="tr-icon icofont icofont-arrow-right"></i>
                            </span>
                        </a>
                    </div>
                    </p>

                    <div id="details-popup" class="white-bg all-padding-30 mfp-with-anim mfp-hide centerize-col col-lg-4 col-md-6 col-sm-7 col-xs-11 text-center">
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
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 xs-mb-30">
                    <ul class="portfolio-meta">
                        <li><span> Code </span> {{$billboard->code}}</li>
                        <li><span> Area </span> {{$billboard->parentLocation->parentLocation_en->location}}</li>
                        <li><span> Zone </span> {{$billboard->child_location_id ? $billboard->childLocation->childLocation_en->location : ''}}</li>
                        <li><span> Location </span> {{$billboard->child_of_child_location_id ? $billboard->childOfChildLocation->childOfChildLocation_en->location : ''}}</li>
                        <li><span> Type </span>
                            @if(!empty($billboard->type->type))
                            {{$billboard->type->type}}
                            @endif
                        </li>
                        <li><span> Size </span> {{$billboard->billboardSize->size}}</li>
                        <li><span> Dimensions </span> {{$billboard->dimension}}</li>
                        <li><span> Faces </span> {{$billboard->faces}} Faces</li>
                        <li><span> Light </span> {{$billboard->light}}</li>
                        <li><span> Material </span> {{$billboard->material}}</li>
                        <li><span> Category </span><a href="{{url('services?parentService=' . $billboard->service_id)}}"> {{$billboard->service->{'service_' . currentLang()}->title }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    @if(count($billboard->images) > 0)
        <!--== Related Projects Start ==-->
        <section class="white-bg bordered-bg dark-block">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-12 centerize-col wow fadeInUp text-center" data-wow-delay="0.1s">
                        <h2 class="mt-0 font-300 roboto-font mb-0">Billboard Images</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div id="portfolio-gallery" class="cbp mt-50">
                            @foreach($billboard->images as $image)
                                <div class="cbp-item col-md-4 col-sm-4 with-spacing">
                                    <div class="portfolio gallery-image-hover text-center">
                                        <div class="folio-overlay"></div>
                                        <img src="{{asset($image->path)}}" alt="">
                                        <div class="portfolio-wrap">
                                            <ul class="portfolio-details top-80">
                                                <li><a class="cbp-lightbox" href="{{asset($image->path)}}"><i class="icofont icofont-search"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--== Related Projects End ==-->
    @endif


    <section class="white-bg mt-10">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-12 centerize-col wow fadeInUp text-center" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                    <h2 class="mt-0 font-300 roboto-font mb-0">Billboard Area</h2>
                </div>
            </div>
        </div>
    </section>

    <iframe src="{{$billboard->location}}" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>



@endsection
