<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\InterestsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\ShowAddBookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\SearchController;
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
Route::group([
    'prefix' => 'auth',
], function () {
    Route::post("/login", [AuthController::class, "login"]);
    Route::post("admin/login", [AuthController::class, "adminLogin"]);
    Route::post("/register", [AuthController::class, "register"]);

    Route::middleware(['auth:api'])->group(function () {
        Route::post("/logout", [AuthController::class, "logout"]);
    });
});

Route::group([
    'prefix' => 'notification',
    'middleware' => 'auth:api',
], function () {
    Route::post("/create", [NotificationController::class, "store"]);
});

Route::group([
    'middleware' => 'auth:api',
], function () {
    // Buy and Sell APIS
    Route::post('/addbooks', [ShowAddBookController::class, "addBooks"]);
    Route::get('/showbooks', [ShowAddBookController::class, "showBooks"]);
    Route::delete("/deletebooks/{id}", [ShowAddBookController::class, "removeBooks"]);
    Route::put("/tradebooks/{id}", [ShowAddBookController::class, "tradeBooks"]);


    // Wishlist APIS
    Route::post('/addwishlist', [WishlistController::class, "addWishlist"]);
    Route::get('/showwishlist', [WishlistController::class, "showWishlist"]);
    Route::delete('/deletewishlist/{id}', [WishlistController::class, "removeWishlist"]);

    // Search and filter APIS
    Route::post('/searcht/{string}', [SearchController::class, "title"]);
    Route::post('/searcha/{string}', [SearchController::class, "author"]);
    Route::post('/searchl/{string}', [SearchController::class, "language"]);
    Route::post('/searchs/{string}', [SearchController::class, "status"]);



    Route::get("/connections", [UserController::class, "getUserConnections"]);
    Route::get("/{user}", [UserController::class, "show"]);
    Route::post("/edit", [UserController::class, "update"]);
    Route::delete("/delete/account", [UserController::class, "destroy"]);
    Route::get("/", [UserController::class, "getUserInterestedIn"]);


    Route::group([
        'prefix' => 'connect',
    ], function () {
        Route::get("/match/{id}", [ConnectionController::class, "store"]);
        Route::delete("/delete/{userconnection}", [ConnectionController::class, "destroy"]);
    });

    Route::group([
        'prefix' => 'interest',
    ], function () {
        Route::post("/add", [InterestsController::class, "addInterest"]);
        Route::delete("/delete/{id}", [InterestsController::class, "removeInterest"]);
    });

    Route::group([
        // 'prefix' => 'buysell',
        'middleware' => 'auth:api',
    ], function () {

    });

    Route::group([
        'prefix' => 'block',
        'middleware' => 'auth:api',
    ], function () {
        Route::get("/add/{id}", [BlockController::class, "store"]);
        Route::delete("/delete/{id}", [BlockController::class, "destroy"]);
    });

    Route::group([
        'prefix' => 'img',
        'middleware' => 'auth:api',
    ], function () {
        Route::post("/upload", [PictureController::class, "store"]);
        Route::delete("/delete/{id}", [PictureController::class, "destroy"]);
    });

});

Route::middleware(['auth:api', 'auth.role:Admin'])->prefix("admin")->group(function () {

    Route::group([
        'prefix' => 'images',
    ], function () {
        Route::get("/", [AdminController::class, "getImagesForApproveQueue"]);
        Route::get("/approve/{id}", [AdminController::class, "approveImage"]);
        Route::get("/decline/{id}", [AdminController::class, "declineImage"]);
    });

    Route::group([
        'prefix' => 'messages',
    ], function () {
        Route::get("/", [AdminController::class, "getMessagesForApproveQueue"]);
        Route::get("/approve/{id}", [AdminController::class, "approveMessage"]);
        Route::get("/decline/{id}", [AdminController::class, "declineMessage"]);
    });

});
