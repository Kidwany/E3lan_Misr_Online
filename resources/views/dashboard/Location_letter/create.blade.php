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
@endsection
{{-- Start of page Content --}}
@section('content')

    <section class="content-header">
        <h1>
            Letters
            <small>Create New Letter</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{adminUrl('/')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{adminUrl('/letter-location')}}">Letters</a></li>
            <li class="active">Create letter</li>
        </ol>
    </section>



    <section class="content">
        @include('dashboard.layouts.messages')
        <form role="form" action="{{route('letter-location.store')}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('post')
            <input type="hidden" name="created_by">
            <div class="row">
                <!-- English Side -->
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                        <h3 class="box-title">Add letter Info</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-lg-6">
                                <label for="exampleInputEmail1"> letter Name</label>
                                <input type="text" class="form-control" name="lettername" id="exampleInputEmail1" placeholder="Enter letter Name" value="{{old('location')}}">
                                <p class="help-block">Enter letter Name</p>
                            </div>

                            <div class="col-lg-6">
                                <label for="exampleInputEmail1"> Letter</label>
                                <input type="text" class="form-control" name="letter" id="exampleInputEmail1" placeholder="Enter Letter" value="{{old('letter')}}">
                                <p class="help-block">Enter letter</p>
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
