<?php

namespace App\Http\Requests\User;

use App\Exceptions\Api\UserExistsException;
use App\Http\Requests\BaseFormRequest;
use App\Traits\HasApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class StoreUserRequest extends BaseFormRequest
{
    use HasApiResponse;

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
                'mimes:jpeg,jpg',
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

    /**
     * @throws UserExistsException
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator): void
    {
        if ($this->isEmailExists($validator->failed()) || $this->isPhoneExists($validator->failed())) {
            if ($this->expectsJson()) {
                throw new UserExistsException();
            }
        }

        parent::failedValidation($validator);
    }

    public function isEmailExists(array $failed): bool
    {
        return array_key_exists('email', $failed) && array_key_exists('Unique', $failed['email']);
    }

    public function isPhoneExists(array $failed): bool
    {
        return array_key_exists('phone', $failed) && array_key_exists('Unique', $failed['phone']);
    }
}
