<?php

use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\AccountSettingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['web'])->group(function () {
    return view('auth.login');
});

Route::get('/set-locale/{locale}', function ($locale) {
    session(['locale' => $locale]);
    return redirect()->back();
})->name('locale');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/loginAct', [LoginController::class, 'authenticate'])->name('loginAct');

Route::get('/forgotPassword', [LoginController::class, 'forgotPassword'])->name('forgotPassword');
Route::post('/forgotPasswordAct', [LoginController::class, 'forgotPasswordAct'])->name('forgotPasswordAct');

Route::get('/validateForgotPassword/{token}', [LoginController::class, 'validateForgotPassword'])->name('validateForgotPassword');
Route::post('/validateForgotPasswordAct', [LoginController::class, 'validateForgotPasswordAct'])->name('validateForgotPasswordAct');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(
    function () {


        Route::get('/admin', function () {
            return view('admin.main');
        });

        // Route::get('/overview', function () {
        //     return view('menus.overview');
        // });
        Route::get('/overview', [DashboardController::class, 'index'])->name('overview');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/attendance', function () {
            return view('menus.attendance');
        });

        Route::get('/announcement', function () {
            return view('menus.announcement');
        });

        Route::get('/task', function () {
            return view('menus.task');
        });

        Route::get('/job', function () {
            return view('menus.job');

        });

        Route::get('/job_detail', function () {
            return view('menus.job_detail');

        });

        Route::get('/test_print', function () {
            return view('test-print');

        });

        Route::get('/{username}', [UserController::class, 'view'])->name('user.view');

        Route::get('/users/list', [UserController::class, 'index'])->name('users.list');
        Route::post('/users/store', [UserController::class, 'store'])->middleware(['Permission:manage-user', 'method.check:POST'])->name('users.store');
        Route::delete('/users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('/users/update/{id}', [UserController::class, 'updateView'])->name('users.updateView');
        Route::put('/users/updateAct/{id}', [UserController::class, 'update'])->name('users.updateAct');
        Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
        Route::get('/users/getPlacements', [LocationController::class, 'getPlacements'])->name('users.getPlacements');
        Route::get('/users/check-username', [UserController::class, 'checkUsername'])->name('checkUsername');
        Route::get('/users/check-itb-account', [UserController::class, 'checkITBAccount'])->name('checkItbAccount');

    }
);


