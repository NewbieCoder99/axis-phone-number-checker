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
    return redirect('login');
});

Route::group([
    'middleware' => ['auth'],
    'namespace' => 'App\Http\Controllers\Dashboard',
    'prefix' => 'dashboard'
], function() {

    Route::get('/','IndexController@index')->name('dashboard');

    Route::get('test','TestController@index')->name('test');
    Route::get('continue','ContinueController@index')->name('continue');
    Route::post('upload','UploadController@index')->name('upload-file');
    Route::post('checking-phone-number','CheckingPhoneNumberController@index')->name('checking-phone-number');

});

require __DIR__.'/auth.php';
