<?php
use App\Core\Http\Route;
use App\Controllers\Admin\HomeController as AdminHomeController;
use App\Controllers\Admin\ProfileController;
use App\Controllers\Admin\UserController;

    // admin dashboard route
    Route::get('admin', [AdminHomeController::class, 'index']);

    Route::get('admin/profile', [ProfileController::class, 'show']);
    Route::post('admin/profile/edit', [ProfileController::class, 'edit']);
    Route::post('admin/profile/edit/password', [ProfileController::class, 'editPassword']);

    Route::post('admin/users', [UserController::class, 'index']);
    Route::post('admin/users/create', [UserController::class, 'create']);