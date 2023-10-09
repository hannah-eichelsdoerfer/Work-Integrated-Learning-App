<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Models\IndustryPartner;
use App\Http\Controllers\IndustryPartnerController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ProjectApplicationController;
use App\Http\Controllers\StudentController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Students
    Route::resource('projects', ProjectController::class);
    // Industry Partners
    Route::get('/industry-partners', [IndustryPartnerController::class, 'index'])->name('industry-partners.index');
    Route::get('/industry-partners/{industryPartner}', [IndustryPartnerController::class, 'show'])->name('industry-partners.show');
    Route::patch('/industry-partners/{industryPartner}', [IndustryPartnerController::class, 'update'])->name('industry-partners.update');
    // Teacher s
    Route::post('/teachers/approve/{id}', [TeacherController::class, 'approve'])->name('teachers.approve');
    Route::post('/teachers/assign', [TeacherController::class, 'assign'])->name('teachers.assign');
    // Applications
    Route::get('/applications', [ProjectApplicationController::class, 'index'])->name('applications.index');
    Route::post('/projects/{project}/apply', [ProjectApplicationController::class, 'store'])->name('projects.apply');
    // Students
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show');
    Route::patch('/students/{student}', [StudentController::class, 'update'])->name('students.update');
});

require __DIR__ . '/auth.php';
