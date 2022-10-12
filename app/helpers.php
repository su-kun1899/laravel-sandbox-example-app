<?php
declare(strict_types=1);

use Cloudinary\Cloudinary;
use Illuminate\Contracts\Container\BindingResolutionException;

if (!function_exists('image_url')) {
    /**
     * @throws BindingResolutionException
     */
    function image_url(string $path): string
    {
        if (app()->environment('production')) {
            return (string)app()->make(Cloudinary::class)->image($path)->secure();
        }

        return asset('storage/images/' . $path);
    }
}
