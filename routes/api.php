<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('json.response')->group(function () {
    Route::post('register', [Controllers\Auth\RegisterController::class, 'register']);
    Route::post('verify-email', [Controllers\Auth\RegisterController::class, 'verifyEmail']);
    Route::post('resend-token', [Controllers\Auth\RegisterController::class, 'resendToken']);

    Route::post('login', Controllers\Auth\LoginController::class);

    Route::post('password/token', [Controllers\Auth\ResetPasswordController::class, 'token']);
    Route::post('password/reset', [Controllers\Auth\ResetPasswordController::class, 'reset']);

    Route::middleware(['auth:sanctum', 'email.verified'])->group(function () {
        Route::delete('logout', Controllers\Auth\LogoutController::class);

        Route::get('profile', Controllers\ProfileController::class);

        Route::apiResources([
            'users' => Controllers\UserController::class,
            'roles' => Controllers\RoleController::class,
            'permissions' => Controllers\PermissionController::class,
            'roles.permissions' => Controllers\RolePermissionController::class,
            'projects' => Controllers\ProjectController::class,
        ]);
    });
});
