<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{

    /** @var string $apiNamespace */
    protected $apiNamespace = 'App\Http\Controllers\Api';

    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api/v1')
                ->middleware(['api', 'api_version:v1'])
                ->namespace($this->apiNamespace . '\V1')
                ->group(base_path('routes/api_v1.php'));

            Route::prefix('api/v2')
                ->middleware(['api', 'api_version:v2'])
                ->namespace($this->namespace . '\V2')
                ->group(base_path('routes/api_v2.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    // public function map()
    // {
    //     $this->mapApiRoutes();

    //     $this->mapApiV2Routes();

    //     $this->mapWebRoutes();
    // }

    // public function mapApiRoutes()
    // {
    //     Route::prefix('api')
    //         ->middleware('api')
    //         ->namespace($this->namespace)
    //         ->group(base_path('routes/api.php'));
    // }

    // public function mapWebRoutes()
    // {
    //     Route::middleware('web')
    //         ->namespace($this->namespace)
    //         ->group(base_path('routes/web.php'));
    // }

    // public function mapApiV2Routes()
    // {
    //     Route::prefix('api/v2')
    //         ->middleware('api')
    //         ->namespace($this->namespace)
    //         ->group(base_path('routes/api_v2.php'));
    // }
}
