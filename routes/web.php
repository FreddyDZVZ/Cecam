<?php

use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');
Route::livewire('/login', Login::class)->name('login');