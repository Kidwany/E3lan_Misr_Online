@extends('website.layouts.layouts')
@section('title', 'Home')

@section('content')

    {{--    @if(session()->has('message'))--}}
{{--        <div class="alert alert-success">--}}
{{--            {{ session()->get('message') }}--}}
{{--        </div>--}}
{{--    @endif--}}

    <!--== Hero Slider Start ==-->
    <section class="remove-padding transition-none">
        <div id="rev_slider_1078_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="classic4export" data-source="gallery" style="margin:0px auto;background-color:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">
            <!-- START REVOLUTION SLIDER 5.4.1 fullwidth mode -->
            <div id="rev_slider_1078_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.4.1">
                <ul>
                    @if($slides)
                        @foreach($slides as  $key => $slide)
                            <li data-index="rs-{{3045 + $key}}" data-transition="zoomout" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="2000"  data-thumb="{{asset($slide->image->path)}}"  data-rotate="0"  data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7" data-saveperformance="off"  data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                            <!-- MAIN IMAGE -->
                            <img src="{{asset($slide->image->path)}}"  alt=""  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
                            <!-- LAYERS -->

                            <!-- LAYER NR. 1 -->
                            <div class="hero-text-wrap">
                                <div class="tp-caption NotGeneric-Title   tp-resizeme"
                                     id="slide-3045-layer-1"
                                     data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                     data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']"
                                     data-fontsize="['70','70','70','45']"
                                     data-lineheight="['70','70','70','50']"
                                     data-width="none"
                                     data-height="none"
                                     data-whitespace="nowrap"

                                     data-type="text"
                                     data-responsive_offset="on"

                                     data-frames='[{"from":"x:[105%];z:0;rX:45deg;rY:0deg;rZ:90deg;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":2000,"to":"o:1;","delay":1000,"split":"chars","splitdelay":0.05,"ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'
                                     data-textAlign="['left','left','left','left']"
                                     data-paddingtop="[10,10,10,10]"
                                     data-paddingright="[0,0,0,0]"
                                     data-paddingbottom="[10,10,10,10]"
                                     data-paddingleft="[0,0,0,0]"

                                     style="z-index: 5; white-space: nowrap;text-transform:left;font-family: 'Montserrat', sans-serif;">
                                    {!! $slide->{'slider_' . currentLang()}->title !!}
                                </div>

                                <!-- LAYER NR. 2 -->
                                <div class="tp-caption NotGeneric-SubTitle   tp-resizeme"
                                     id="slide-3045-layer-4"
                                     data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                     data-y="['middle','middle','middle','middle']" data-voffset="['52','52','52','51']"
                                     data-width="none"
                                     data-height="none"
                                     data-whitespace="nowrap"

                                     data-type="text"
                                     data-responsive_offset="on"

                                     data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","speed":2000,"to":"o:1;","delay":1500,"ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'
                                     data-textAlign="['left','left','left','left']"
                                     data-paddingtop="[0,0,0,0]"
                                     data-paddingright="[0,0,0,0]"
                                     data-paddingbottom="[0,0,0,0]"
                                     data-paddingleft="[0,0,0,0]"

                                     style="z-index: 6; white-space: nowrap;text-transform:left;font-family: 'Montserrat', sans-serif;letter-spacing: 0px;font-size:18px;">
                                    {!! $slide->{'slider_' . currentLang()}->description !!}
                                </div>

                                <!-- LAYER NR. 3 -->
                                <div class="tp-caption NotGeneric-Icon   tp-resizeme"
                                     id="slide-3045-layer-3"
                                     data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                     data-y="['middle','middle','middle','middle']" data-voffset="['120','120','120','120']"
                                     data-width="none"
                                     data-height="none"
                                     data-whitespace="nowrap"

                                     data-type="text"
                                     data-responsive_offset="on"

                                     data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":2000,"ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'
                                     data-textAlign="['left','left','left','left']"
                                     data-paddingtop="[0,0,0,0]"
                                     data-paddingright="[0,0,0,0]"
                                     data-paddingbottom="[0,0,0,0]"
                                     data-paddingleft="[0,0,0,0]"

                                     style="z-index: 7; white-space: nowrap;text-transform:left;cursor:default;"><a class="btn btn-color btn-lg btn-default" tabindex="0" href="{{$slide->url }}">{!! $slide->{'slider_' . currentLang()}->button !!}</a>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </section>

    <!--== Services ==-->
    <section class="white-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 section-heading">
                    <h5 class="default-color mb-0">Know More About</h5>
                    <h2 class="mt-0">Our Services</h2>
                </div>
                <!--<div class="col-md-12 col-sm-12 mb-50">
                    <img class="img-responsive" src="assets/images/gallery/service-img-big-01.jpg" alt="service" />
                </div>-->
                @foreach($services as $service)
                    <div class="col-md-4 col-sm-4 col-xs-12 xs-mb-30 wow fadeInRight" data-wow-delay="0.1s">
                        <h4 class="mb-0">{{@$service->service_en->title}}</h4>
                        <hr class="left-line default-bg">
                        <p style="height: 70px;">{{@$service->service_en->description}}</p>
                        <a class="btn btn-md btn-color btn-animate btn-square mt-20" href="{{url('services?parentService=' . $service->id)}}"><span>See More <i class="tr-icon icofont icofont-arrow-right"></i></span></a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--== Services ==-->
    <section style="background-image: url({{assetPath('website/assets/images/background/pattern-bg-dark.jpg')}});">
        <div class="container">
            <div class="row">
                <div class="col-md-6 parallax-content">
                    <h3 class="white-color font-700">E3lan Misr for OOH Media Solutions, an agency .</h3>
                    <h5 class="default-color mt-40">specified in outdoors’ advertisement based in Egypt since 2005, owning very large portfolio of locations among main roads and areas in Egypt</h5>
                    <p>It is worth noting that E3lan Misr have a distinctive reference list for many esteemed clients in various fields (Real Estate, Financial & Commercial, Oil & Petroleum, Food & Beverages, Electronics, Home Appliances, Media etc.</p>
                </div>
                <div class="col-md-6">
                    <div class="video-box"> <img class="img-responsive" src="{{asset('website/assets/images/video/images%20(6).jpg')}}" alt="">
                        <div class="video-box_overlay">
                            <div class="center-layout">
                                <div class="v-align-middle"> <a class="popup-youtube" href="https://www.youtube.com/watch?v=sU3FkzUKHXU">
                                        <div class="play-button"><i class="tr-icon ion-android-arrow-dropright"></i></div>
                                    </a> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== Video End ==-->

    <!--== Features ==-->
    <section class="remove-padding white-bg">
        <div class="container-fluid">
            <div class="row row-flex">
                <div class="col-md-4 col-xs-12">
                    <div class="col-inner spacer default-bg wow fadeInUp" data-wow-delay="0.1s">
                        <div class="text-center white-color">
                            <i class="icofont icofont-billboard font-40px white-icon"></i>
                            <h4 class="mt-40 font-600">Attractive Locations</h4>
                            <h6>Premium coverage of all the hot areas in Egypt! Not a single person will miss you ad!</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="col-inner spacer dark-bg wow fadeInUp" data-wow-delay="0.2s">
                        <div class="text-center white-color">
                            <i class="icofont icofont-sand-clock font-40px white-icon"></i>
                            <h4 class="mt-40 font-600">Monitoring Services</h4>
                            <h6>Our team is always working around the clock to ensure that nothing is wrong with your work!</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="col-inner spacer secondary-bg wow fadeInUp" data-wow-delay="0.3s">
                        <div class="text-center white-color">
                            <i class="icofont icofont-diamond font-40px white-icon"></i>
                            <h4 class="mt-40 font-600">Supreme Quality</h4>
                            <h6>Printing & Production require an eye for details, and we have that on our dedicated team, not a single misplaced pixel shall pass.</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== Features ==-->

    <!--== Subscribe Start ==-->
    <section class="pt-80 pb-80 dark-bg">
        <div class="container">
            <div class="row mt-50">
                <div class="col-sm-7 section-heading white-color">
                    <h3 class="font-600 mt-0">Sign up for newsletters</h3>
                    <p>Get to know E3lan Misr better, and be from the very firsts to know of the availability of your desired spots!</p>
                    <div class="tr-form-subscribe mt-30">
                        <form class="signup-form remove-margin" method="post">
                            <div class="input-group password-input-group">
                                <input type="email" name="EMAIL" id="Email" class="newsletter-input form-control form-group border-radius-0" value="" placeholder="Your Mail Address">
                                <button type="submit" class="newsletter-submit btn btn-light-outline btn-md btn-square" name="subscribe" id="Subscribe">
                                    <span>sign up now</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== Subscribe End ==-->

    <!--== Clients Start ==-->
    <section class="grey-bg pt-40 pb-40">
        <div class="container">
            <div class="row">
                <div class="client-slider slick">
                    @foreach($clients as $client)
                        <div class="client-logo"> <img class="img-responsive" src="{{url($client->image->path)}}" alt="{{$client->image->alt}}"/> </div>

                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="mt-40" style="display: flex; flex-direction: row; justify-content: center">
                    <a class="btn btn-color btn-md btn-default" href="{{url('client')}}">Show Clients</a>
                </div>
            </div>
        </div>
    </section>
    <!--== Clients End ==-->

@endsection


