<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\MajorsController;
use App\Http\Controllers\SubjectTypeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\LecturersController;
use App\Http\Controllers\ScoresController;
use App\Http\Controllers\CaseScoreController;
use App\Http\Controllers\DetailScoresController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\NotifyCateController;
use App\Http\Controllers\NotifyController;
use App\Models\Information;
use App\Models\Semester;
use App\Models\SubjectType;
use Illuminate\Http\Request;
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

Route::get('/test', function () {
    return response()->json([
        'data' => 'Get data sucess',
        'success' => true,
        'message' => 'Thêm dữ liệu thành công',
    ]);
});

// Auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Private Route
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::get('/logout', [AuthController::class, 'logOut']);
    Route::resource('/student', StudentController::class);
    Route::resource('/scores', ScoresController::class);
    // Route::resource('/casecore', CaseScoreController::class);
    Route::resource('/detailscorse', DetailScoresController::class);
    Route::get('/listScore/{id}', [ScoresController::class, 'loadListScoreByIdStudent']);
    Route::resource('/subject', SubjectController::class);

    //Kì học
    Route::resource('/semester', SemesterController::class);
    // Khóa học
    Route::resource('/course', CourseController::class);
    //Lĩnh Vực
    Route::resource('/field', FieldController::class);
    //Ngành học
    Route::resource('/majors', MajorsController::class);
    //Lớp
    Route::resource('/class', ClassController::class);
    //Loại môn học
    // Route::resource('/subject-type', SubjectTypeController::class);

    Route::resource('/information', InformationController::class);
    // Route::middleware('LecturersCheck')->group(function () {
    // Route::resource('/detailscorse', DetailScoresController::class);
    // Route::resource('/student', StudentController::class)->only('index', 'show');
    // Route::resource('/scores', ScoresController::class);
    Route::resource('/casecore', CaseScoreController::class);
    // Route::get('/listScore/{id}', [ScoresController::class, 'loadListScoreByIdStudent']);
    // Route::get('/listSubject/{id}', [SubjectController::class, 'loadListSubjectByClass']);
    // Route::resource('/subject', SubjectController::class);
    // });

    // Check Medium
    // Route::middleware('AdminCheck')->group(function () {
    // Route::resource('/student', StudentController::class)->only('index', 'show');
    Route::resource('/lecturers', LecturersController::class);
    // Route::resource('/scores', ScoresController::class);
    // Route::resource('/casecore', CaseScoreController::class);
    // Route::resource('/detailscorse', DetailScoresController::class);
    Route::resource('/information', InformationController::class);
    // Route::resource('/subject', SubjectController::class);
    // Route::resource('/semester', SemesterController::class);
    // Khóa học
    // Route::resource('/course', CourseController::class);
    //Lĩnh Vực
    // Route::resource('/field', FieldController::class);
    //Ngành học
    // Route::resource('/majors', MajorsController::class);
    //Lớp
    // Route::resource('/class', ClassController::class);
    //Loại môn học
    // Route::resource('/subject-type', SubjectTypeController::class);
    //Danh mục thông báo
    Route::resource('/notification', NotifyCateController::class);
    // Route::get('/search/{name}',[NotifyCateController::class,'search']);
    //Thông Báo
    Route::resource('/notify', NotifyController::class);



    // Check Master
    // Route::middleware('MasterAdminCheck')->group(function () {
    Route::resource('/admin', AdminController::class);
    // Route::resource('/student', StudentController::class);
    // Route::resource('/lecturers', LecturersController::class);
    // });
    // });

    // Route::resource('/admin',AdminController::class);
    // Route::resource('/student',StudentController::class);
    // Route::resource('/subject',SubjectController::class)->only('index', 'show');
    // Route::resource('/lecturers',LecturersController::class);
});
