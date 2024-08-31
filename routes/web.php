<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\User;

use App\Http\Controllers\AppController;
use App\Http\Controllers\App;

use App\Http\Controllers\AppSectionContoller;
use App\Http\Controllers\AppSection;

use App\Http\Controllers\AppOrderController;
use App\Http\Controllers\AppOrder;

use App\Http\Controllers\VipController;
use App\Http\Controllers\Vip;

use App\Http\Controllers\TurkificationController;
use App\Http\Controllers\Turkification;

use App\Http\Controllers\TransferMoneyFirmController;
use App\Http\Controllers\TransferMoneyFirm;

use App\Http\Controllers\TransferMoneyFirmOrderController;
use App\Http\Controllers\TransferMoneyFirmOrder;

use App\Http\Controllers\GameSectionController;
use App\Http\Controllers\GameOrderController;
use App\Http\Controllers\GameController;

use App\Http\Controllers\EbankController;
use App\Http\Controllers\EbankSectionController;
use App\Http\Controllers\EbankOrderController;

use App\Http\Controllers\TransferController;
use App\Http\Controllers\TransferOrderController;


use App\Http\Controllers\ProgramController;

use App\Http\Controllers\CardController;

use App\Http\Controllers\DataController;


use App\Http\Controllers\EcardSectionController;
use App\Http\Controllers\EcardOrderController;
use App\Http\Controllers\EcardController;

Route::get('/', function () {
    return view('welcome');});

Route::resource( 'user', UserController::class,);
    
Route::get('users/{id}/category', [UserController::class, 'show_category']);

Route::resource(  'app' , AppController::class,);
Route::resource('app-section' , AppSectionContoller::class,);
Route::resource( 'app-order' , AppOrderController::class,);



Route::resource( 'vip' , VipController::class,);



Route::resource('turkification' , TurkificationController::class,);

Route::resource('turkification-order' , TurkificationController::class,);



Route::resource( 'transfer-money-firm' , TransferMoneyFirmController::class,);
Route::resource('transfer-money-firm-order' , TransferMoneyFirmOrderController::class,);


Route::resource( 'transfer' , TransferController::class,);
Route::resource('transfer-order' , TransferOrderController::class,);

 


Route::resource('game' , GameController::class,);
Route::resource('game-section' , GameSectionController::class,);
Route::resource('game-order' , GameOrderController::class,);


Route::resource('ecard' , EcardController::class,);
Route::resource('ecard-section' , EcardSectionController::class,);
Route::resource('ecard-order' , EcardOrderController::class,);


Route::resource('ebank' , EbankController::class,);
Route::resource('ebank-section' , EbankSectionController::class,);
Route::resource('ebank-order' , EbankOrderController::class,);


Route::resource('program' , ProgramController::class,);

Route::resource('card' , CardController::class,);

Route::resource('data' , DataController::class,);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
