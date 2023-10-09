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
    public function boot(): void
    {
        Validator::extend('min_words', function ($attribute, $value, $parameters, $validator) {
            $words = str_word_count($value);
            return $words >= $parameters[0];
        });
        // custom message
        Validator::replacer('min_words', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'The :attribute must be at least ' . $parameters[0] . ' words.');
        });
    }
}
