<?php

namespace App\Http\Requests;

use App\Traits\HasApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseFormRequest extends FormRequest
{
    use HasApiResponse;

    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator): void
    {
        if ($this->expectsJson()) {
            throw new HttpResponseException(
                $this->error(
                    'Validation failed',
                    $validator->errors()->getMessages(),
                    422
                )
            );
        }

        parent::failedValidation($validator);
    }
}
