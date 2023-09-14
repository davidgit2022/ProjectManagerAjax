<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\City\CityController;
use App\Http\Controllers\Company\CompanyController;

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::controller(CityController::class)->group(function () {
    
    Route::get('/cities','index')->name('cities.index');

    Route::post('/cities','store')->name('cities.store');

    Route::get('/cities/edit/{id}',  'edit')->name('cities.edit');

    Route::post('/cities/update/{id}','update')->name('cities.update');

    Route::delete('/cities/delete/{id}','destroy')->name('cities.destroy');
});

Route::controller(CompanyController::class)->group(function(){
    Route::get('/companies', 'index')->name('companies.index');
    Route::post('/companies', 'store')->name('companies.store');
});
