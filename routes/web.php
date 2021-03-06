<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TaskController;
use App\Models\Task;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group([
    'middleware'=>['auth','isAdmin'],
    'prefix'=>'admin'
],function(){
    Route::get('tasks/{id}',[TaskController::class,'destroy'])->whereNumber('id')->name('tasks.destroy');
   Route::resource('tasks', TaskController::class);
});
