<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Service;
use App\Models\Service_Product;
use App\Models\Product_image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories= Service::with('service_en')->where('parent_service_id', null)->get();

        // dd($categories[0]->service_en->title);
        return view('website.portfolio',compact('categories'));
    }
    public function getsubbyid($id)
    {
       
        $sub=Service_Product::with('service_id')->where('service_id' ,$id)->get();
        $im=Service::with('image')->where('id', $id)->get();
         if(count($sub) >0)
         {
           
            return [$sub,$im];
         }
        else{
            //  no product
            return 1;
        }
        
        // $products=Sub_category_product::where('category_id',$id)->get();
        
       
    }


    public function getProduct($id,$cat_id)
    {

        
        $product_images=Product_image::with('service_product')->where('product_id' ,$id)->get();
       return view('website.product',compact('product_images'));

        //
        // $product=Product::find($id);

        // // branding id=4
        // if($cat_id==4)
        // {
        //     $product_images=ProductImages::where('product_id',$product->id)->get();
        //     return view("productbrand",["product"=>$product,"product_images"=>$product_images]);
        // }
        // else{
        // return view("product",["product"=>$product]);
        // }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
