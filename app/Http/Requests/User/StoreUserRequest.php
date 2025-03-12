<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'position_id' => [
                'required',
                'numeric',
                'min:1',
                'exists:positions,id',
            ],

            'name' => [
                'required',
                'string',
                'min:2',
                'max:60',
            ],

            'email' => [
                'required',
                'email',
                'email:rfc',
                'min:2',
                'max:100',
                'unique:users',
            ],

            'phone' => [
                'required',
                'string',
                'min:12',
                'max:13',
                'regex:/^[\+]{0,1}380([0-9]{9})$/',
                'unique:users',
            ],

            'photo' => [
                'required',
                'file',
                'mimes:jpeg,jpg,png',
                'max:5000',
                'dimensions:min_width=' . config('users.photo.size') . ',min_height=' . config('users.photo.size'),
            ],
        ];
    }

    public function messages(): array
    {
        return [];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'phone' => clearPhone($this->phone),
        ]);
    }

}
