<?php

namespace App\Providers;

use App\ImageUpload\CloudinaryImageManager;
use App\ImageUpload\ImageManagerInterface;
use App\ImageUpload\LocalImageManager;
use Cloudinary\Cloudinary;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        if (!$this->app->environment('production')) {
            $this->app->register(FakerServiceProvider::class);
        }
        $this->app->bind(
            Cloudinary::class,
            fn() => new Cloudinary(
                [
                    'cloud' => [
                        'cloud_name' => config('cloudinary.cloud_name'),
                        'api_key' => config('cloudinary.api_key'),
                        'api_secret' => config('cloudinary.api_secret'),
                    ]
                ]
            )
        );
        if (!$this->app->environment('production')) {
            $this->app->bind(ImageManagerInterface::class, CloudinaryImageManager::class);
        } else {
            $this->app->bind(ImageManagerInterface::class, LocalImageManager::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
