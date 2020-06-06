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

Route::get('/', 'Web\HomeController@homePage')->name('homePage');

Auth::routes(['register' => false]);

// Route::get('/home', 'HomeController@index')->name('home');
Route::post('/queueSearch', 'Web\HomeController@searchQueue')->name('searchQueue');

Route::middleware('auth')->group( function () {
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::get('/clinic/{clinic_no}', 'Web\ClinicController@clinic')->name('clinic');
    Route::get('/addQueue', 'Web\QueueController@addQueue')->name('addQueue');
    Route::post('/addQueue', 'Web\QueueController@storeQueue')->name('storeQueue');
    Route::get('/nextPatient/{clinic_id}', 'Web\QueueController@nextPatient')->name('nextPatient');
    Route::get('/nextSpecificPatient/{queue_id}/{clinic_id}', 'Web\QueueController@nextSpecificPatient')->name('nextSpecificPatient');
    Route::get('/completePatient/{queue_id}/{clinic_id}', 'Web\QueueController@completePatient')->name('completePatient');
    Route::post('/transferPatient/{queue_id}', 'Web\QueueController@transferPatient')->name('transferPatient');
    

    Route::get('/clinicManagement', 'Web\ClinicController@clinicManagement')->name('clinicManagement');
    Route::get('/clinicManagement/addClinic', 'Web\ClinicController@addClinic')->name('addClinic');
    Route::post('/clinicManagement/addClinic', 'Web\ClinicController@storeClinic')->name('storeClinic');
    Route::get('/clinicManagement/editClinic/{id}', 'Web\ClinicController@editClinic')->name('editClinic');
    Route::post('/clinicManagement/editClinic/{id}', 'Web\ClinicController@updateClinic')->name('updateClinic');
    Route::delete('/clinicManagement/deleteClinic/{id}', 'Web\ClinicController@deleteClinic')->name('deleteClinic');
    
});