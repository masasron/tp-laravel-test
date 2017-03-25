<?php

namespace App\Http\Controllers\Api;

use App\Review;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\StorePostReviewRequest;

class PostReviewsController extends ApiController
{
    /**
     * Get all the reviews for a post.
     *
     * @param  int  $post_id
     * @return \Illuminate\Http\Response
     */
    public function index($post_id)
    {
        return Review::where('post_id', $post_id)->with('user')
                        ->orderBy('id', 'desc')->paginate();
    }

    /**
     * Store a new review of a post.
     *
     * @param  int  $post_id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($post_id, StorePostReviewRequest $request)
    {
        return $this->user->reviews()->create([
            'post_id' => $post_id,
            'subject' => $request->subject,
            'body' => $request->body
        ]);
    }
}
