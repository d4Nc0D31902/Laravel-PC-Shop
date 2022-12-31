<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

//middleware for cruds
Route::group(['middleware' => ['auth:sanctum',  'role:admin,employee']], function () {
    //customer
    Route::resource('customer', 'CustomerController');
    Route::view('/customer', 'customer.index');

    //employee
    Route::resource('employee', 'EmployeeController');
    Route::view('/employee', 'employee.index');

    //product
    Route::resource('product', 'ProductController');
    Route::view('/product', 'product.index');

    //pcspec
    Route::resource('pcspec', 'PcspecController');
    Route::get('/pcspec', ['uses' => 'PcspecController@index']);
    Route::view('/pcspec-all', 'pcspec.index');

    //consultation
    Route::resource('consultation', 'ConsultationController');
    Route::get('/consultation', ['uses' => 'ConsultationController@index']);
}); //end of cruds

//middleware for customer
Route::group(['middleware' => ['auth:sanctum', 'role:customer,employee,admin']], function () {
    Route::resource('customer', 'CustomerController')->only(['edit', 'update']);
    Route::view('/profile', 'profile.customer');
}); //end of customer

Route::get('signin', [
    'uses' => 'LoginController@index',
    'as' => 'user.signin',
]);


Route::resource('shop', 'ProductController');
Route::view('/shop', 'shop.index');


// Route::group(['prefix' => 'user'], function() {
//   Route::group(['middleware' => 'guest'], function() {
//     Route::get('signin', [
//         'uses' => 'LoginController@index',
//         'as' => 'user.signin',
//     ]);
//   });
// });

// Route::get('/profile', [
//     'uses' => 'UserController@profile',
//     'as' => 'profile.customer',
//   ]);

// Route::get('/profile', [
//     'uses' => 'UserController@getProfile',
//     'as' => 'getProfile.customer',
//   ]);

// Route::view('/profile', 'profile.customer');

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
