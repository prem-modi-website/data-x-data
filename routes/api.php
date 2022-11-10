<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(["middleware"=>'api'],function(){
    Route::post('/importexcelfile','importController@importExcelFile')->name('importExcelFile');
    Route::post('register','Blogcontroller@registration')->name('register');
    Route::post('deactive-user','Blogcontroller@userdeactivated')->name('userdeactivated');
    Route::post('active-user','Blogcontroller@useractivated')->name('useractivated');
    Route::post('login','Blogcontroller@login')->name('login');
    Route::post('profile','Blogcontroller@profile')->name('profile');
    Route::post('logout','Blogcontroller@logout')->name('logout');
    Route::post('forgot-password','Blogcontroller@forgot')->name('forgot');
    Route::post('changepassword','Blogcontroller@renamepassword');
    Route::post('password-change','Blogcontroller@passwordchange');
    Route::get('get-users','Blogcontroller@allUsers');
    
    
    //category
    Route::post('add-category','categoryController@addCategory');
    Route::get('get-all-category','categoryController@getAllCategory');
    Route::get('get-single-category','categoryController@getSingleCategory');
    Route::post('edit-category','categoryController@editCategory');
    Route::post('delete-category','categoryController@deleteCategory');
    Route::get('recent-category','categoryController@recentCategory');
    
    //exportjson
    Route::post('export-data','categoryController@exportData');
    Route::get('get-excel-data','importController@getExportData');
    Route::post('delete-excel-data','importController@deleteExportData');
    Route::get('single-excel-data','importController@singleExportView');
    Route::post('update-excel-data','importController@updateExportView');
    Route::get('search-list','importController@searchData');
    Route::get('daily-update-data','importController@getExportDataSerialize');
    
    
    //packages
    Route::post('package-data','pacakgeController@packageData');
    Route::post('delete-package-data','pacakgeController@deletePacakgeData');
    Route::get('get-package-data','pacakgeController@getPackageData');
    Route::get('get-single-package-data','pacakgeController@getSinglePackageData');
    Route::post('update-package-data','pacakgeController@updatePackageData');
    Route::get('add-cart','pacakgeController@addCart');
    Route::get('cart-item','pacakgeController@cartItem');
    Route::get('delete-cart-item','pacakgeController@deletecartItem');

    Route::post('create-block-data','pacakgeController@createBlock');
    Route::get('get-block-data','pacakgeController@getBlock');
    Route::post('un-block-data','pacakgeController@unBlock');
    
    
    Route::post('order-details','pacakgeController@orderDetails');
    
    Route::post('order-details-checklist','pacakgeController@billingDetails');

    Route::post('payment-details','pacakgeController@paymentDetails');
    
    Route::get('get-all-order-details','pacakgeController@getAllOrderDetails');
    
    
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
