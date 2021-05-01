<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuggestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

// DASHBOARD
Route::get('', [HomeController::class, 'index'])->name('home');

Route::post('sugestao/{id}/like', [SuggestController::class, 'like'])->name('admin.sugestao.like');
Route::get('sugestao/nova', [HomeController::class, 'novaSugestao'])->name('sugestao.nova');
Route::post('sugestao/store', [SuggestController::class, 'store'])->name('sugestao.store');
Route::get('usuario/{id}', [HomeController::class, 'showUser'])->name('home.usuario');
Route::get('sugestao/{slug}', [HomeController::class, 'showSuggest'])->name('sugestao.show');
Route::get('categoria/{category}', [HomeController::class, 'showCategory'])->name('home.categoria.show');
Route::get('categoria', [HomeController::class, 'showCategories'])->name('home.categoria');
Route::get('search', [HomeController::class, 'search'])->name('search');

Auth::routes();

Route::group(
    ['middleware' => ['auth'],
     'prefix'   => 'admin',
     'name'     => 'admin'] , function (){

    // DASHBOARD
    Route::get('', [HomeController::class, 'indexAdmin'])->name('admin');

    // PESQUISA
    Route::post('pesquisa', [SuggestController::class, 'index'])->name('admin.pesquisa');

    // SUGESTOES
    Route::get('sugestao',                  [SuggestController::class, 'index'])->name('admin.sugestao');
    Route::get('sugestao/pagination',       [SuggestController::class, 'suggestPagination']);
    Route::get('sugestao/{id}',             [SuggestController::class, 'show'])->name('admin.sugestao.show');
    Route::get('sugestao/{id}/mark-read',   [SuggestController::class, 'suggestMarkread']);

    // CATEGORIA
    Route::get('categoria',         [CategoryController::class, 'index'])->name('admin.categoria.index');
    Route::get('categoria/{id}',    [CategoryController::class, 'show'])->name('admin.categoria.show');

    // USUARIOS
    Route::get('usuario',       [UserController::class, 'index'])->name('admin.usuario');
    Route::get('usuario/{id}',  [UserController::class, 'show'])->name('admin.usuario.show');

    // CONFIGURACOES
    Route::get('configuracao', function() {
        return view('home');
    })->name('admin.configuracao');

});


