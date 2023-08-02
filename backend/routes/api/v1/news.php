<?php

use App\Http\Controllers\Api\News\NewsController;

Route::name('news.')->controller(NewsController::class)->group(static function () {

    Route::get('/', 'index')->name('index');

});
