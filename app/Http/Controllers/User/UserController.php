<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;

/**
 * Class UserController
 *
 * @package App\Http\Controllers\User
 */
class UserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return UserResource
     */
    public function show()
    {
        return new UserResource(auth()->user());
    }
}
