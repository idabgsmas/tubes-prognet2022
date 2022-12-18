<?php

use App\Http\Controllers\CrudController;
use App\Http\Controllers\Crud2Controller;
use App\Http\Controllers\Crud3Controller;
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
Route::get('/',function(){
    return redirect('/crud');
});

// Routes untuk M_IKS
Route::get('/crud',[CrudController::class,'index'])->name('crud.list');

Route::get('/crud/create',[CrudController::class,'create'])->name('crud.create');
Route::post('/crud/store',[CrudController::class,'store'])->name('crud.store');

Route::get('/crud/{id}/edit',[CrudController::class,'edit'])->name('crud.edit');
Route::post('crud/update/{id}',[CrudController::class,'update'])->name('crud.update');

Route::delete('/crud/{id}',[CrudController::class,'deleteData'])->name('crud.delete');
Route::post('/crud/listData',[CrudController::class,'listData'])->name('crud.listData');


// Routes untuk M_IKS_TIPE
Route::get('/crud2',[Crud2Controller::class,'index'])->name('crud2.list');

Route::get('/crud2/create2',[Crud2Controller::class,'create'])->name('crud2.create');
Route::post('/crud2/store2',[Crud2Controller::class,'store'])->name('crud2.store');

Route::get('/crud2/{id}/edit2',[Crud2Controller::class,'edit'])->name('crud2.edit');
Route::post('crud2/update2/{id}',[Crud2Controller::class,'update'])->name('crud2.update');

Route::delete('/crud2/{id}',[Crud2Controller::class,'deleteData'])->name('crud2.delete');
Route::post('/crud2/listData2',[Crud2Controller::class,'listData'])->name('crud2.listData');


// Routes untuk M_PENJAMIN
Route::get('/crud3',[Crud3Controller::class,'index'])->name('crud3.list');

Route::get('/crud3/create3',[Crud3Controller::class,'create'])->name('crud3.create');
Route::post('/crud3/store3',[Crud3Controller::class,'store'])->name('crud3.store');

Route::get('/crud3/{id}/edit3',[Crud3Controller::class,'edit'])->name('crud3.edit');
Route::post('crud3/update3/{id}',[Crud3Controller::class,'update'])->name('crud3.update');

Route::delete('/crud3/{id}',[Crud3Controller::class,'deleteData'])->name('crud3.delete');
Route::post('/crud3/listData3',[Crud3Controller::class,'listData'])->name('crud3.listData');
