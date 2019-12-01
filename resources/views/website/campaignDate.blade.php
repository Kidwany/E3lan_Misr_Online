@extends('website.layouts.layouts')
@section('title', 'Campaign Date')

@section('customizedScript')
@endsection

@section('content')

  <!--== Page Title Start ==-->
  <div class="transition-none">
        <section class="title-hero-bg parallax-effect" style="background-image: url({{url('website/assets/images/background/calendar-date-bg.jpg')}}); min-height: 350px !important;">
            <div class="container">
                <div class="page-title text-center white-color">
                    <h1>Start Planing Your Campaign</h1>
                    <h4 class="text-uppercase mt-30">Enter Your Next Campaign Peoriod</h4>
                </div>
            </div>
        </section>
    </div>
    <!--== Page Title End ==-->


    <!--== Featured Product Start ==-->
    <section style="min-height: 350px">
        <div class="container">
            <div class="row">
                <!-- -------------------- Tabs --------------------------- -->
                <div class="row mt-10 tabs-style-02" style="display: flex; flex-direction: row; justify-content: center">
                    <div class="col-md-9">

                        @include('website.layouts.messages')
                        <form name="contact-form" method="POST" action="{{url('store-campaign-date')}}">
                            @csrf
                            @method('post')
                            <div class="checkout-form">
                                <div class="row">
                                    <div class="col-md-12 mb-20 col-xs-12 col-sm-6">
                                        <div class="mb-20">
                                            <h5 class="upper-case text-center">Enter Your Next Campaign Period</h5>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Start Date</label>
                                                <input type="month" name="start" class="form-control" required="" placeholder="Enter Your Company Name" data-error="Your Name is Required" value="">
                                                <div class="help-block with-errors mt-20"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>End Date</label>
                                                <input class="form-control" id="address" name="end" type="month" required="" placeholder="Ex: Marketing Manager" data-error="Address is Required" value="">
                                                <div class="help-block with-errors mt-20"></div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12" style="display: flex; flex-direction: row; justify-content: center">
                                                <div class="summary-cart no-border">
                                                    <div class="check-btns">
                                                        <button type="submit" class="btn btn-color btn-md btn-animate"><span>Start Building Campaign <i class="ion-checkmark"></i></span></button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== Featured Product End ==-->

  


  

@endsection
