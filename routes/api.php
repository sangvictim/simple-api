<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['throttle:10,1'],
], function () {
    // Authors
    Route::get("/authors", [AuthorController::class, "index"]);
    Route::post("/authors", [AuthorController::class, "store"]);
    Route::get("/authors/{id}", [AuthorController::class, "show"]);
    Route::get("/authors/{id}/books", [AuthorController::class, "books"]);
    Route::put("/authors/{id}", [AuthorController::class, "update"]);
    Route::delete("/authors/{id}", [AuthorController::class, "destroy"]);

    // Books
    Route::get("books", [BookController::class, "index"]);
    Route::post("books", [BookController::class, "store"]);
    Route::get("books/{id}", [BookController::class, "show"]);
    Route::put("books/{id}", [BookController::class, "update"]);
    Route::delete("books/{id}", [BookController::class, "destroy"]);
});
