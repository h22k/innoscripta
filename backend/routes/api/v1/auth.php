<?php

use App\Http\Controllers\Api\Auth\RegisterController;

Route::name('auth.')->group(static function () {

    Route::post('register', RegisterController::class)->name('register');

});
