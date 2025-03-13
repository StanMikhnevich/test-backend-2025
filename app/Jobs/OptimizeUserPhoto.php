<?php

namespace App\Jobs;

use App\Models\User;
use App\Services\TinifyService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class OptimizeUserPhoto implements ShouldQueue
{
    use Queueable;

    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle(): void
    {
        TinifyService::optimize(public_path('storage/' . $this->user->photo_path));
    }
}
