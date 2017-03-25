<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    /**
    * Stores the current user.
    *
    * @ver App\User
    */
    protected $user;

    public function __construct()
    {
        // Get the current api user.
        $this->user = Auth::guard('api')->user();
    }
}
