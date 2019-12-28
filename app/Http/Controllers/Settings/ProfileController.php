<?php

namespace App\Http\Controllers\Settings;

use App\Http\Requests\ProfileRequest;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;

/**
 * Class ProfileController
 *
 * @package App\Http\Controllers\Settings
 */
class ProfileController extends Controller
{
    /**
     * Update the user's profile information.
     *
     * @param ProfileRequest $request
     *
     * @return UserResource
     */
    public function update(ProfileRequest $request)
    {
        $user = tap($request->user())->update($request->validated());

        return new UserResource($user);
    }
}
