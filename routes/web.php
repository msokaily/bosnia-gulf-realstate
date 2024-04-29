<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

Route::get('/admin', function () {
    return redirect('/admin/login');
});

// ADMIN AUTH
Route::group(['middleware' => ['guest'], 'prefix' => 'admin'], function () {
    Route::get('/', function () {
        return redirect('admin/login');
    });
    Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('admin.login.form');
    Route::post('/login', 'AdminAuth\LoginController@login')->name('admin.login');

    // Password Reset Routes...
    Route::get('password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm')->name('password.reset.token');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::get('/logout', 'AdminAuth\LoginController@logout')->name('admin.logout');
});

// USER AUTH
Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login.form');
    Route::post('/login', 'Auth\LoginController@login')->name('login');

    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset.token');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
});

Route::get('/logout', 'AdminAuth\LoginController@logout')->name('admin.logout');
Route::get('/logout-user', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => ['ControlPanel'], 'prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('/admin', function () {
        return redirect('admin/home');
    });

    Route::resource('reports', 'Admin\ReportsController');

    Route::get('/admins/{id}/edit_password', 'Admin\AdminController@edit_password')->name('admins.edit_password');
    // Route::post('/admins/{id}/edit_password', 'Admin\AdminController@update_password')->name('admins.edit_password');

    Route::group(['middleware' => ['admin']], function () {
        Route::get('/admin', function () {
            return redirect('/admin/home');
        });
        Route::post('upload_media', 'Admin\MediaController@upload_media')->name('upload_media');
        Route::get('home', 'Admin\ReportsController@index')->name('home');
        // Route::post('ckeditor/upload', 'Admin\HomeController@upload')->name('ckeditor_upload');

        ////// Users
        Route::resource('/users', 'Admin\UsersController');
        
        // Locations
        Route::resource('locations', 'Admin\LocationsController');
        
        // Clients
        Route::post('/clients_import', 'Admin\ClientsController@clients_import')->name('clients_import');
        Route::resource('clients', 'Admin\ClientsController');
        
        // Realstate Products
        Route::get('realstate-products/print/{id}', 'Admin\RealstateProductsController@paymentsPrint')->name('realstate-products.payments-print');
        Route::resource('realstate-products', 'Admin\RealstateProductsController');
        
        // Realstates
        Route::resource('realstates', 'Admin\RealstatesController');

        // Products
        Route::resource('products', 'Admin\ProductsController');
        Route::post('products/sort', 'Admin\ProductsController@sort')->name('products.sort');

        ///// Reports
        // Route::get('test_import', 'Admin\ReportsController@test_import');

        // Admin Management
        Route::post('/admins/changeStatus', 'Admin\AdminController@changeStatus')->name('admin_changeStatus');
        Route::resource('/admins', 'Admin\AdminController');

        ///// Settings
        Route::resource('/settings', 'Admin\SettingsController');
        Route::get('/settings/{id}/edit', 'Admin\SettingsController@edit')->name('settings.edit');
        // Route::post('/settings/{id}', 'Admin\SettingsController@update')->name('settings.update');

        ///// Notifications
        Route::resource('/send_notify', 'Admin\NotificationsController');
        Route::post('/send_notify', 'Admin\NotificationsController@sendnotif');

        ///// Inbox
        Route::get('/inbox', 'Admin\ContactController@index')->name('inbox');
        Route::get('/viewMessage/{id}', 'Admin\ContactController@viewMessage');
        Route::get('/inbox/{id}', 'Admin\ContactController@destroy');
        Route::post('/send_reply', 'Admin\ContactController@send_reply')->name('send_reply');
    });
});

