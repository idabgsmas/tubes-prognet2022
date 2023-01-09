<?php

use App\Http\Controllers\CrudController;
use App\Http\Controllers\Crud2Controller;
use App\Http\Controllers\Crud3Controller;
use App\Http\Controllers\Crud4Controller;
use App\Http\Controllers\Crud5Controller;
use App\Http\Controllers\Crud6Controller;
use App\Http\Controllers\Trx2Controller;
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

// Routes 1 untuk M_IKS
Route::get('/crud',[CrudController::class,'index'])->name('crud.list');

Route::get('/crud/{id}/show1',[CrudController::class,'indexShow'])->name('crud.show');
Route::post('/crud/showList1',[CrudController:: class,'showList'])->name('crud.showList');
Route::delete('/crud/{id}',[CrudController::class,'deleteDataDetail'])->name('show.delete');

Route::get('/crud/create',[CrudController::class,'create'])->name('crud.create');
Route::post('/crud/store',[CrudController::class,'store'])->name('crud.store');


Route::get('/crud/{id}/edit',[CrudController::class,'edit'])->name('crud.edit');
Route::post('crud/update/{id}',[CrudController::class,'update'])->name('crud.update');

Route::delete('/crud/{id}',[CrudController::class,'deleteData'])->name('crud.delete');
Route::post('/crud/listData',[CrudController::class,'listData'])->name('crud.listData');


// Routes 2 untuk M_IKS_TIPE
Route::get('/crud2',[Crud2Controller::class,'index'])->name('crud2.list');

Route::get('/crud2/create2',[Crud2Controller::class,'create'])->name('crud2.create');
Route::post('/crud2/store2',[Crud2Controller::class,'store'])->name('crud2.store');

Route::get('/crud2/{id}/edit2',[Crud2Controller::class,'edit'])->name('crud2.edit');
Route::post('crud2/update2/{id}',[Crud2Controller::class,'update'])->name('crud2.update');

Route::delete('/crud2/{id}',[Crud2Controller::class,'deleteData'])->name('crud2.delete');
Route::post('/crud2/listData2',[Crud2Controller::class,'listData'])->name('crud2.listData');


// Routes 3 untuk M_PENJAMIN
Route::get('/crud3',[Crud3Controller::class,'index'])->name('crud3.list');

Route::get('/crud3/create3',[Crud3Controller::class,'create'])->name('crud3.create');
Route::post('/crud3/store3',[Crud3Controller::class,'store'])->name('crud3.store');

Route::get('/crud3/{id}/edit3',[Crud3Controller::class,'edit'])->name('crud3.edit');
Route::post('crud3/update3/{id}',[Crud3Controller::class,'update'])->name('crud3.update');

Route::delete('/crud3/{id}',[Crud3Controller::class,'deleteData'])->name('crud3.delete');
Route::post('/crud3/listData3',[Crud3Controller::class,'listData'])->name('crud3.listData');


// Routes 4 untuk M_IKS_GKOMPONEN
Route::get('/crud4',[Crud4Controller::class,'index'])->name('crud4.list');

//-- ROUTES DETAIL IKS GROUP KOMPONEN:: M_IKS_GKOMPONEN_DETAIL 
Route::get('/crud4/{id}/show4',[Crud4Controller::class,'indexShow'])->name('crud4.show');
Route::post('/crud4/showList4',[Crud4Controller:: class,'showList'])->name('crud4.showList');
Route::get('/crud4/create5',[Crud5Controller::class,'create'])->name('crud4.create2');
Route::get('/crud4/{id}/edit5',[Crud5Controller::class,'edit'])->name('crud5.edit');
//-- END ROUTES DETAIL IKS GROUP KOMPONEN:: M_IKS_GKOMPONEN_DETAIL 

Route::get('/crud4/create4',[Crud4Controller::class,'create'])->name('crud4.create');
Route::post('/crud4/store4',[Crud4Controller::class,'store'])->name('crud4.store');

Route::get('/crud4/{id}/edit4',[Crud4Controller::class,'edit'])->name('crud4.edit');
Route::post('crud4/update4/{id}',[Crud4Controller::class,'update'])->name('crud4.update');

Route::delete('/crud4/{id}',[Crud4Controller::class,'deleteData'])->name('crud4.delete');
Route::post('/crud4/listData4',[Crud4Controller::class,'listData'])->name('crud4.listData');


// Routes 5 untuk M_IKS_GKOMPONEN_DETAIL
Route::get('/crud5',[Crud5Controller::class,'index'])->name('crud5.list');

Route::get('/crud5/create5',[Crud5Controller::class,'create'])->name('crud5.create');
Route::post('/crud5/store5',[Crud5Controller::class,'store'])->name('crud5.store');

Route::get('/crud5/{id}/edit5',[Crud5Controller::class,'edit'])->name('crud5.edit');
Route::post('crud5/update5/{id}',[Crud5Controller::class,'update'])->name('crud5.update');

Route::delete('/crud5/{id}',[Crud5Controller::class,'deleteData'])->name('crud5.delete');
Route::post('/crud5/listData5',[Crud5Controller::class,'listData'])->name('crud5.listData');

// Routes 6 untuk M_PROVIDER
Route::get('/crud6',[Crud6Controller::class,'index'])->name('crud6.list');

Route::get('/crud6/create6',[Crud6Controller::class,'create'])->name('crud6.create');
Route::post('/crud6/store6',[Crud6Controller::class,'store'])->name('crud6.store');

Route::get('/crud6/{id}/edit6',[Crud6Controller::class,'edit'])->name('crud6.edit');
Route::post('crud6/update6/{id}',[Crud6Controller::class,'update'])->name('crud6.update');

Route::delete('/crud6/{id}',[Crud6Controller::class,'deleteData'])->name('crud6.delete');
Route::post('/crud6/listData6',[Crud6Controller::class,'listData'])->name('crud6.listData');

// Routes untuk T_KOMPONEN_IKS
Route::get('/trx2',[Trx2Controller::class,'index'])->name('trx2.list');

Route::get('/trx2/{id}/show7',[Trx2Controller::class,'indexShow'])->name('trx2.show');
Route::post('/trx2/showList7',[Trx2Controller:: class,'showList'])->name('trx2.showList');
Route::get('/trx2/detail-iks/{id}',[Trx2Controller::class, 'getDetailIKS']);

Route::get('/trx2/create7',[Trx2Controller::class,'create'])->name('trx2.create');
// Route::get('/trx2/{id}/create8',[Trx2Controller::class,'create8'])->name('trx2.create8');
Route::post('/trx2/store7',[Trx2Controller::class,'store'])->name('trx2.store');

Route::get('/trx2/{id}/edit7',[Trx2Controller::class,'edit'])->name('trx2.edit');
Route::post('trx2/update7/{id}',[Trx2Controller::class,'update'])->name('trx2.update');

Route::delete('/trx2/{id}',[Trx2Controller::class,'deleteData'])->name('trx2.delete');
Route::post('/trx2/listData7',[Trx2Controller:: class,'listData'])->name('trx2.listData');

