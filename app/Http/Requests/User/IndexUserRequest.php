<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class IndexUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'count' => [
                'sometimes',
                'integer',
                'min:1'
            ],

            'page' => [
                'sometimes',
                'integer',
                'min:1'
            ],
        ];
    }
}
