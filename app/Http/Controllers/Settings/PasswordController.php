<?php

namespace App\Http\Controllers\Settings;

use App\Rules\IsNewPassword;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

/**
 * Class PasswordController
 *
 * @package App\Http\Controllers\Settings
 */
class PasswordController extends Controller
{
    /**
     * Update the user's password.
     *
     * @param Request $request
     *
     * @return JsonResponse
     *
     * @throws ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required|password',
            'password' => ['required', 'confirmed', 'min:8', new IsNewPassword]
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['success' => true]);
    }
}
