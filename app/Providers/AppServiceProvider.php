<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     * Проброска всех типовых кастомных директорий
     */
    public function boot(): void
    {
        foreach (config('filesystems.disks.custom_directories') as $diskName) {
            config(["filesystems.disks.{$diskName}" => [
                'driver' => 'local',
                'root' => storage_path("app/public/{$diskName}"),
                'url' => env('APP_URL') . "/storage/{$diskName}",
                'visibility' => 'public',
            ]]);
        }
    }
}
