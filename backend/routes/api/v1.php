<?php


Route::name('v1.')->group(static function () {

    Route::prefix('auth')->group(base_path('routes/api/v1/auth.php'));
    Route::prefix('news')->group(base_path('routes/api/v1/news.php'));

});
