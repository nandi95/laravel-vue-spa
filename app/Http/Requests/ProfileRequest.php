<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProfileRequest
 *
 * @package App\Http\Requests
 */
class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // disposable email check at: https://github.com/Propaganistas/Laravel-Disposable-Email
        return [
            'first_name' => 'required',
            'email'      => 'required|email|unique:users,email,' . $this->user()->getKey(),
        ];
    }
}
