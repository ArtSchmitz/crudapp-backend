<?php

use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/books', function(){
    return BookResource::collection(Book::all());
});

Route::get('/books/{id}', function($id){
    return new BookResource(Book::findOrFail($id));
});

Route::post('/book', [BookController::class, 'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
