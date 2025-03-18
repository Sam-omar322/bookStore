<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\AuthorController;

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

Route::get("/", [GalleryController::class, 'index'])->name('gallery.index');
Route::get("/search", [GalleryController::class, 'search'])->name('gallery.search');

Route::get("/book/{book}", [BookController::class, 'details'])->name('book.details');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/search', [CategoryController::class, 'search'])->name('categories.search');
Route::get("/category/{category}", [CategoryController::class, 'booksResult'])->name('categories.show');

Route::get('/publishers', [PublisherController::class, 'index'])->name('publishers.index');
Route::get('/publishers/search', [PublisherController::class, 'search'])->name('publishers.search');
Route::get("/publisher/{publisher}", [PublisherController::class, 'booksResult'])->name('publishers.show');

Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
Route::get('/authors/search', [AuthorController::class, 'search'])->name('authors.search');
Route::get("/author/{author}", [AuthorController::class, 'booksResult'])->name('authors.show');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('layouts.main');
    })->name('dashboard');
});