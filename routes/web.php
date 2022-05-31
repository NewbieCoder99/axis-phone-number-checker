<?php

Route::get('test','TestController@index')->name('test');

Route::get('/', function () {
    return redirect('login');
});

Route::group([
    'middleware' => ['auth'],
    'namespace' => 'App\Http\Controllers\Dashboard',
    'prefix' => 'dashboard'
], function() {

    Route::get('/','IndexController@index')->name('dashboard');

    Route::get('phone-numbers/export','PhoneNumberController@export')->name('export-phone-number');
    Route::resource('phone-numbers','PhoneNumberController');

    Route::get('continue','ContinueController@index')->name('continue');
    Route::post('upload','UploadController@index')->name('upload-file');
    Route::post('checking-phone-number','CheckingPhoneNumberController@index')->name('checking-phone-number');

});

require __DIR__.'/auth.php';
