<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Livewire\ImageUpload;
use App\Http\Livewire\Imagesearch;
use App\Http\Livewire\Blog;
use App\Http\Livewire\BackendSearch;
use App\Http\Livewire\BlogPreview;
use App\Http\Livewire\RecycleBin;

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

// Route::get('/backend', function () {
//     return view('welcome');
// })->name('backend');

Route::get('/backend/search', BackendSearch::class)->name('backend.search');
Route::get('/backend/blog/{id}', Blog::class)->name('backend.blog');
Route::get('/backend/upload/{id}/{type}', ImageUpload::class)->name('backend.upload');
Route::get('/backend/image', Imagesearch::class)->name('backend.image');
Route::get('/backend/blog/preview/{id}/{type}', BlogPreview::class)->name('backend.blog.preview');
Route::get('/backend/recycle', RecycleBin::class)->name('backend.recycle');

Route::get('/pre', [BlogController::class, 'pre'])->name('pre');

