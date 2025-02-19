<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\RolePermissionController;
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

        Route::get('/attendances', [AttendanceController::class, 'index'])->name('attendances.index');
        Route::get('/attendances/export/{type}', [AttendanceController::class, 'export'])->name('attendances.export');
        Route::get('/attendance/request/{id}', [AttendanceController::class, 'requestAttendance'])->name('attendance.request');
        Route::post('/attendance/verify-location', [AttendanceController::class, 'verifyLocation'])->name('attendance.verifyLocation');
        Route::post('/register-face', [AttendanceController::class, 'registerFace']);
        Route::post('/verify-face', [AttendanceController::class, 'verifyFace']);

        Route::get('/announcement', function () {
            return view('menus.announcement');
        });

        Route::get('/task', [TaskController::class, 'index'])->name('task.view');
        Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

        Route::get('/job', [JobController::class, 'index'])->name('job.view');
        Route::post('/addjobs', [JobController::class, 'store'])->name('jobs.store');
        Route::get('/job_detail/{job}', [JobController::class, 'detail'])->name('job.detail');
        Route::get('/jobs/search', [JobController::class, 'search'])->name('jobs.search');
        Route::post('/jobs/{job}/pin', [JobController::class, 'pin'])->name('jobs.pin');
        Route::post('/jobs/{job}/remove', [JobController::class, 'remove'])->name('jobs.remove');
        Route::put('/jobs/update/{id}', [JobController::class, 'update'])->name('jobs.update');

        Route::get('/test_print', function () {
            return view('test-print');
        });
        Route::get('/addface', function () {
            return view('menus.add_face');
        });
        // routes/web.php
        Route::get('/models/{file}', function ($file) {
            $path = public_path("models/$file");
            if (!file_exists($path)) {
                abort(404);
            }
            return response()->file($path);
        });

        Route::get('/users/{username}', [UserController::class, 'view'])->name('user.view');
        Route::get('/users/print/interview_magang_pkl', [PrintController::class, 'index_interview'])->name('print.interview_magang_pkl');
        Route::get('/users/print/exit_clearance', [PrintController::class, 'index_exit'])->name('print.exit_clearance');

        Route::get('/users', [UserController::class, 'index'])->name('users.list');
        Route::post('/users/store', [UserController::class, 'store'])->middleware(['Permission:manage_user', 'method.check:POST'])->name('users.store');
        Route::delete('/users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('/users/update/{id}', [UserController::class, 'updateView'])->name('users.updateView');
        Route::put('/users/updateAct/{id}', [UserController::class, 'update'])->name('users.updateAct');
        Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
        Route::get('/users/get/placement', [UserController::class, 'getPlacements'])->name('users.getPlacements');
        Route::get('/users/check/username', [UserController::class, 'checkUsername'])->name('checkUsername');
        Route::get('/users/check/itb-account', [UserController::class, 'checkITBAccount'])->name('checkItbAccount');
        Route::get('/users/export/{type}', [UserController::class, 'export'])->name('users.export');

        Route::get('/roles-permissions', [RolePermissionController::class, 'index'])->name('rolesPermissions.index');
        Route::post('/roles-permissions/store', [RolePermissionController::class, 'store'])->name('rolesPermissions.store');
        Route::delete('/user-permission/unlink/{id}', [RolePermissionController::class, 'unlinkUserPermission'])->name('userPermission.unlink');

        Route::get('/locations', [LocationController::class, 'index'])->name('location.index');

        Route::get('/documents', [DocumentController::class, 'index'])->name('document.index');

        Route::get('/help-center', [SupportController::class, 'index'])->name('helpCenter');
        Route::get('/contact-support', [SupportController::class, 'contactSupport'])->name('contactSupport');

        Route::get('/application-settings', [SettingController::class, 'applicationSetting'])->name('setelanUmum');
        // Route::get('/general-setting', [SettingController::class, 'generalSetting'])->name('setelanUmum');

        Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activityLogs.index');
    }
);
