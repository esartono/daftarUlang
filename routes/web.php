<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

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

// Route::get('/', function () {
//     return view('welcome');
// });

if (User::exists())
{
    Auth::routes([
        'register' => false
    ]);
}
else
{
    Auth::routes();
}

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/upload', [App\Http\Controllers\HomeController::class, 'upload'])->name('upload');
Route::get('/generatePDF', [App\Http\Controllers\UploadController::class, 'generatePDF'])->name('generatePDF');
Route::get('/kode/{kode}', [App\Http\Controllers\HomeController::class, 'qrcode'])->name('kode');
Route::get('/cetak/{jenis}/{nis}', [App\Http\Controllers\HomeController::class, 'cetak'])->name('cetak');
Route::get('/kirim/{jenis}/{nis}', [App\Http\Controllers\HomeController::class, 'kirim'])->name('kirim');
Route::get('/kirimall', [App\Http\Controllers\HomeController::class, 'kirimall'])->name('kirimall');
Route::get('/bayar/{nis}', [App\Http\Controllers\DaulController::class, 'bayar'])->name('bayar');

Route::get('/datasiswa/{unit}', [App\Http\Controllers\HomeController::class, 'datasiswa'])->name('datasiswa');
Route::post('/datadaul', [App\Http\Controllers\HomeController::class, 'datadaul'])->name('datadaul');

Route::get('/gantipassword', [App\Http\Controllers\HomeController::class, 'gantipassword'])->name('gantipassword');
Route::post('/gantipassword', [App\Http\Controllers\HomeController::class, 'gantipasswordnya'])->name('gantipasswordnya');

Route::resource('uploads','\App\Http\Controllers\UploadController');
Route::resource('dauls','\App\Http\Controllers\DaulController');
Route::resource('emails','\App\Http\Controllers\EmailController');
