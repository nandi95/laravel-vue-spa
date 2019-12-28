<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'auth:api', 'as' => 'api.dashboard.'], function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/user', [UserController::class, 'show'])->name('me');

    Route::patch('settings/profile', [ProfileController::class, 'update'])->name('settings.profile.update');
    Route::patch('settings/password', [PasswordController::class, 'update'])->name('settings.password.update');
});

Route::group(['middleware' => 'guest:api', 'as' => 'api.guest.'], function () {
    Route::post('login', [LoginController::class, 'login'])->name('auth.login');
    Route::post('register', [RegisterController::class, 'register'])->name('auth.register');

    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.reset');

    Route::post('email/verify/{user}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

    Route::post('oauth/{driver}', [OAuthController::class, 'redirectToProvider'])->name('oauth.redirect');
    Route::get('oauth/{driver}/callback', [OAuthController::class, 'handleProviderCallback'])->name('oauth.callback');
});
