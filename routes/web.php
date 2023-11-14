<?php

use App\Http\Controllers\Blog\AuthorController;
use App\Http\Controllers\ProfileController;
use \App\Http\Controllers\Blog\BlogController;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', [BlogController::class, 'index']);
Route::get('/posts/{slug}', [BlogController::class, 'show'])->name('single-post');
Route::get('/authors/{name}', [AuthorController::class, 'index'])->name('author');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/tokens/create', function (Request $request) {
        $token = Auth::user()->createToken(Auth::user()->slug_name);

        return ['token' => $token->plainTextToken];
    })->name('users.create.token');
});

require __DIR__.'/auth.php';
