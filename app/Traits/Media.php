<?php
namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait Media {

    public function uploadImage(object $file, string $path): string
    {
        $fileName   = time() . $file->getClientOriginalName();
        Storage::disk('public')->put($path . $fileName, File::get($file));

        return 'storage/'. $path . $fileName;
    }
}