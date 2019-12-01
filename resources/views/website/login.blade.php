@extends('website.layouts.layouts')
@section('title', 'Login')

@section('customizedScript')
@endsection

@section('content')

  <!--== Page Title Start ==-->
  <div class="transition-none">
        <section class="title-hero-bg parallax-effect" style="background-image: url({{url('website/assets/images/background/home-bg-32.jpg')}}); min-height: 350px !important;">
            <div class="container">
                <div class="page-title text-center white-color">
                    <h1>Login Or Register</h1>
                    <h4 class="text-uppercase mt-30">Login Or Register to your Account to Continue</h4>
                </div>
            </div>
        </section>
    </div>
    <!--== Page Title End ==-->


    <!--== Featured Product Start ==-->
    <section style="min-height: 350px">
        <div class="container">
                        @if(Session::has('registermessage'))
                <div class="alert-success w-100" style="">
                    <h6>{{session('registermessage')}}</h6>
                </div>
            @endif
                        @if(Session::has('error'))
                <div class="alert alert-danger w-100" style="">
                    <h6>{{session('error')}}</h6>
                </div>
            @endif

            <div class="row">
                <!-- -------------------- Tabs --------------------------- -->
                <div class="row mt-30 tabs-style-02" style="display: flex; flex-direction: row; justify-content: center">
                    <div class="col-md-8">

                        <div class="light-tabs">
                            <!--== Nav tabs ==-->
                            <ul class="nav nav-tabs text-center" role="tablist">
                                <li role="presentation" class="active"><a href="#login" role="tab" data-toggle="tab">Login</a></li>
                                <li role="presentation"><a href="#register" role="tab" data-toggle="tab">Register</a></li>
                            </ul>
                            <!--== Tab panes ==-->

                            <div class="tab-content text-center">
                                <!-- -------------------- Login Tab --------------------------- -->
                                <div role="tabpanel" class="tab-pane fade in active" id="login">
                                    <form name="contact-form" action="{{ route('login.customer') }}" method="POST" class="contact-form-style-01">
                                        @csrf
                                        <div class="messages"></div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="sr-only" for="email">Email</label>
                                                    <input type="email" class="md-input {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" id="email" placeholder="Email *" required data-error="Please Enter Valid Email">
                                                    <div class="help-block with-errors">
                                                        @if ($errors->has('email'))
                                                            <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="sr-only">Password</label>
                                                    <input type="password" name="password" class="md-input {{ $errors->has('password') ? ' is-invalid' : '' }}" id="subject-2" placeholder="Password" required>
                                                </div>
                                                <div class="help-block with-errors">
                                                    @if ($errors->has('password'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mt-10" style="display: flex; flex-direction: row; justify-content: center">
                                                <button type="submit" class="btn btn-color btn-md btn-default" href="clients.html"><i class="fa fa-filter"></i> Login</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- -------------------- Register Tab --------------------------- -->
                                <div role="tabpanel" class="tab-pane fade" id="register">
                                    <form name="contact-form" action="{{route('register.customer')}}" method="POST" class="contact-form-style-01">
                                        @csrf
                                        <div class="messages"></div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="sr-only" for="email">Name</label>
                                                    <input type="text" name="name" class="md-input" id="Name" placeholder="Name *" required data-error="Please Enter Valid Email" value="{{old('name')}}">
                                                    <div class="help-block with-errors">
                                                        @if ($errors->has('name'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="sr-only" for="email">Email</label>
                                                    <input type="email" name="email" class="md-input" id="email" placeholder="Email *" required data-error="Please Enter Valid Email" value="{{old('email')}}">
                                                    <div class="help-block with-errors">
                                                        @if ($errors->has('email'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="sr-only">Password</label>
                                                    <input type="password" name="password" class="md-input" id="subject-2" placeholder="Password *" required>
                                                    <div class="help-block with-errors">
                                                        @if ($errors->has('password'))
                                                            <span class="invalid-feedback">
                                                                <strong>{{ $errors->first('password') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="sr-only">Confirm Password</label>
                                                    <input type="password" name="password_confirmation" class="md-input"  placeholder="Confirm Password" required>
                                                    @if ($errors->has('password_confirmation'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mt-10" style="display: flex; flex-direction: row; justify-content: center">
                                                <button type="submit" class="btn btn-color btn-md btn-default" ><i class="fa fa-filter"></i>Register</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== Featured Product End ==-->

  


  

@endsection
