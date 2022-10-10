<?php
declare(strict_types=1);

namespace App\ImageUpload;

use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

interface ImageManagerInterface
{
    /**
     * @param string|File|UploadedFile $file
     * @return string
     */
    public function save(File|string|UploadedFile $file): string;

    /**
     * @param string $name
     * @return void
     */
    public function delete(string $name): void;
}
