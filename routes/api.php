<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Customer
Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::resource('customer', 'CustomerController');
  Route::view('/customer-index', 'customer.index');
  Route::post('/customer/update/{id}',['uses' => 'CustomerController@update','as' => 'customer.update']);
  Route::get('/customer/restore/{id}',[
    'uses' => 'CustomerController@restore',
    'as' => 'customer.restore'
  ]);

  //Employee
  Route::resource('employee', 'EmployeeController');
  Route::view('/employee-index', 'employee.index');
  Route::post('/employee/update/{id}',['uses' => 'EmployeeController@update','as' => 'employee.update']);

  Route::get('/employee/role/{id}/edit',['uses' => 'EmployeeController@editRole','as' => 'employee.editRole']);
  Route::post('/employee/update/role/{id}',['uses' => 'EmployeeController@updateRole','as' => 'employee.updateRole']);

  Route::get('/employee/restore/{id}',[
    'uses' => 'EmployeeController@restore',
    'as' => 'employee.restore'
  ]);

  // Product
  Route::resource('product', 'ProductController');
  Route::post('/product/update/{id}',['uses' => 'ProductController@update','as' => 'product.update']);
  Route::view('/product-index', 'product.index');

  // Pcspecs
  // Route::get('/pcspec-index', ['uses' => 'PcspecController@getPcspecAll', 'as' => 'pcspec.getPcspecAll']);
  Route::resource('pcspec', 'PcspecController');
  Route::view('/pcspec-index', 'pcspec.index');
  Route::post('/pcspec/update/{id}',['uses' => 'PcspecController@update','as' => 'pcspec.update']);

  Route::resource('consultation', 'ConsultationController');
  Route::view('/consultation-index', 'consultation.index');
});

// // middleware for customer
// Route::group(['middleware' => ['auth:sanctum', 'role:customer,admin,employee']], function () {
//   Route::resource('customer', 'CustomerController')->only(['edit','update']);
//   Route::post('/customer/update/{id}',['uses' => 'CustomerController@update','as' => 'customer.update']);
// });

Route::group(['middleware' => 'guest'], function() {
  Route::resource('customer', 'CustomerController')->only(['store']);
  Route::resource('employee', 'EmployeeController')->only(['store']);
});

Route::group(['middleware' => ['auth:sanctum', 'role:customer,employee,admin']], function () {
  Route::resource('pcspec', 'PcspecController')->only(['store']);
});

Route::get('signin', [
  'uses' => 'LoginController@index',
  'as' => 'user.signin',
]);

Route::post('signin', [
    'uses' => 'LoginController@postSignin',
    'as' => 'user.signin',
]);

Route::get('logout',[
  'uses' => 'LoginController@logout',
  'as' => 'login.logout',
]);

// Route::get('/profile', [
//   'uses' => 'UserController@profile',
//   'as' => 'profile.customer',
// ]);
Route::view('/pcspec-all', 'pcspec.index');
Route::get('/getAll', [
  'uses' => 'PcspecController@getAll',
  'as' => 'getAll.index',
]);

Route::get('/profile/index', [
  'uses' => 'UserController@getProfile',
  'as' => 'getProfile.customer',
]);

Route::view('/profile', 'profile.customer');

// Route::resource('user', 'UserController');
// Route::view('/profile', 'profile.customer');
Auth::routes(['verify' => true]);