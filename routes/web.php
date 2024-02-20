<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Setup\YearController;
use App\Http\Controllers\Backend\Setup\StudentController;
use App\Http\Controllers\Backend\Setup\FeeCategoryController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;
use App\Http\Controllers\Backend\Setup\StudentShiftController;

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
    return view('welcome');
});

Route::group(['prefix'=>'admin','middleware'=>['admin:admin']],function(){
	Route::get('/login', [AdminController::class, 'loginForm']);
	Route::post('/login', [AdminController::class, 'store'])->name('admin.login');

});



Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard');


Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

Route::get('/admin/logout', [AdminController::class,'Logout'])->name('admin.logout');

Route::prefix('users')->group(function () {
    Route::get('/view', [UserController::class,'UserView'])->name('user.view');
    Route::get('/add',[UserController::class,'UserAdd'])->name('users.add');
    Route::post('/store', [UserController::class,'UserStore'])->name('users.store');
    Route::get('/edit/{id}', [UserController::class,'UserEdit'])->name('user.edit');
    Route::post('/update/{id}', [UserController::class,'UserUpdate'])->name('user.update');
    Route::get('/delete/{id}', [UserController::class,'UserDelete'])->name('user.delete');
    
});

// voir le profile de l'utilisateur

Route::prefix('profile')->group(function () {
    Route::get('/view', [ProfileController::class,'ProfileView'])->name('profile.view');
    Route::get('/edit_profile', [ProfileController::class,'ProfileEdit'])->name('profile.edit');
    Route::post('/profileStore', [ProfileController::class,'ProfileStore'])->name('profile.store');
    Route::get('/password/view', [ProfileController::class, 'PasswordView'])->name('password.view');
    Route::post('/password/update', [ProfileController::class, 'PasswordUpdate'])->name('password.update');
});

Route::prefix('setup')->group(function () {
    // les routes de classe 
    Route::get('student/class/view', [StudentController::class, 'StudentClassView'])->name('student.class.view');
    Route::get('student/class/add', [StudentController::class, 'StudentClassAdd'])->name('student.class.add');
    Route::post('student/class/store', [StudentController::class, 'StudentClassStore'])->name('store.student.class');
    Route::get('student/class/edit/{id}', [StudentController::class, 'StudentClassEdit'])->name('student.class.edit');
    Route::post('student/class/update/{id}', [StudentController::class, 'StudentClassUpdate'])->name('update.student.class');
    Route::get('student/class/delete/{id}', [StudentController::class, 'StudentClassDelete'])->name('student.class.delete');

    // les routes de l'annee

    Route::get('student/year/view', [YearController::class, 'StudentYearView'])->name('student.year.view');
    Route::get('student/year/add', [YearController::class, 'StudentYearAdd'])->name('student.year.add');
    Route::post('student/year/store', [YearController::class, 'StudentYearStore'])->name('store.student.year');
    Route::get('student/year/edit/{id}', [YearController::class, 'StudentYearEdit'])->name('student.year.edit');
    Route::post('student/year/update/{id}', [YearController::class, 'StudentYearUpdate'])->name('update.student.year');
    Route::get('student/year/delete/{id}', [YearController::class, 'StudentYearDelete'])->name('student.year.delete');

     // les routes chifts 

     Route::get('student/year/view', [YearController::class, 'StudentYearView'])->name('student.year.view');
     Route::get('student/year/add', [YearController::class, 'StudentYearAdd'])->name('student.year.add');
     Route::post('student/year/store', [YearController::class, 'StudentYearStore'])->name('store.student.year');
     Route::get('student/year/edit/{id}', [YearController::class, 'StudentYearEdit'])->name('student.year.edit');
     Route::post('student/year/update/{id}', [YearController::class, 'StudentYearUpdate'])->name('update.student.year');
     Route::get('student/year/delete/{id}', [YearController::class, 'StudentYearDelete'])->name('student.year.delete');

     // Student Group Routes 
    Route::get('student/group/view', [StudentGroupController::class, 'ViewGroup'])->name('student.group.view');

    Route::get('student/group/add', [StudentGroupController::class, 'StudentGroupAdd'])->name('student.group.add');

    Route::post('student/group/store', [StudentGroupController::class, 'StudentGroupStore'])->name('store.student.group');

    Route::get('student/group/edit/{id}', [StudentGroupController::class, 'StudentGroupEdit'])->name('student.group.edit');

    Route::post('student/group/update/{id}', [StudentGroupController::class, 'StudentGroupUpdate'])->name('update.student.group');

    Route::get('student/group/delete/{id}', [StudentGroupController::class, 'StudentGroupDelete'])->name('student.group.delete');
 
    // Student Shift Routes 

    Route::get('student/shift/view', [StudentShiftController::class, 'ViewShift'])->name('student.shift.view');

    Route::get('student/shift/add', [StudentShiftController::class, 'StudentShiftAdd'])->name('student.shift.add');

    Route::post('student/shift/store', [StudentShiftController::class, 'StudentShiftStore'])->name('store.student.shift');

    Route::get('student/shift/edit/{id}', [StudentShiftController::class, 'StudentShiftEdit'])->name('student.shift.edit');

    Route::post('student/shift/update/{id}', [StudentShiftController::class, 'StudentShiftUpdate'])->name('update.student.shift');

    Route::get('student/shift/delete/{id}', [StudentShiftController::class, 'StudentShiftDelete'])->name('student.shift.delete');

    // Fee Category Routes 

    Route::get('fee/category/view', [FeeCategoryController::class, 'ViewFeeCat'])->name('fee.category.view');

    Route::get('fee/category/add', [FeeCategoryController::class, 'FeeCatAdd'])->name('fee.category.add');

    Route::post('fee/category/store', [FeeCategoryController::class, 'FeeCatStore'])->name('store.fee.category');

    Route::get('fee/category/edit/{id}', [FeeCategoryController::class, 'FeeCatEdit'])->name('fee.category.edit');

    Route::post('fee/category/update/{id}', [FeeCategoryController::class, 'FeeCategoryUpdate'])->name('update.fee.category');

    Route::get('fee/category/delete/{id}', [FeeCategoryController::class, 'FeeCategoryDelete'])->name('fee.category.delete');




    });