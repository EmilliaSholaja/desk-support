<?php

use App\Http\Controllers\AdminTicketController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketReplyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

//Register Route
Route::view('/register', 'auth.register')->name('register');
Route::post('/register', [AuthController::class, 'register']);

//Login Route
Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AuthController::class, 'login']);
 
//Auth group
Route::middleware('auth')->group(function(){
    //Logout Route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //Ticket Routes
    Route::resource('tickets', TicketController::class);

    //Ticket Reply Route
    Route::post('/tickets/{ticket}/replies', [TicketReplyController::class, 'store'])->name('tickets.replies.store');
});

Route::prefix('admin')
    ->as('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        Route::get('/tickets', [AdminTicketController::class, 'index'])->name('tickets.index');

        Route::get('/tickets/{ticket}', [AdminTicketController::class, 'show'])->name('tickets.show');

        Route::post('/tickets/{ticket}/close', [AdminTicketController::class, 'close'])->name('tickets.close');
        Route::patch('/tickets/{ticket}/status', [AdminTicketController::class, 'updateStatus'])
            ->name('tickets.updateStatus');

        Route::patch('/tickets/{ticket}/priority', [AdminTicketController::class, 'updatePriority'])
            ->name('tickets.updatePriority');

        Route::post('/tickets/{ticket}/reply', [AdminTicketController::class, 'reply'])
            ->name('tickets.reply');


});