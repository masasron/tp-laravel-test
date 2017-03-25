<?php

namespace App\Http\Controllers\Api;

use App\Review;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Controllers\Api\ApiController;

class ReviewController extends ApiController
{

    /**
     * Display a listing of the reviews.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Review::paginate();
    }

    /**
     * Display any review by id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Review::findOrFail($id);
    }

   /**
    * Update a specified review.
    *
    * @param  int  $post_id
    * @param  App\Requests\UpdateReviewRequest  $request
    * @return \Illuminate\Http\Response
    */
    public function update($id, UpdateReviewRequest $request)
    {
        $review = $this->user->reviews()->findOrFail($id);
        $review->update($request->all());
        return $review;
    }

    /**
     * Remove a specified review.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $review = $this->user->reviews()->findOrFail($id);
        $review->delete();
        return $review;
    }
}
