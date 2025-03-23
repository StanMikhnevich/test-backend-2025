<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone_display,
            'position' => $this->position->name,
            'position_id' => $this->position_id,
            'photo' => $this->photo
                ? asset($this->photo_path)
                : URL::query(config('users.fakePhotoUrl'), [
                    'size' => config('users.photoOptions.width'),
                    'name' => $this->name,
                ]),
        ];
    }
}
