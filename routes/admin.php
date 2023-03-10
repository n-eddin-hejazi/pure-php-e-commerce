<?php
use App\Core\Http\Route;
use App\Controllers\Admin\HomeController as AdminHomeController;
use App\Controllers\Admin\ProfileController;

    // admin dashboard route
    Route::get('admin', [AdminHomeController::class, 'index']);

    Route::get('admin/profile', [ProfileController::class, 'show']);