<?php

/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 11/25/18
 * Time: 6:26 PM
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class StorePublicUserRequest extends FormRequest
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
        return [
            'name' => 'required|string|min:2|max:80',
            'username' => 'required|string|min:3|max:50|unique:users,username',
            'email' => 'string|email',
            'password' => 'required|string|min:6|max:50|confirmed',
            'mobile' => 'required|string|min:11|max:14'
        ];
    }
}
