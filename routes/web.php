<?php

use App\Http\Controllers\ChapterController;
use App\Http\Controllers\CharacterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;

Route::get('/', function (){
    return view('index.index');
});

//AUTH
Route::middleware('ForUnlog')->group(function(){
    Route::get('/register', [AuthController::class, 'register_view']);
    Route::get('/login', [AuthController::class, 'login_view']);
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);







Route::get('/book/{id}', [BookController::class, 'info']);
Route::get('/book/{id}/download', [BookController::class, 'download']);
Route::get('/book/{book_id}/links', [LinksController::class, 'index']);
Route::get('/book/{book_id}/links/all_info', [LinksController::class, 'all_info']);
Route::get('/book/{book_id}/storyline', [BookController::class, 'storyline'])->name('storyline');
Route::get('/book/{id}/characters', [BookController::class, 'characters']);

 Route::get('/book/{book_id}/chapter/{chapter_id}', [ChapterController::class, 'index']);

Route::middleware('ForLog')->group(function(){



    //BOOK
    Route::get('/books', [BookController::class, 'index'])->name('books');
    Route::post('/book/create', [BookController::class, 'create']);
    Route::get('/book/{id}/delete', [BookController::class, 'delete']);


    //CHARACTERS
    Route::post('/book/{id}/characters/create', [CharacterController::class, 'character_create']);
    Route::post('/book/{book_id}/characters/edit/{character_id}', [CharacterController::class, 'character_edit']);
    Route::get('/book/{book_id}/characters/delete/{character_id}', [CharacterController::class, 'character_delete']);


    //CHAPTERS
    Route::post('/book/{id}/chapter/create', [ChapterController::class, 'create']);
    Route::post('/book/{id}/chapter/{chapter_id}/save', [ChapterController::class, 'save']);
    Route::get('/book/{id}/chapter/{chapter_id}/delete', [ChapterController::class, 'delete']);
    Route::post('/book/{id}/chapters/swap', [ChapterController::class, 'swap']);

    //LINKS
    Route::post('/color/create', [LinksController::class, 'color_create']);
    Route::post('/color/delete', [LinksController::class, 'color_delete']);
    Route::post('/link/create', [LinksController::class, 'link_create']);
    Route::post('/link/delete', [LinksController::class, 'link_delete']);
    Route::post('/character/position_edit', [CharacterController::class, 'position_edit']);


     //CHAPTERS
});
