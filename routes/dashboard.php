<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*==============================================   Dashboard Routes    ====================================================*/

Route::group(['middleware' => 'auth' ,'namespace' => 'Dashboard' , 'prefix' => 'e3lan-misr-admin'], function () {


    /* -- Return Home Page -- */
    Route::get('/', 'DashboardController@index')->name('e3lan-misr-admin');

    /* -- Return Slider Page -- */
    Route::resource('/slider', 'SliderController');

    /* -- Return Service Page -- */
    Route::resource('/service', 'ServiceController');
    Route::get('/service/{id}/create', 'ServiceController@createSubService');
    Route::post('/sub-service/create', 'ServiceController@storeSub');

    /* -- Return Client Page -- */
    Route::resource('/client', 'ClientController');

    /* -- Return Testimonial Page -- */
    Route::resource('/testimonial', 'TestimonialController');

    /* -- Return Team Page -- */
    Route::resource('/team', 'TeamController');

    /* -- Return Appointment Page -- */
    //Route::resource('/appointment', 'AppointmentController');

    /* -- Return Video Page -- */
    Route::resource('/video', 'VideoController');


    /* -- Return Video Page -- */
    //Route::resource('/blog', 'BlogController');

    /* -- Return Album Page -- */
    Route::resource('/album', 'AlbumController');

    /* -- Return Gallery Page -- */
    Route::resource('/gallery', 'GalleryController');
    Route::get('/album/{id}/upload-to-gallery', 'AlbumController@uploadPage');
    Route::post('/album/{id}/upload-to-gallery', 'AlbumController@upload');

    /* -- Return Message Page -- */
    Route::resource('/message', 'MessageController');

    /* -- Return Feature Page -- */
    Route::resource('/feature', 'FeatureController');

    /* -- Return Product Page -- */
    //Route::resource('/product', 'ProductController');

    /*--------  About   --------*/
    Route::get('/about/edit', 'AboutController@edit');
    Route::patch('/about/update', 'AboutController@update');

    /*--------  Contact   --------*/
    Route::get('/contact/edit', 'ContactController@edit');
    Route::patch('/contact/update', 'ContactController@update');


    /*--------  Setting   --------*/
    Route::get('/setting/edit', 'SettingController@edit');
    Route::patch('/setting/update', 'SettingController@update');


    /* -- Return Gallery Page -- */
    Route::resource('/gallery', 'GalleryController');
    Route::post('/upload-to-gallery', 'GalleryController@uploadImagesToGallery');


    /* -- Project -- */
    Route::resource('/project', 'ProjectController');
    Route::delete('/project/delete-image/{id}', 'ProjectController@deleteImage');
    Route::get('/project/{id}/images', 'ProjectController@projectImages');


    //Route::get('campaign-request/{$id}', 'CampaignController@index');

    /* --- Parent Location ---*/
    Route::resource('parent-location', 'ParentLocationController');

    /* --- Child Location ---*/
    Route::resource('child-location', 'ChildLocationController');

    /* --- letter Location ---*/
    Route::resource('letter-location', 'LetterLocationController');

    /* --- Child of Child Location ---*/
    Route::resource('child-of-child-location', 'ChildOfChildLocationController');

    /* --- Parent Location ---*/
    Route::get('billboard/map', 'BillboardController@billboardmap');

    Route::resource('billboard', 'BillboardController');
    Route::get('billboard/{id}/images', 'BillboardController@billboardImages');
    Route::delete('billboard/image/{id}/destroy', 'BillboardController@deleteBillboardImage');
    Route::get('child-locations/{id}', 'BillboardController@getChildLocations');
    Route::get('child-of-child-locations/{id}', 'BillboardController@getChildOfChildLocations');
    Route::get('sub-services/{id}', 'BillboardController@getSubServices');

    /* --- Billboards Sizes ---*/
    Route::resource('size', 'SizeController');

    /* --- Suppliers ---*/
    Route::resource('supplier', 'SuppliersController');

    /* --- Billboard Type ---*/
    Route::resource('billboard-type', 'BillboardTypeController');

    /* --- Campaign Requests  ---*/
    Route::get('/campaign-request', 'CampaignController@index');
    Route::get('campaign-request/{id}', 'CampaignController@show');

    /* --- Billboard Reservation Period ---*/
    Route::get('billboard/{id}/calendar', 'BillboardController@calendar');
    Route::post('billboard/calendar/store', 'BillboardController@addAppointment');
    Route::delete('billboard/calendar/{id}/destroy', 'BillboardController@deleteAppointment');


});



Auth::routes();

Auth::routes();

Route::get('/home', 'HomeController@campaign')->name('home');
