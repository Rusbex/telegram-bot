<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TelegramController;
use Telegram\Bot\Laravel\Facades\Telegram;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/webhook/' . config('telegram.bot_token'), [TelegramController::class, 'handleWebhook']);
Telegram::setWebhook(['url' => 'https://ngrok.com/s/k8s-ingress' . config('telegram.bot_token'), 'verify' => false]);
