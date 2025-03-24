<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckRegisterToken;
use App\Http\Requests\User\IndexUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\HasApiResponse;
use App\Traits\HasUploadedFile;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ApiUserController extends Controller implements HasMiddleware
{
    use HasApiResponse, HasUploadedFile;

    public static function middleware(): array
    {
        return [
            new Middleware(CheckRegisterToken::class, ['store']),
        ];
    }

    public function index(IndexUserRequest $request): JsonResponse
    {
        $filters = $request->validated();

        return $this->success(
            (new UserCollection(
                User::query()->latest()->when(empty($filters['count']), function ($query, $count) {
                    $query->take($count ?? config('users.pagination.perPage'));
                })->paginate(
                    $filters['count'] ?? config('users.pagination.perPage')
                )
            ))->resolve()
        );
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['photo'] = $this->storeUploadedFiles(
                $request->file('photo'),
                User::IMAGE_PATH
            );
        }

        return $this->success([
            'user_id' => User::create($data)->id
        ]);
    }

    public function show(User $user): JsonResponse
    {
        return $this->success([
            'user' => new UserResource($user)
        ]);
    }
}
