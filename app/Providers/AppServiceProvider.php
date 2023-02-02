<?php

namespace App\Providers;

use App\Exceptions\ApiException;
use App\Services\MessageService;
use App\Services\MessageServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (!isset($_ENV['VALIDATE_ENV']) || $_ENV['VALIDATE_ENV']) {
            $required = ['PORT', 'CLIENT_ORIGIN_URL'];
            foreach ($required as $name) {
                $value = env($name);
                if (empty($value)) {
                    throw new ApiException('The required environment variables are missing. Please check the .env file.');
                }
            }
        }

        $this->app->bind(MessageServiceInterface::class, MessageService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
