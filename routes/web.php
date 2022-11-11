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
|
*/
//welcome
//date
//add data

Route::get('data','Blogcontroller@index')->name('data');
Route::get('datamain','Blogcontroller@datamain')->name('datamain');

Route::get('excel/{vin}','Blogcontroller@excel')->name('excel');

Route::get('register','Blogcontroller@registration')->name('register');

Route::get('profile','Blogcontroller@profile')->name('profile');

Route::get('mail','Blogcontroller@mail')->name('mail');
Route::get('forgot-password','Blogcontroller@forgotdata')->name('forgot');
Route::post('forgot','Blogcontroller@forgotstore')->name('forgotstore');


Route::get('change-password','Blogcontroller@changepassword')->name('changepassword');

Route::post('change-password','Blogcontroller@changepass')->name('changepass');

Route::get('form','Blogcontroller@logindata')->name('login');

Route::post('formdata','Blogcontroller@regisdata')->name('regisdata');

Route::post('reg-store','Blogcontroller@regstore')->name('regstore');

Route::get('dashboard','Blogcontroller@dashboard')->name('dashboard');

Route::get('logoutdata','Blogcontroller@logoutdata')->name('logoutdata');

Route::get('login','LoginController@login')->name('login');

Route::post('auth','LoginController@auth')->name('auth');

Route::get('dashboard','LoginController@dashboard')->name('dashboard');

Route::get('logout', 'LoginController@logout')->name('logout');

Route::get('add-package', 'PackageNewController@addPackage')->name('addPackage');


Route::post('package-store', 'PackageNewController@packageStore')->name('packageStore');
Route::get('package', 'PackageNewController@getPackage')->name('getPackage');
Route::get('add-category', 'CategoryNewController@addCategory')->name('addCategory');
Route::post('store-category', 'CategoryNewController@storecategory')->name('storecategory');
Route::get('get-category', 'CategoryNewController@getCategory')->name('getCategory');
Route::post('delete-category', 'CategoryNewController@deleteCategory')->name('deleteCategory');
Route::get('edit-category', 'CategoryNewController@editCategory')->name('editCategory');
Route::get('show-category', 'CategoryNewController@showCategory')->name('showCategory');

Route::post('delete-package', 'PackageNewController@deletePackage')->name('deletePackage');
Route::post('single-package', 'PackageNewController@addsinglePackage')->name('addsinglePackage');
Route::get('show-package', 'PackageNewController@showPackage')->name('showPackage');
Route::post('udpate-category', 'CategoryNewController@updatecategory')->name('updatecategory');

Route::post('update-package', 'PackageNewController@editpackagestore')->name('editpackagestore');
Route::get('addFormData', 'PackageNewController@addFormData')->name('addFormData');

Route::post('excelexportdata', 'PackageNewController@excelexportdata')->name('excelexportdata');
