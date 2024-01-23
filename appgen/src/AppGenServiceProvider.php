<?php

namespace Mlab\Appgen;

use Illuminate\Support\ServiceProvider;
use Mlab\Appgen\Console\Commands\AppGenCommand;

class AppGenServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            AppGenCommand::class,
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Configuration path
        $configPath = __DIR__ . '/../config/appgen.php';

        // Publish configuration file
        $this->publishes([$configPath => config_path('appgen.php')], 'config');

        // View stub path
        $viewsStubPath = __DIR__ . '/Stubs/views/welcome_page.blade.php.stub';

        // Publish view stub
        $this->publishes([$viewsStubPath => resource_path('views/welcome_page.blade.php')], 'views');
    }
}