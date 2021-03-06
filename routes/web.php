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

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::get('/', 'HomeController@index')->name('home');

//////Côté admin//////

Route::get('test', function() {
 $pdf = PDF::loadView('pdf.test');
 return $pdf->download();
});

Route::group(['prefix' => 'admin', 'middleware' => 'isAdmin'], function() {

    Route::get('AllLocal', 'LocalController@index');

    //home
    Route::get('/', 'HomeController@admin')->name('admin_home');

    //Users
    Route::get('users', 'UserController@getUsers')->name('admin_users');
    Route::get('user/create', 'UserController@create')->name('admin_user_create');
    Route::post('user/store', 'UserController@store')->name('admin_user_store');
    Route::get('user/{user}', 'UserController@getOneUser')->name('admin_user');
    Route::post('user/{user}/update', 'UserController@AdminUpdateUser')->name('admin_user_update');
    Route::get('user/{user}/delete', 'UserController@destroyUser')->name('admin_user_delete');

    //Levels
    Route::get('levels', 'LevelController@getAllLevels')->name('admin_levels');

    //Level_rates
    Route::get('level_rates', 'LevelRateController@adminAllLevelRates')->name('admin_level_rates');
    Route::get('level_rate/{level_rate}', 'LevelRateController@adminLevelRateUpdate')->name('admin_level_rate_update');
    Route::post('level_rate/{level_rate}/update', 'LevelRateController@adminLevelRateStore')->name('admin_level_rate_store');

    //Modules
    Route::get('modules', 'ModuleController@getAllModules')->name('admin_modules');
    Route::get('module/create', 'ModuleController@create')->name('admin_module_create');
    Route::post('module/store', 'ModuleController@store')->name('admin_module_store');
    Route::get('module/{module}', 'ModuleController@getOneModule')->name('admin_module');
    Route::post('module/{module}/update', 'ModuleController@updateModule')->name('admin_module_update');
    Route::get('module/{module}/delete', 'ModuleController@destroyModule')->name('admin_module_destroy');

    //Locals
    Route::get('locals', 'LocalController@adminAllLocals')->name('admin_locals');
    Route::get('local/create', 'LocalController@create')->name('admin_local_create');
    Route::post('local/store', 'LocalController@store')->name('admin_local_store');
    Route::get('local/{local}', 'LocalController@adminOneLocal')->name('admin_local');
    Route::post('local/{local}/update', 'LocalController@edit')->name('admin_local_update');
    Route::get('local/{local}/delete', 'LocalController@destroy')->name('admin_local_delete');

    //Local_types
    Route::get('local_types', 'LocalTypeController@adminAllLocalTypes')->name('admin_local_types');
    Route::get('local_type/create', 'LocalTypeController@adminLocalTypeCreate')->name('admin_local_type_create');
    Route::post('local_type/store', 'LocalTypeController@adminLocalTypeStore')->name('admin_local_type_store');
    Route::get('local_type/{local_type}', 'LocalTypeController@adminLocalType')->name('admin_local_type');
    Route::post('local_type/{local_type}/update', 'LocalTypeController@adminLocalTypeUpdate')->name('admin_local_type_update');
    //Route::get('local_types/{local_type}/delete', 'LocalTypeController@adminLocalTypeDestroy')->name('admin_local_types_destroy');


    //Cities
    Route::get('cities', 'CityController@getAllCities')->name('admin_cities');
    Route::get('city/create', 'CityController@create')->name('admin_city_create');
    Route::post('city/store', 'CityController@store')->name('admin_city_store');
    Route::get('city/{city}', 'CityController@getOneCity')->name('admin_city');
    Route::post('city/{city}/update', 'CityController@updateCity')->name('admin_city_update');
    Route::get('city/{city}/delete', 'CityController@destroyCity')->name('admin_city_destroy');

    // Reductions
    Route::get('reductions', 'ReductionController@index')->name('admin_reduction_index');
    Route::get('reduction/{reduction}', 'ReductionController@oneReduction')->name('admin_reduction');
    Route::post('reduction/{reduction}/update', 'ReductionController@updateReduction')->name('admin_reduction_update');

    //Historique

    Route::group(['prefix' => 'rate'], function() {
        //level
        Route::get('levels', 'LevelController@index')->name('admin_rate_levels');
        Route::get('level/{level}', 'LevelController@getOneLevel')->name('admin_rate_level');

  });

    //Adminer
    Route::any('adminer', '\Miroc\LaravelAdminer\AdminerAutologinController@index');
});

////// Côté Utilisateur //////
//Users
Route::get('user', 'UserController@getUser')->name('user')->middleware('auth');
Route::post('update', 'UserController@updateUser')->name('update');

//Modules
Route::get('modules', 'ModuleController@getAllModules')->name('modules');
Route::get('module/{id}', 'ModuleController@getOneModule')->name('module');

//Locals
Route::get('locations', 'LocalController@getAllLocals')->name('locals');
Route::get('local/{local}', 'LocalController@getOneLocal')->name('local');
Route::post('local/{local}/louer', 'LocalController@louer')->name('louer');

Route::get('pdf/download', 'PdfController@download')->name('pdf_download');

//Contact

//Louer

// Route::get('test', function() {
//   $pdf = PDF::loadView('pdf.order');
//   return $pdf->download();
// });

Route::get('pdf', 'LocalController@pdf')->name('pdf');
