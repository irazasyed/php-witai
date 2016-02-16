<?php

namespace Irazasyed\Wit\Laravel;

use Irazasyed\Wit\Wit;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container\Container as Application;
use Laravel\Lumen\Application as LumenApplication;
use Illuminate\Foundation\Application as LaravelApplication;

class WitServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig($this->app);
    }

    /**
     * Setup the config.
     *
     * @param \Illuminate\Contracts\Container\Container $app
     *
     * @return void
     */
    protected function setupConfig(Application $app)
    {
        $source = __DIR__.'/config/wit.php';

        if ($app instanceof LaravelApplication && $app->runningInConsole()) {
            $this->publishes([$source => config_path('wit.php')]);
        } elseif ($app instanceof LumenApplication) {
            $app->configure('wit');
        }

        $this->mergeConfigFrom($source, 'wit');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings($this->app);
    }

    /**
     * Register the wit class.
     *
     * @param \Illuminate\Contracts\Container\Container $app
     *
     * @return void
     */
    protected function registerBindings(Application $app)
    {
        $app->singleton('wit', function ($app) {
            $config = $app['config'];

            return new Wit(
                $config->get('wit.access_token', null),
                $config->get('wit.async_requests', false)
            );
        });

        $app->alias('wit', Wit::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['wit'];
    }
}