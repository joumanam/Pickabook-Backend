<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\InterestsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\ShowAddBookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShowAddEventController;
use App\Http\Controllers\StatusController;
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

// Authentication APIS


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
    Route::get('/showbooks/{id}', [ShowAddBookController::class, "showBooks"]);
    Route::delete("/deletebooks/{id}", [ShowAddBookController::class, "removeBooks"]);
    Route::get('/showallbooks/', [ShowAddBookController::class, "showAllBooks"]);


    // Changing Status APIS

    Route::put("/tradebooks/{id}", [StatusController::class, "trade"]);
    Route::put("/sellbooks/{id}", [StatusController::class, "sale"]);
    Route::put("/auctionbooks/{id}", [StatusController::class, "auction"]);
    Route::put("/idle/{id}", [StatusController::class, "idle"]);
    Route::post("/updateprice/{id}", [StatusController::class, "updateprice"]);

    // Wishlist APIS

    Route::post('/addwishlist', [WishlistController::class, "addWishlist"]);
    Route::get('/showwishlist', [WishlistController::class, "showWishlist"]);
    Route::delete('/deletewishlist/{id}', [WishlistController::class, "removeWishlist"]);

    // Search and filter APIS

    Route::get('/searcht/{string}', [SearchController::class, "title"]);
    Route::get('/searcha/{string}', [SearchController::class, "author"]);
    Route::get('/searchl/{string}', [SearchController::class, "language"]);
    Route::get('/searchs/{string}', [SearchController::class, "status"]);

   // Trades and Offers APIS
   Route::post('/offer/{book_id}', [OfferController::class, "offer"]);
   Route::get('/showoffers/{trade_id}', [OfferController::class, "showOffers"]);
   Route::get('/showtrades/{book_id}', [OfferController::class, "showTrades"]);


    // Event APIS
   Route::post('/addevent', [ShowAddEventController::class, "addEvent"]);
   Route::get('/showevent/{id}', [ShowAddEventController::class, "showEvent"]);
   Route::delete("/deleteevent/{id}", [ShowAddEventController::class, "removeEvent"]);
   Route::get('/showallevents/', [ShowAddEventController::class, "showAllEvents"]);

    Route::get("/getUser/{id}", [ShowAddBookController::class, "getUser"]);

    Route::get("/show/{user}", [UserController::class, "show"]);
    Route::post("/edit", [UserController::class, "update"]);
    Route::delete("/delete/account", [UserController::class, "destroy"]);


    Route::group([
        'prefix' => 'connect',
    ], function () {
        Route::delete("/delete/{userconnection}", [ConnectionController::class, "destroy"]);
    });

    Route::group([
        'prefix' => 'interest',
    ], function () {
        Route::post("/add", [InterestsController::class, "addInterest"]);
        Route::delete("/delete/{id}", [InterestsController::class, "removeInterest"]);
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
