<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'age' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'age.required' => '年齢を入力してください',
            'age.integer' => '年齢は数字で入力してください',
        ];
    }
}
