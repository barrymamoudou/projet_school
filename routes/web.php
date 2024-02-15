<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Setup\StudentController;

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
    Route::get('student/class/view', [StudentController::class, 'StudentClassView'])->name('student.class.view');
    Route::get('student/class/add', [StudentController::class, 'StudentClassAdd'])->name('student.class.add');
    Route::post('student/class/store', [StudentController::class, 'StudentClassStore'])->name('store.student.class');
    Route::get('student/class/edit/{id}', [StudentController::class, 'StudentClassEdit'])->name('student.class.edit');
    Route::post('student/class/update/{id}', [StudentController::class, 'StudentClassUpdate'])->name('update.student.class');
    Route::get('student/class/delete/{id}', [StudentController::class, 'StudentClassDelete'])->name('student.class.delete');
});