<?php

namespace App\ImageUpload;

use Cloudinary\Api\Exception\ApiError;
use Cloudinary\Cloudinary;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;

class CloudinaryImageManager implements ImageManagerInterface
{
    /**
     * @param Cloudinary $cloudinary
     */
    public function __construct(private Cloudinary $cloudinary)
    {
    }

    /**
     * @inheritDoc
     * @param File|string|UploadedFile $file
     * @return string
     * @throws ApiError
     */
    public function save(File|string|UploadedFile $file): string
    {
        return $this->cloudinary
            ->uploadApi()
            ->upload(is_string($file) ? $file : $file->getRealPath())['public_id'];
    }

    /**
     * @inheritDoc
     */
    public function delete(string $name): void
    {
        $this->cloudinary->uploadApi()->destroy($name);
    }
}
