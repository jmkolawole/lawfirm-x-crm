<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



use App\Http\Controllers\ClientController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware'=>['CORS'], 'prefix' => 'clients'], function() {
    Route::post('/add', [ClientController::class, 'add'])->name('add.client');
    Route::get('/view-all', [ClientController::class, 'getClients'])->name('all.clients');
    //Route::put('/update/{id}', [ClientController::class, 'editSingleClient'])->name('edit.client');
    //Route::delete('/delete/{id}', [ClientController::class, 'deleteClient'])->name('delete.client');
    Route::get('/view/{id}', [ClientController::class, 'getSingleClient'])->name('single.client');
    //Route::get('/search/{search}', [ClientController::class, 'searchClient'])->name('search.client'); 
});