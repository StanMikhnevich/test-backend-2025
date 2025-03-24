<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        $pagination = $this->resource->toArray();

        return [
            'page' => $pagination['current_page'],
            'total_pages' => $pagination['last_page'],
            'total_users' => $pagination['total'],
            'count' => $pagination['per_page'],
            'links' => [
                'prev_url' => $pagination['prev_page_url'],
                'next_url' => $pagination['next_page_url'],
            ],
            'users' => UserResource::collection($this->collection),
        ];
    }
}
