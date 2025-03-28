<?php

namespace App\Http\Requests;

use App\Traits\HasApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

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
                    Response::HTTP_UNPROCESSABLE_ENTITY
                )
            );
        }

        parent::failedValidation($validator);
    }
}
