<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\City\CityController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Project\ProjectController;

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

    Route::get('/companies/edit/{id}', 'edit')->name('companies.edit');

    Route::post('/companies/update/{id}', 'update')->name('companies.update');

    Route::delete('/companies/delete/{id}', 'destroy')->name('companies.delete');
});


Route::controller(ProjectController::class)->group(function(){
    
    Route::get('/projects', 'index')->name('projects.index');
    
    Route::post('/projects', 'store')->name('projects.store');

    Route::get('/projects/edit/{id}', 'edit')->name('projects.edit');

    Route::post('/projects/update/{id}', 'update')->name('projects.update');

    Route::delete('/projects/delete/{id}', 'destroy')->name('projects.delete');
});
