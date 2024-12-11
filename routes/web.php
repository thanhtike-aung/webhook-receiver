<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('product_detail');
});

Route::post('/webhook/zmt', 'App\Http\Controllers\WebhookController');
