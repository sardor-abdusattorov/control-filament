<?php

namespace App\Support\FileNamer;

use Illuminate\Support\Str;
use Spatie\MediaLibrary\Support\FileNamer\FileNamer;

class RandomFileNamer extends FileNamer
{
    public function originalFileName(string $fileName): string
    {
        return $fileName;
    }

    public function conversionFileName(string $fileName, string $conversionName): string
    {
        $baseName = pathinfo($fileName, PATHINFO_FILENAME);
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);

        return "{$baseName}-{$conversionName}.{$extension}";
    }

    public function responsiveFileName(string $fileName): string
    {
        return $fileName;
    }
}
