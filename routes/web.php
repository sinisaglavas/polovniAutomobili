<?php

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


Route::get('/', [App\Http\Controllers\AdController::class, 'index'])->name('welcome');
Route::get('/ajax', [App\Http\Controllers\AdController::class, 'ajax'])->name('ajax');


Route::get('/motors', [App\Http\Controllers\AdController::class, 'motors'])->name('motors');

Auth::routes();
// Route::post('post/{post:slug}/comments',[PostCommentsController::class, 'store'])->middleware('auth');  // ово ће вас спречити да покренете ту руту ако нисте пријављени


//home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/contact-confirmation/{id}', [App\Http\Controllers\HomeController::class, 'indirectAdvertiser'])->name('indirectAdvertiser');
Route::get('/messages', [App\Http\Controllers\HomeController::class, 'showMessages'])->name('showMessages');
Route::get('/messages/reply', [App\Http\Controllers\HomeController::class, 'replyMessage'])->name('replyMessage');
Route::get('/delete-message/{id}', [App\Http\Controllers\HomeController::class, 'deleteMessage'])->name('deleteMessage');

Route::post('/home/save-ad', [App\Http\Controllers\HomeController::class, 'saveAd'])->name('home.saveAd');
Route::post('/messages/reply', [App\Http\Controllers\HomeController::class, 'confirmReply'])->name('confirmReply');


//ad
Route::get('/ad/category-selection', [App\Http\Controllers\AdController::class, 'category'])->name('ad.categorySelection');
Route::get('/ad/ad-input-car/{id}', [App\Http\Controllers\AdController::class, 'adInputCar'])->name('ad.adInputCar');
Route::get('/ad/single-ad/{id}', [App\Http\Controllers\AdController::class, 'singleAd'])->name('ad.singleAd');
Route::get('new-cars', [App\Http\Controllers\AdController::class, 'newCars'])->name('newCars');

Route::post('/ad/search-car', [App\Http\Controllers\AdController::class, 'searchCar'])->name('ad.searchCar');
Route::post('/single-car/{id}/send-message', [App\Http\Controllers\AdController::class, 'sendMessage'])->name('sendMessage');

//adOwner
Route::get('/complete-offer/{ad_owner_id}', [App\Http\Controllers\AdOwnerController::class, 'completeOffer'])->name('complete_offer');

//carModel
Route::get('/car-models/{id}', [App\Http\Controllers\CarModelController::class, 'models'])->name('models');//ruta za JS
Route::get('/model-data/{brand_id}', [App\Http\Controllers\CarModelController::class, 'modelData'])->name('modelData');
Route::get('/get-model-by-car-id', [App\Http\Controllers\CarModelController::class, 'carModel']);//ruta za jQuery


//Route::get('/home', [App\Http\Controllers\ProgressBarController::class, 'index']);
//Route::post('/upload-doc-file', [App\Http\Controllers\ProgressBarController::class, 'uploadToServer']);
