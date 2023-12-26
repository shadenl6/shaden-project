<?php 

use App\Http\Controllers;

Route::get('/', [HomeController::class, 'HomeController'])->name('home');
