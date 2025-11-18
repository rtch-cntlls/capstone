<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // Share brands data with all admin.service-log views
        View::composer('admin.pages.service-log.*', function ($view) {
            $brands = [];
            $path = public_path('motorcycle/MotorcycleData.json');
            if (file_exists($path)) {
                $json = file_get_contents($path);
                $brands = json_decode($json, true) ?? [];
            }
            $view->with('brands', $brands);
        });
    }
}
