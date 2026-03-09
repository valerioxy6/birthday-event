<?php

use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GuestController::class, 'create'])->name('guests.create');
Route::post('/register', [GuestController::class, 'store'])->name('guests.store');

Route::get('/ticket/{token}', [GuestController::class, 'ticket'])->name('guests.ticket');
Route::get('/ticket/{token}/pdf', [GuestController::class, 'downloadPdf'])->name('guests.ticket.pdf');

Route::get('/checkin/{token}', [GuestController::class, 'checkin'])->name('guests.checkin');