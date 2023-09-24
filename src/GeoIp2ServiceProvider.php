<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 */
namespace Larva\GeoIp2;

use Illuminate\Support\ServiceProvider;

/**
 * Class GeoIp2ServiceProvider
 * @author Tongle Xu <xutongle@gmail.com>
 */
class GeoIp2ServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/geoip2.php' => config_path('geoip2.php'),
            ], 'geoip2-config');
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        if (!$this->app->configurationIsCached()) {
            $this->mergeConfigFrom(__DIR__ . '/../config/geoip2.php', 'geoip2');
        }

        $this->app->singleton('geoip2', function ($app) {
            return new GeoIp2Manager(config('geoip2'));
        });
    }
}