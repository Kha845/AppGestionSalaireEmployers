<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\EmployersController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\PaymentController;

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

Route::get('/', [AuthController::class,'login'])->name('login');

Route::post('/', [AuthController::class,'handleLogin'])->name('handleLogin');


Route::middleware('auth')->group(function () {


});
Route::get('dashboard', [AppController::class,'index'])->name('dashboard');

Route::prefix('employers')->group(function () {

    Route::get('/', [EmployersController::class,'index'])->name('employers.index');

    Route::get('/create', [EmployersController::class,'create'])->name('employers.create');

    Route::post('/store', [EmployersController::class,'store'])->name('employers.store');

    Route::get('/edit/{employers}', [EmployersController::class,'edit'])->name('employers.edit');

    Route::put('/update/{employers}', [EmployersController::class,'update'])->name('employers.update');

    Route::get('{employers}', [EmployersController::class,'delete'])->name('employers.delete');

});

Route::prefix('departements')->group(function () {

    Route::get('/', [DepartementController::class,'index'])->name('departement.index');

    Route::get('/create', [DepartementController::class,'create'])->name('departement.create');

    Route::post('/store', [DepartementController::class,'store'])->name('departement.store');

    Route::get('/edit/{departement}', [DepartementController::class,'edit'])->name('departement.edit');

    Route::put('/update/{departement}', [DepartementController::class,'update'])->name('departement.update');

    Route::get('/{departement}', [DepartementController::class,'delete'])->name('departement.delete');


});

Route::prefix('configuration')->group(function(){

    Route::get('/',[ConfigurationController::class,'index'])->name('configuration.index');

    Route::get('/create',[ConfigurationController::class,'create'])->name('configurations.create');

    Route::post('/store',[ConfigurationController::class,'store'])->name('configurations.store');

    Route::get('/delete/{configurations}',[ConfigurationController::class,'delete'])->name('configurations.delete');
});

Route::prefix('admin')->group(function(){

    Route::get('/',[AdminController::class,'index'])->name('admin.index');

    Route::get('/create',[AdminController::class,'create'])->name('admin.create');

    Route::post('/store',[AdminController::class,'store'])->name('admin.store');

    Route::get('/edit/{user}',[AdminController::class,'edit'])->name('admin.edit');

    Route::put('/update/{user}',[AdminController::class,'update'])->name('admin.update');

    Route::get('/{user}',[AdminController::class,'delete'])->name('admin.delete');
});

Route::get('/validate-account/{email}',[AdminController::class,'defineAccess'])->name('admin.submitDefineAccess');

Route::post('/validate-account/{email}',[AdminController::class,'submitDefineAccess'])->name('admin.submitDefineAcces');

Route::prefix('payment')->group(function(){

    Route::get('/', [PaymentController::class,'index'])->name('payment.index');

    Route::get('/make', [PaymentController::class,'initPayment'])->name('payment.initPayment');

    Route::post('/store', [PaymentController::class,'store'])->name('payment.store');

    Route::get('/download-invoice/{payment}', [PaymentController::class,'downloadInvoice'])->name('payment.download');
});
