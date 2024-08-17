<?php

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

// User Authentication Routes
Route::get('/register', 'UserController@showRegistrationForm');
Route::post('/register', 'UserController@register');
Route::get('/login', 'UserController@showLoginForm');
Route::post('/login', 'UserController@login');
Route::get('/logout', 'UserController@logout');

// Home Page
Route::get('/index', [App\Http\Controllers\BookController::class, 'index'])->name('index');

// User Profile
Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');
Route::get('/profile/borrowed', [App\Http\Controllers\UserController::class, 'borrowed']);

// Book Contribution
Route::get('/contribute', [App\Http\Controllers\BookController::class, 'contribute'])->middleware('auth')->name('book.contribute');
Route::post('/contribute', [App\Http\Controllers\BookController::class, 'store'])->name('book.store');
Route::get('/books/search', [App\Http\Controllers\BookController::class, 'search'])->name('books.search');
Route::get('/books/filterByGenre/{genre}', [App\Http\Controllers\BookController::class, 'filterByGenre'])->name('books.filterByGenre');
Route::post('/books/{book}/re-request', [App\Http\Controllers\BookController::class, 'reRequestBook'])->name('book.re-request');
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'showContactForm'])->middleware('auth')->name('contact.form');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'submitContactForm'])->name('contact.submit');



// Book Borrowing
Route::match(['get', 'post'], '/borrow/{book}', [App\Http\Controllers\BorrowController::class, 'request'])->middleware('auth')->name('borrow.book');
Route::get('/return/{book}', [App\Http\Controllers\BorrowController::class, 'returnBook'])->name('return.book');
Route::match(['get', 'post'],'/borrow/again/{book}', [App\Http\Controllers\BorrowController::class, 'borrowAgain'])->middleware('auth')->name('borrowAgain.book');
Route::match(['get', 'post'],'/borrow/again/{book}', [App\Http\Controllers\BorrowController::class, 'borrowAgainHome'])->middleware('auth')->name('borrowAgainHome.book');

// Book Details
Route::get('/book/{book}', [App\Http\Controllers\BookController::class, 'show'])->name('book.show');


Auth::routes();

Route::get('/home', [App\Http\Controllers\BookController::class, 'index'])->name('home');
