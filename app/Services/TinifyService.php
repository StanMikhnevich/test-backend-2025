<?php

namespace App\Services;

class TinifyService
{
    public static function optimize(string $image): void
    {
        \Tinify\setKey(config('services.tinify.key'));

        \Tinify\fromFile($image)
            ->resize(config('users.photoOptions'))
            ->toFile($image);
    }
}
