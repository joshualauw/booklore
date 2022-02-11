<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ["auth:sanctum"]], function () {
  Route::post("/library/create", [LibraryController::class, 'store']);
  Route::post("/library/delete", [LibraryController::class, 'delete']);
  Route::get("/library/byUser/{id}", [LibraryController::class, 'byUser']);
  Route::post("/user/follow", [FollowController::class, 'follow']);
  Route::post("/user/unfollow", [FollowController::class, 'unfollow']);
  Route::post("/user/newFollowerNotify", [UserController::class, 'newFollowerNotify']);
  Route::post("/user/getNewFollowerNotification", [UserController::class, 'getNewFollowerNotification']);
  Route::post("/user/readFollowerNotify", [UserController::class, 'readFollowerNotify']);
  Route::post("/book/create", [BookController::class, 'create']);
  Route::put("/book/update/{id}", [BookController::class, 'update']);
  Route::post("/book/updateBookCover/{id}", [BookController::class, 'updateBookCover']);
  Route::get("/chapter/{id}", [ChapterController::class, 'show']);
});

// Route::get("/test", function () {
//   $data = collect(Book::find(11)->chapters)->map(function ($chapter) {
//     return $chapter->votes()->where('isView', true)->count();
//   })->sum();
//   return response($data);
// });

Route::get("/book/byUser/{id}", [BookController::class, 'byUser']);
Route::get("/user/{id}", [UserController::class, 'show']);
Route::get("/chapter/byBook/{id}", [ChapterController::class, 'byBook']);
Route::get("/book/latest", [BookController::class, 'latest']);
Route::get("/book/byTag", [BookController::class, 'byTag']);
Route::get("/book/byTitle", [BookController::class, 'byTitle']);
Route::get("/book/highlyrated", [BookController::class, 'highlyRated']);
Route::get("/book/random", [BookController::class, 'random']);
Route::get("/book/{id}", [BookController::class, 'show']);
Route::get("/tag", [TagController::class, 'index']);
Route::post("/login", [AuthController::class, 'login']);
Route::post("/register", [AuthController::class, 'register']);
