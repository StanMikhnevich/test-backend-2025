<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;

class IndexUserRequest extends BaseFormRequest
{

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
