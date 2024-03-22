<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\MatchesController;
use App\Http\Controllers\KlasemenController;

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

Route::get('/', [ClubController::class, 'index']);
Route::post('/insert-club', [ClubController::class, 'store']);
Route::get('/delete-club/{id_club}', [ClubController::class, 'destroy']);

Route::get('/multiple-matches', [MatchesController::class, 'index']);
Route::post('/multiple-matches', [MatchesController::class, 'store']);

Route::get('/one-match', [MatchesController::class, 'getOneMatch']);
Route::post('/one-match', [MatchesController::class, 'storeOneMatch']);
Route::get('/matches', [MatchesController::class, 'getMatches']);

Route::get('/klasemen', [KlasemenController::class, 'index']);
