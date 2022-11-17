<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotifyCateController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LecturersController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\LecturersLayoutController;
use App\Http\Controllers\MajorsController;
use App\Http\Controllers\NotifyController;
use App\Http\Controllers\StudentLayoutController;
use App\Http\Controllers\SubjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('client.pages.dasboard');
});

Route::get('/student', function () {
    return view('client.pages.homeStudent');
});

Route::middleware(['AuthCheck'])->group(function () {
    Route::prefix('student')->group(function () {
        Route::get('/', function () {
            return redirect()->route('studentHome');
        });
        Route::get('home', [StudentLayoutController::class, 'index'])->name('studentHome');
        Route::get('history', [StudentLayoutController::class, 'historyStudent'])->name('studentHistory');
    });
});

Route::middleware(['LecturersCheck'])->group(function () {
    Route::prefix('lecturers')->group(function () {
        Route::get('/', function () {
            return redirect()->route('scoreup');
        });
        Route::get('scoreup', [LecturersLayoutController::class, 'scoreup'])->name('scoreup');
        Route::get('handleScoreup', [LecturersLayoutController::class, 'handleScoreup']);
        Route::post('handleCaseScore', [LecturersLayoutController::class, 'handleCaseScore']);
        Route::post('postScoreUp', [LecturersLayoutController::class, 'postScoreUp']);
    });
});

Route::get('/loginAcount', [AuthController::class, 'showFormLogin'])->name('auth.formLogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/login', [AuthController::class, 'login'])->name('auth.handleLogin');


Route::middleware(['AdminCheck'])->group(function () {
    Route::prefix('ap-admin')->group(function () {
        Route::get('/', function () {
            return redirect(route('admin.dashboard'));
        });
        Route::get('/dashboard', function () {
            return view('admin.pages.dashboard');
        })->name('admin.dashboard');
        Route::resource('notify', NotifyController::class);
        Route::resource('class', ClassController::class);
        Route::resource('majors', MajorsController::class);
        Route::resource('subject', SubjectController::class);
        Route::resource('student', StudentController::class);
        Route::resource('lecturers', LecturersController::class);
        Route::resource('admins', AdminController::class);
    });
});
