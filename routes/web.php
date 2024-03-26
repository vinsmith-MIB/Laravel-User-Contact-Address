<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AddressController;





Route::group(['middleware' => 'guest'], function () {
    Route::get('/', function () {
        return view('login');
    });
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return redirect('/home');
    });

    Route::get('/user/edit', [AuthController::class, 'updateView'])->name('updateView');
    Route::put('/user/update', [AuthController::class, 'update'])->name('user.update');


    Route::post('/contact/create', [ContactController::class, 'createContact'])->name('create.contact');
    Route::get('/home', [ContactController::class, 'get'])
        ->name('get.contact');
    Route::get('/home/{id}/edit', [ContactController::class, 'editContact'])
        ->where('id', '[0-9]+') // Hanya menerima angka untuk ID
        ->name('edit.contact');
    Route::put('/home/{id}', [ContactController::class, 'updateContact'])->name('update.contact');
    Route::delete('/contact/{id_contact}', [ContactController::class, 'deleteContact'])->name('delete.contact');


    // Menampilkan halaman utama daftar alamat
    Route::get('/addresses/{idContact}', [AddressController::class, 'index'])->name('addresses.index');

    // Menampilkan form tambah alamat
    Route::get('/addresses/{idContact}/create', [AddressController::class, 'create'])->name('addresses.create');

    // Menyimpan alamat baru ke database
    Route::post('/addresses/{idContact}', [AddressController::class, 'store'])->name('addresses.store');

    // Menampilkan form edit alamat
    Route::get('/addresses/{idContact}/{idAddress}/edit', [AddressController::class, 'edit'])->name('addresses.edit');

    // Menyimpan perubahan alamat ke database
    Route::put('/addresses/{idContact}/{idAddress}', [AddressController::class, 'update'])->name('addresses.update');

    // Menghapus alamat dari database
    Route::delete('/addresses/{idContact}/{idAddress}', [AddressController::class, 'destroy'])->name('addresses.destroy');


    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});
