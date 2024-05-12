<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [SiteController::class, 'home']);
Route::get('/about', [SiteController::class, 'About']);
Route::get('/contact', [SiteController::class, 'Contact']);
Route::get('/blog', [SiteController::class, 'Blog']);
Route::get('/details/{id}', [SiteController::class, 'Details']);

// authentication
Route::get('/reg', [SiteController::class, 'Registation']);
Route::get('/login', [SiteController::class, 'Login']);
Route::post('/admin-registaion', [SiteController::class, 'admin_registaion']);
Route::post('/admin-login', [SiteController::class, 'admin_login']);
Route::post('/admin-logout', [SiteController::class, 'admin_logout']);

// this is admin route
Route::get('/admin', [SiteController::class, 'Admin_Home'])->middleware('AdminAuth');
Route::get('/add-blog', [SiteController::class, 'Add_blog'])->middleware('AdminAuth');
Route::get('/update', [SiteController::class, 'update_blog'])->middleware('AdminAuth');

// admin works
Route::get('/update-form/{id}', [SiteController::class, 'update_form_submit'])->middleware('AdminAuth');
Route::post('/add-blog-submit', [SiteController::class, 'add_blog_submit'])->middleware('AdminAuth');
Route::get('/remove-blog', [SiteController::class, 'remove_blog'])->middleware('AdminAuth');
Route::post('/update-blog-submit', [SiteController::class, 'update_blog_submit_form'])->middleware('AdminAuth');
