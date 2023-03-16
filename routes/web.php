<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\TitleController;

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

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('employees/search', [EmployeeController::class, 'search'])->name('employees.search');
    Route::resource('employees', EmployeeController::class);

    Route::get('salaries/{salary}', [SalaryController::class, 'destroy'])->name('salaries.destroy');
    
    Route::get('titles/{title}', [TitleController::class, 'destroy'])->name('titles.destroy');
});