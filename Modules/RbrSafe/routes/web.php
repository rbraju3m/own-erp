<?php

use Illuminate\Support\Facades\Route;
use Modules\RbrSafe\Http\Controllers\RbrSafeController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('rbrsaves', RbrSafeController::class)->names('rbrsafe');
});
