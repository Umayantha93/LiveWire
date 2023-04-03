<?php

use Illuminate\Support\Facades\Route;
use App\Models\Comment;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', \App\Http\Livewire\Home::class);
Route::get('/login', \App\Http\Livewire\Login::class);
