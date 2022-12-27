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

Route::group(['middleware' => ['auth:sanctum',  'role:admin,employee']], function () {
    Route::resource('customer', 'CustomerController');
    Route::view('/customer', 'customer.index');

    Route::resource('employee', 'EmployeeController');
    Route::view('/employee', 'employee.index');

    Route::resource('product', 'ProductController');
    Route::view('/product', 'product.index');

    Route::resource('pcspec', 'PcspecController');
    Route::get('/pcspec', ['uses' => 'PcspecController@index']);

    Route::resource('consultation', 'ConsultationController');
    Route::get('/consultation', ['uses' => 'ConsultationController@index']);
});

Route::view('/pcspec-all', 'pcspec.index');

Route::group(['middleware' => ['auth:sanctum', 'role:customer']], function () {
    Route::resource('customer', 'CustomerController')->only(['edit', 'update']);
});

// Route::group(['middleware' => 'guest'], function() {
//     Route::resource('customer', 'CustomerController');
//     Route::resource('employee', 'EmployeeController');
// });

// Route::group(['prefix' => 'user'], function() {
//   Route::group(['middleware' => 'guest'], function() {
//     Route::get('signin', [
//         'uses' => 'LoginController@index',
//         'as' => 'user.signin',
//     ]);
//   });
// });

Route::view('/profile', 'profile.customer');

// Route::get('/profile', [
//     'uses' => 'UserController@profile',
//     'as' => 'profile.customer',
//   ]);

// Route::get('/profile', [
//     'uses' => 'UserController@getProfile',
//     'as' => 'getProfile.customer',
//   ]);

// Route::view('/profile', 'profile.customer');

Route::get('signin', [
          'uses' => 'LoginController@index',
          'as' => 'user.signin',
      ]);
Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
