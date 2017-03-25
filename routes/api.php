<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->group(function ($privateRoute) {
    Route::prefix('v1')->namespace('Api')->group(function () {
        // View multiple or single review.
        // Handle review modification and deletion.
        Route::resource('review', 'ReviewController', ['only' => ['index','show','update','destroy']]);

        // View multiple or single post.
        Route::resource('post', 'PostController', ['only' => ['index','show']]);

        // View and Store reviews for the specified post.
        Route::resource('post.reviews', 'PostReviewsController', ['only' => ['index','store']]);

        // View, Store and Update rating for the specified post.
        Route::resource('post.rating', 'PostRatingController', ['only' => ['index','store']]);
    });
});
