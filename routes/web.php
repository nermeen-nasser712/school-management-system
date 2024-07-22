<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Grades\GradeController;

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['guest']], function () {

    Route::get('/', function () {
        return view('auth.login');
    });

});

Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function(){ //...
		
		Route::resource('Grades',GradeController::class);
		Route::get('/dashboard', function () {
			return view('dashboard');
		})->middleware(['auth', 'verified'])->name('dashboard');

		Route::middleware('auth')->group(function () {
			Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
			Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
			Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
		});
});



require __DIR__.'/auth.php';