<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('dashboard', [
            'user' => Auth::user(),
            'referrals' => Auth::user()->referrals
        ]);
    })->name('dashboard');

    Route::get('/ganharPontos', [UserController::class, 'earnPoints'])->name('earnPoints');
});


Route::get('/cadastro', [UserController::class, 'create'])->name('register');
Route::post('/cadastro', [UserController::class, 'store'])->name('register.post');
Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::post('/login', [UserController::class, 'doLogin'])->name('login.post');
