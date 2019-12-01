
<!--== Header Start ==-->
<nav class="navbar navbar-default navbar-fixed navbar-transparent white bootsnav on no-full">

    <!--== Start Top Search ==-->
    <div class="fullscreen-search-overlay" id="search-overlay"> <a href="#" class="fullscreen-close" id="fullscreen-close-button"><i class="icofont icofont-close"></i></a>
        <div id="fullscreen-search-wrapper">
            <form method="get" action="{{route('search')}}" id="fullscreen-searchform">
                @csrf
                <input type="text" value="" name="search" placeholder="Search..." id="fullscreen-search-input" class="search-bar-top">
                <i class="fullscreen-search-icon icofont icofont-search">
                    <input value="" type="submit">
                </i>
            </form>
        </div>
    </div>
    <!--== End Top Search ==-->

    <div class="container">
        <!--== Start Attribute Navigation ==-->
        <div class="attr-nav hidden-xs sm-display-none">
            <ul class="social-media-dark social-top">
                @if(!Auth::user())
                    <li><a href="{{url('/login/customer')}}" class="icofont icofont-login default-color"> Login</a></li>
                @endif
                <li class="search"><a href="#" id="search-button"><i class="icofont icofont-search"></i></a></li>
            </ul>
        </div>
        <!--== End Attribute Navigation ==-->

        <!--== Start Header Navigation ==-->
        <div class="navbar-header">
            <div class="mobile-navbar">
                <div>
                    <div class="logo">
                        <a href="{{url('/')}}"> <img class="logo logo-display" src="{{asset($setting->image->path)}}" alt="">
                            <img class="logo logo-scrolled" src="{{asset('website/assets/images/logo/Dark.png')}}" alt="">
                        </a>
                    </div>
                </div>
                <div style="display: flex">
                    <button type="button" class="icofont icofont-search" id="search-button-mobile"></button>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu"> <i class="tr-icon ion-android-menu"></i> </button>
                </div>
            </div>

            <div class="logo mobile-hidden">
                <a href="{{url('/')}}"> <img class="logo logo-display" src="{{asset($setting->image->path)}}" alt="">
                    <img class="logo logo-scrolled" src="{{asset('website/assets/images/logo/Dark.png')}}" alt="">
                </a>
            </div>

{{--
            <div class="search"><a href="#" id="search-button"><i class="icofont icofont-search"></i></a></div>
--}}

        </div>
        <!--== End Header Navigation ==-->

        <!--== Collect the nav links, forms, and other content for toggling ==-->
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="nav navbar-nav" data-in="fadeIn" data-out="fadeOut">
                <li> <a href="{{url('/')}}">Home</a></li>
                <li><a href="{{url('about')}}">About</a></li>
                <li class="dropdown">
                    <a href="{{url('services?service=all')}}" class="dropdown-toggle" data-toggle="dropdown">Services</a>
                    <ul class="dropdown-menu">
                        @if($services)
                            @foreach($services as $service)
                                @if(count($service->childService) == 0)
                                    <li> <a href="{{url('services?parentService=' . $service->id)}}">{{$service->{'service_' . currentLang()}->title }}</a></li>
                                @endif
                                @if(count($service->childService) > 0)
                                    <li class="dropdown"> <a href="{{url('services?service=' . $service->{'service_' . currentLang()}->title)}}" class="dropdown-toggle" data-toggle="dropdown">{{$service->{'service_' . currentLang()}->title }} </a>
                                        <ul class="dropdown-menu">
                                            @foreach($service->childService as $child)
                                                <li>
                                                    <a href="{{url('services?childService=' . $child->id)}}">
                                                        {{$child->{'service_' . currentLang()}->title}}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </li>
                <li><a href="{{url('portfolio')}}">portfolio</a></li>
                <li><a href="{{url('client')}}">Our Clients</a></li>
                <li><a href="{{url('campaign-date')}}">Build Your Campaign</a></li>
                <li><a href="{{url('contact')}}">Contact</a></li>
                @if(Auth::user())
                    <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Auth::user()->name}}</a>
                        <ul class="dropdown-menu">
                            <li> <a href="{{url('Show-SaveGraft-Items')}}" class="dropdown-toggle" data-toggle="dropdown">Show-SaveGraft-Items</a></li>
                            <li> <a href="{{url('show-requested-items')}}" class="dropdown-toggle" data-toggle="dropdown">Show Requested Items</a></li>
                            <li> <a href="{{url('my-campaigns')}}" class="dropdown-toggle" data-toggle="dropdown">My Campaigns</a></li>
                            <div class="line-horizontal grey-bg width-100-percent centerize-col"></div>
                            <li> <a href="{{url('logout/customer')}}" class="dropdown-toggle" data-toggle="dropdown">Logout</a></li>
                        </ul>
                    </li>
                @endif
                @if(!Auth::user())
                    <li class="desktop-hidden"><a href="{{url('/login/customer')}}" class="default-color">Login</a></li>
                @endif
            </ul>
        </div>
        <!--== /.navbar-collapse ==-->
    </div>
</nav>
<!--== Header End ==-->
