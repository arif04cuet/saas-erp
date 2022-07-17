<?php

/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 11/25/18
 * Time: 6:29 PM
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'username' => 'required|string|min:3|max:50|unique:users,username,' . $this->route()->parameters['user'],
            'email' => 'string|email',
            'mobile' => 'required|string|min:11|max:14'
        ];
    }
}
