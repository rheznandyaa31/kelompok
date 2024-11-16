<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;

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
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return 'Too many attempts!';
        });

        Validator::extend('file_or_url', function ($attribute, $value, $parameters, $validator) {
            // Jika request mengandung file dan file tersebut valid
            if ($value instanceof \Illuminate\Http\UploadedFile) {
                return $value->isValid(); // Pastikan file valid
            }
        
            // Jika bukan file, periksa apakah ini URL yang valid
            return filter_var($value, FILTER_VALIDATE_URL) !== false;
        });        

        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
