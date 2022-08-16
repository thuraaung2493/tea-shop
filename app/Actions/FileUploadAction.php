<?php

namespace App\Actions;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileUploadAction
{
    public function execute(UploadedFile $file, string $name, $path = '/')
    {
        $fileName = $name . '.' . $file->getClientOriginalExtension();

        return Storage::putFileAs($path, $file, $fileName);
    }
}
