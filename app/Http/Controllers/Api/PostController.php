<?php

namespace App\Http\Controllers\Api;

use App\Rating;
use App\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libraries\JsonPlaceholderApi;

class PostController extends Controller
{
    /**
    * Store api client.
    *
    * @ver App\Libraries\JsonPlaceholderApi
    */
    protected $client;

    public function __construct()
    {
        $this->client = new JsonPlaceholderApi();
    }

    /**
     * Fetch posts from external api and paginate.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->client->get('posts')->paginate(10);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->client->getById('posts', $id);
    }
}
