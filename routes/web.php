<?php

use App\Http\Controllers\
{ 
    ProfileController,
    WalletController,
    VoteController
};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/w', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/vote', [VoteController::class, 'submitVoteBackend'])->name('vote.submit');

Route::post('/vote_success', function () {
    return view('sucesso_voto');
})->name('vote_success');


Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/wallet', [WalletController::class, 'index'])->name('wallet');
    Route::post('/wallet/store', [WalletController::class, 'store'])->name('wallet.store');
    Route::post('/wallet/transfer', [WalletController::class, 'transfer'])->name('wallet.transfer');

    Route::post('/wallet/refresh', [WalletController::class, 'refreshTransactions'])->name('wallet.refresh');
    
    

});

require __DIR__.'/auth.php';
