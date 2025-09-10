<?php

use Illuminate\Support\Facades\Route;
use Modules\RbrSafe\Http\Controllers\RbrSafeController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('rbrsaves', RbrSafeController::class)->names('rbrsafe');
});
