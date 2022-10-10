<?php
declare(strict_types=1);

namespace App\ImageUpload;

use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class LocalImageManager implements ImageManagerInterface
{

    /**
     * @inheritDoc
     */
    public function save(File|string|UploadedFile $file): string
    {
        $path = (string)Storage::putFile('public/images', $file);
        $array = explode('/', $path);

        return end($array);
    }

    /**
     * @inheritDoc
     */
    public function delete(string $name): void
    {
        $filePath = 'public/images' . $name;
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
    }
}
