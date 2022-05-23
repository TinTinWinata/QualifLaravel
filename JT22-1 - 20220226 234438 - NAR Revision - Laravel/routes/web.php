    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\LoginController;
    use App\Http\Controllers\AllocationController;
    use App\Http\Controllers\ClassController;
    use App\Http\Controllers\CourseController;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\ForumController;
    use App\Http\Controllers\LecturerController;
    use App\Http\Controllers\ScheduleController;
    use App\Http\Controllers\StudentController;
    use App\Http\Controllers\SubjectController;
    use Illuminate\Support\Facades\DB;

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

    Route::get('/update/{id}', [AllocationController::class, 'updatePage']);

    Route::group(['middleware' => ['admin']], function () {
        // Allocation
        Route::get('/allocation', [AllocationController::class, 'getAllocation'])->middleware('admin')->name('allocation');
        Route::post('/update-form', [AllocationController::class]);
        Route::post('/delete', [AllocationController::class, 'delete']);
        Route::post('/restore', [AllocationController::class, 'restore']);
        Route::get('/update', [AllocationController::class, 'update']);
        Route::post('/update-form', [AllocationController::class, 'updateForm']);
        Route::get('/home', function () {
            return redirect('/allocation');
        });
        Route::get('/create-allocation', [AllocationController::class, 'indexCreate']);
        Route::post('/create-form-allocation', [AllocationController::class, 'create']);

        // Classroom
        Route::post('/classroom-restore', [ClassController::class, 'restore']);
        Route::get('/classroom', [ClassController::class, 'index'])->name('classroom');
        Route::post('/classroom-insert', [ClassController::class, 'create']);
        Route::post('/classroom-delete', [ClassController::class, 'delete']);
        Route::get('/update-classroom/{classrooom}', function ($classroom) {
            return view('updateClassroom', compact('classroom'));
        });
        Route::post('/update-form-classroom', [ClassController::class, 'update']);


        // Lecturer
        Route::post('/lecturer-restore', [LecturerController::class, 'restore']);
        Route::get('/lecturer', [LecturerController::class, 'index'])->name('lecturer');
        Route::post('/lecturer-insert', [LecturerController::class, 'create']);
        Route::post('/lecturer-delete', [LecturerController::class, 'delete']);
        Route::get('/update-lecturer/{lecturer_code}', function ($lecturer_code) {
            $lecturer = DB::table('lecturers')
                ->where('lecturer_code', '=', $lecturer_code)->first();
            return view('updateLecturer', compact('lecturer'));
        });
        Route::post('/update-form-lecturer', [LecturerController::class, 'update']);

        // Student
        Route::post('/student-restore', [StudentController::class, 'restore']);
        Route::get('/student', [StudentController::class, 'index'])->name('student');
        Route::post('/student-insert', [StudentController::class, 'create']);
        Route::post('/student-delete', [StudentController::class, 'delete']);
        Route::get('/update-student/{student_code}', function ($student_code) {
            $student = DB::table('users')
                ->where('student_code', '=', $student_code)->first();
            return view('updateStudent', compact('student'));
        });
        Route::post('/update-form-student', [StudentController::class, 'update']);

        // Subject
        Route::post('/subject-restore', [SubjectController::class, 'restore']);
        Route::get('/subject', [SubjectController::class, 'index'])->name('subject');
        Route::post('/subject-insert', [SubjectController::class, 'create']);
        Route::post('/subject-delete', [SubjectController::class, 'delete']);
        Route::get('/update-subject/{subjet_code}', function ($subject_code) {
            $subject = DB::table('subjects')
                ->where('subject_code', '=', $subject_code)->first();
            return view('updateSubject', compact('subject'));
        });
        Route::post('/update-form-subject', [SubjectController::class, 'update']);
    });
    Route::get('/logout', [LoginController::class, 'logout']);


    Route::group(['middleware' => ['user']], function () {

        // Lecturer & Students

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/courses', [CourseController::class, 'index'])->name('courses');
        Route::get('/courses/{id}', [CourseController::class, 'courseDetail']);

        Route::get('/forums', [ForumController::class, 'index'])->name('forums');
        Route::get('/forum/{id}', [ForumController::class, 'forumDetail'])->name('forumDetail');
        Route::post('/create-reply', [ForumController::class, 'createReply']);
        Route::post('/delete-reply', [ForumController::class, 'deleteReply']);

        Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules');
    });
    Route::post('/validate-login', [LoginController::class, 'loginValidation']);
    Route::get('/', [LoginController::class, 'index']);
