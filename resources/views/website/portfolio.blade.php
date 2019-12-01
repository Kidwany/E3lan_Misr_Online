@extends('website.layouts.layouts')
@section('title', 'Portfolio')

@section('content')



<!-- <div class="transition-none">
      <section class="title-hero-bg parallax-effect " style=" transform: translateY(0px);">
        <div class="container">
            <div class="page-title text-center white-color">
               
            </div>
        </div>
      </section>
  </div>
-->


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
         
<script type='text/javascript'> 



         
function get_sub(id)
{
 
  $(document).ready(function () {
                    $.ajax({
                        header: '@csrf',
                        url: 'getSubCategoryByid/' + id,
                        type: "GET",
                        dataType: 'json',
                        success: function (data) {
                          document.getElementById("products").innerHTML=""
                          console.log(data[1][0]['image']['path']);
                          for(i=0;i<data[0].length;i++)
                          {
                           
                            var url = '{{ route("product", [":id",":cat_id"]) }}';
                            url = url.replace(':id', data[i][0]["id"]).replace(':cat_id', id);;
                          
                          document.getElementById("products").innerHTML += '<div class="cbp-item '+data[i]['category_id']+'x col-md-3 col-sm-6" ">'+
                  '<div class=" portfolio gallery-image-hover text-center" >'+
                    '<div class="folio-overlay "></div>'+
                    '<img src="'+data[0][i]['url']+'" alt="" >'+
                    '<div class="portfolio-wrap">'+
                      '<ul class="portfolio-details top-80">'+
                        '<li><a class=""  href='+url+'><i class="icofont icofont-search"></i>x</a></li>'+
                      '</ul></div></div></div>';
                   
                          }



                          
                          

                          
                        }
                    })
            });
}
</script>

  <!--== Portfolio Start ==-->
  <section class="white-bg pb-0">
  	<div class="container-fluid remove-padding">
    	<div class="row">
         <div class="col-md-12 text-center">
          <h2 class="mt-0 font-700">Our Work</h2>
        	<hr class="center_line line2 default-bg bold-line">
        </div>
 
        	<div class="col-md-12">
        	    	<div id="portfolio-gallery-filter" class="cbp-l-filters-alignCenter text-sm-center mb-100">
    @foreach($categories as $catrgory)
    
              <div data-filter=".{{$catrgory['id']}}x" class="cbp-filter-item" value="{{ $catrgory['id'] }}" onclick="get_sub({{ $catrgory['id'] }})">
                   {{ $catrgory->service_en->title }}
              </div>
              @endforeach
              
    
            </div>
            </div>
            <div class="col-md-12 portofiliogall">
<div id="products">
</div>
 <div id="portfolio-gallery" class="cbp" >

 
              
          
           
                
    		      </div>
            </div>
        </div>
    </div>
  </section>
  <!--== Portfolio End ==-->



  <!--== Call to Actions Start ==-->
  <section class="white-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-7 col-xs-12 centerize-col text-center">
              <h6 class="mb-30 font-50px font-700 mt-0">Caught your attention?</h6>
              <a class="btn btn-md btn-color btn-animate btn-square" href="{{ url('/contact') }}"><span>Contact Us <i class="tr-icon icofont icofont-arrow-right"></i></span></a>
            </div>
        </div>
    </div>
  </section>
  <!--== Call to Actions End ==-->
  <script src="{{asset('js/jquery.min.js')}}"></script>
  

  <script type='text/javascript'>
  
  window.addEventListener('load', function() {
    console.log('All assets are loaded')
})
$(window).on('load', function() {
  
  $.ajax({
                        header: '@csrf',
                        url: 'getSubCategoryByid/' + 23,
                        type: "GET",
                        dataType: 'json',
                        success: function (data) {
                          document.getElementById("products").innerHTML=""
                          console.log(data[1][0]['image']['path']);
                          for(i=0;i<data[0].length;i++)
                          {
                           
                        
                            var url = '{{ route("product", [":id",":cat_id"]) }}';
                            url = url.replace(':id', data[i][0]["id"]).replace(':cat_id', 1);;
                          
                          document.getElementById("products").innerHTML += '<div class="cbp-item '+data[i]['category_id']+'x col-md-3 col-sm-6" ">'+
                  '<div class=" portfolio gallery-image-hover text-center" >'+
                    '<div class="folio-overlay "></div>'+
                    '<img src="'+data[1][0]['image']['path']+'" alt="" >'+
                    '<div class="portfolio-wrap">'+
                      '<ul class="portfolio-details top-80">'+
                        '<li><a class=""  href='+url+'><i class="icofont icofont-search"></i>x</a></li>'+
                      '</ul></div></div></div>';
                          }



                          
                          

                          
                        }
                    })
  

})
  </script>


@endsection