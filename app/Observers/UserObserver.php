<?php

namespace App\Observers;

use App\Jobs\OptimizeUserPhoto;
use App\Models\RegisterToken;
use App\Models\User;
use Illuminate\Http\Request;

class UserObserver
{
    public ?string $token;

    public function __construct(Request $request)
    {
        $this->token ??= $request->header('Token');
    }

    public function created(User $user): void
    {
        RegisterToken::where('token', $this->token)->valid()->delete();

        OptimizeUserPhoto::dispatch($user);
    }

}
