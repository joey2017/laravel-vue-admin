<?php
Route::post('/tokens', 'TokenController@store');
Route::get('/tokens', 'TokenController@index');
Route::post('/frontend-error','FrontendErrorController@store');


Route::middleware(['auth:admin'])->group(function () {
    Route::get('me', 'MeController@index');
    Route::post('me/password', 'MeController@password');
    Route::get('system/dashboard','SystemDashboardController@index')->name('backend.system-dashboard.index');

});
Route::middleware(['auth:admin','permission', 'admin-action-record'])->group(function (){
    Route::get('admins','AdminController@index')->name('backend.admins.index');
    Route::get('admin/{id}', 'AdminController@show')->name('backend.admin.show')->where('id', '[0-9]+');
    Route::get('admin/options', 'AdminController@options')->name('backend.admin.options');
    Route::post('admins','AdminController@store')->name('backend.admins.store');
    Route::put('admins/{id}','AdminController@update')->name('backend.admins.update');
    Route::delete('admins/{id}','AdminController@destroy')->name('backend.admins.destroy');
    Route::put('admin/{id}/password','AdminController@password')->name('backend.admin.password');

    Route::post('roles','RoleController@store')->name('backend.roles.store');
    Route::put('roles/{id}','RoleController@update')->name('backend.roles.update');
    Route::delete('roles/{id}','RoleController@destroy')->name('backend.roles.destroy');
    Route::get('roles','RoleController@index')->name('backend.roles.index');
    Route::get('roles/{id}','RoleController@show')->name('backend.roles.show')
        ->where('id','[0-9]+');
    Route::get('roles/options','RoleController@options')->name('backend.roles.options');

    Route::get('admin-action-logs','AdminActionLogController@index')->name('backend.admin-action-logs.index');

    Route::get('frontend-errors','FrontendErrorController@index')->name('backend.frontend-errors.index');
    Route::post('frontend-errors/flush','FrontendErrorController@flush')->name('backend.frontend-errors.flush');
});
