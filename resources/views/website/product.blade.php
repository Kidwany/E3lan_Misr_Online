@extends('website.layouts.layouts')
@section('title', 'Contact')

@section('content')

<link rel="stylesheet" type="text/css" href="{{assetPath('website/assets/css/master_edit.css')}}">
<div class="transition-none">
        <section class="title-hero-bg parallax-effect" style="background-image: url({{assetPath('website/assets/images/clients/clients_bg.jpg')}});">
            <div class="container">
                <div class="page-title text-center white-color">
                    <h1></h1>
                    <h4 class="text-uppercase mt-30"></h4>
                </div>
            </div>
        </section>
    </div>

 <!--== Sliders Style 02 Start ==-->
 <section class="" style="padding-top:0px !important;">
    <div class="container-fluid">
    	<div class="row">
        	<div class="col-sm-8 section-heading">
              <h4 class="text-uppercase mt-0"></h4>
        	</div>
        </div>
    </div>
  </section>

  <section class="pt-0 pb-0 dark-block">
  @if(count($product_images)==0)
  <div style="text-align:center" >
   <h3 class="font-700">No Result found.</h3>
   </div>
    @endif
    <div class="service-slider-2 slick height-800px" >
   
    @foreach($product_images as $product_image)
      <div class="slide height-800px">
       
@if($product_image->isimage==1)
<div class="slide-img height-800px" style="background:url(/{{$product_image->url}}) center center / cover scroll no-repeat; "></div>
        
        <div class="container">
          <div class="row">


              <div class=" default-bg all-padding-50">
              	
                       
          						<!-- <h3 class="font-700">Creative & innovative digital agency.</h3>
          						<p class="mt-30"><a class="btn btn-dark btn-lg btn-default">Buy Template</a> </p> -->
                      </div>
                 
                 
            
                 </div>
               </div>
               </div>
@else

<div class="slide-img height-800px" style="background-image: url(/dashboardImages/project/bg-left-img.jpg); background-repeat: no-repeat; background-size: cover;"></div>
        
        <div class="container">
          <div class="row">


              <div class="white-color default-bg all-padding-50">
                   <!--== Video Start ==-->

                   
                   <section class="parallax-bg fixed-bg"   data-parallax-bg-image="dashboardImages/project/bg-left-img.jpg" data-parallax-speed="0.8" data-parallax-direction="up">
  	<!-- <div class="parallax-overlay" ></div> -->
  	<div class="container">
  		<div class="row">
  			<div class="col-md-12 text-center parallax-content">
  				<div class="center-layout">
                <div class="v-align-middle">
      					 <a class="popup-youtube" href="{{$product_image->url}}">
      					  <div class="play-button" style="background-color: #0a0e40;">
      					  	<i class="tr-icon ion-android-arrow-dropright" style="color: white;"></i>
      					  </div>
      					 </a>
                  <h2 class="white-color">We create web & tech solutions<br> that bring you results</h2>
                  
                </div>
              </div>
  			</div>
  		</div>
  	</div>
  </section>
  <!--== Video End ==-->
  </div>
                 
                 
            
                 </div>
               </div>
               </div>
                  @endif
            
      
      @endforeach
      

 
  </section>
  <!--== Sliders Style 02 End ==-->
  @endsection