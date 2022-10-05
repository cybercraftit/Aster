<?php

namespace Cybercraftit\Aster;

use Illuminate\Support\ServiceProvider;

class AsterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'aster');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'aster');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        if ( file_exists( __DIR__.'/routes.php' ) ) {
            $this->loadRoutesFrom(__DIR__.'/routes.php');
        }

        $modules = glob( __DIR__ . '/Modules/*' );
        foreach ( $modules as $k => $module_path ) {
            //translations
            $this->loadTranslationsFrom($module_path.'/resources/lang', 'aster.'.basename( $module_path ) );
            //view
            $this->loadViewsFrom($module_path.'/resources/views', 'aster.'.basename( $module_path ) );
            //migration
            $this->loadMigrationsFrom($module_path . '/database/migrations' );
            //route
            if ( file_exists( $module_path . '/routes/routes.php' ) ) {
                $this->loadRoutesFrom($module_path . '/routes/routes.php');
            }
        }


        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('aster.php'),
            ], 'config');

            // Publishing the views.
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/aster'),
            ], 'views');

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/aster'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/aster'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->registerIncludes();
        $this->registerAdminIncludes();
        $this->registerSystemFiles();
        $this->registerAdminSystemFiles();
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'aster');

        // Register the main class to use with the facade
        $this->app->singleton('aster', function () {
            return new Aster;
        });
    }

    public function registerIncludes() {
        include_once __DIR__ . '/Includes/load.php';
    }

    public function registerAdminIncludes() {
        if ( strpos( $this->app->request->getRequestUri(), 'admin' ) === false ) {
            return;
        }

        include_once __DIR__ . '/AdminIncludes/load.php';
    }

    public function registerSystemFiles() {
        include_once __DIR__ . '/System/init.php';
    }

    public function registerAdminSystemFiles() {
        if ( strpos( $this->app->request->getRequestUri(), 'admin' ) === false ) {
            return;
        }
        include_once __DIR__ . '/AdminSystem/init.php';
    }
}
