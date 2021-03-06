<?php

use App\Models\Contact;
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

Route::get('/', function () {
    $contacts  = Contact::with('emails', 'phones')->get();
//    dd($contacts);
    return view('welcome', compact('contacts'));
});

Auth::routes();

Route::group(['middleware' => 'auth', 'as'=>'admin.','prefix'=>'admin'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('contact', App\Http\Controllers\ContactController::class);
});
