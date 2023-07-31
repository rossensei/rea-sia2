<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\AnnouncementController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');


    Route::get('/students', [StudentController::class, 'index'])->name('students');
    Route::get('/students/search/{searchKey}', [StudentController::class, 'search'])->name('students.search');
    Route::post('/students/toggle/{student}', [StudentController::class, 'toggleActive'])->name('students.toggle');
    Route::get('/students/view/{student}', [StudentController::class, 'show'])->name('students.show');
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.delete');
    Route::get('/students/edit/{student}', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');

    Route::get('/students/add-record/{student}', [RecordController::class, 'create']);
    Route::post('/students/view/{student}', [RecordController::class, 'store']);
    Route::delete('/students/view/{student}/{record}', [RecordController::class, 'destroy']);
    Route::get('/students/view/{student}/{record}/edit', [RecordController::class, 'edit']);
    Route::put('/students/view/{student}/{record}', [RecordController::class, 'update']);

    Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements');
    Route::post('/announcements/send', [AnnouncementController::class, 'send'])->name('announcements.send');

});
