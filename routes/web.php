<?php
use App\Http\Controllers\BlogController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', [BlogController::class, 'index'] )->name('blog.index');
Route::get('/student-info/form', [BlogController::class, 'loginForm'] )->name('blog.loginForm');
Route::get('/student-info/register', [BlogController::class, 'register'] )->name('blog.register');
Route::post('/blog/register', [BlogController::class, 'registerStore'] )->name('blog.registerStore');
Route::post('/blog/login', [BlogController::class, 'login'] )->name('blog.login');
