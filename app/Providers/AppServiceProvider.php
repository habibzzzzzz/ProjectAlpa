<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
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
     */

public function boot()
{
    Validator::replacer('required', function ($message, $attribute, $rule, $parameters) {
        return 'Kolom ' . str_replace('_', ' ', $attribute) . ' wajib diisi.';
    });
}
}
