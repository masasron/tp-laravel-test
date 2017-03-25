<?php

namespace App\Http\Controllers\Api;

use App\Rating;
use App\Http\Requests\StorePostRatingRequest;

class PostRatingController extends ApiController
{

    /**
     * Display the rating of a given post.
     *
     * @param  int  $post_id
     * @return \Illuminate\Http\Response
     */
    public function index($post_id)
    {
        $currentUserPostRating = $this->user->ratings()->select('stars')->where('post_id', $post_id)->first();
        $averageRating = Rating::where('post_id', $post_id)->avg('stars');
        return [
            'average_rating' => $averageRating ?: 0,
            'user_rating' => $currentUserPostRating ? $currentUserPostRating->stars : ''
        ];
    }

    /**
     * Store or update rating of a post.
     *
     * @param  int  $post_id
     * @param  \App\Requests\StorePostRatingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRatingRequest $request, $post_id)
    {
        $rating = $this->user->ratings()->where('post_id', $post_id)->first();
        if (!$rating) {
            $rating = $this->user->ratings()->create([
                'post_id' => $post_id,
                'stars' => $request->stars
            ]);
        } else {
            $rating->update(['stars' => $request->stars]);
        }
        return $rating;
    }
}
