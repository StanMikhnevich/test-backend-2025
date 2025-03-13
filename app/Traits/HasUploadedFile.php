<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Ramsey\Uuid\Uuid;

trait HasUploadedFile
{
    protected function storeUploadedFiles(UploadedFile $file, string $path = 'images'): string
    {
        $filename = Uuid::uuid4() . '.' . $file->getClientOriginalExtension();

        $file->storeAs($path, $filename, 'public');

        return $filename;
    }
}
