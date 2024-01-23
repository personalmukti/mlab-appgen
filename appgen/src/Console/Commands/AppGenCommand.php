<?php

namespace Mlab\Appgen\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class AppGenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'appgen:create-app {app_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new application using AppGen';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $appName = $this->argument('app_name');

        $this->info("Creating application: $appName");

        // path to the appgen.php.stub
        $stubPath = __DIR__ . '/../../../stubs/config/appgen.php.stub';

        // Read the content of the stub file
        $content = file_get_contents($stubPath);

        // Replace the stub variables
        $content = str_replace("'{{app_name}}'", "'$appName'", $content);

        // Path to the destination configuration file
        $configPath = config_path('appgen.php');

        // Copy the modified content to the destination
        File::put($configPath, $content);

        // Path to the destination views directory
        $viewsPath = resource_path('views');

        // Path to the views stub file
        $viewsStubPath = __DIR__ . '/../../../stubs/views/welcome_page.blade.php.stub';

        // Copy the views stub to the destination views directory
        File::copy($viewsStubPath, "$viewsPath/welcome_page.blade.php");

        $this->info("Creating application: $appName");
        $this->info("Configuration published successfully.");
    }

    /**
     * Replace stub variables and copy the stub to the destination path.
     *
     * @param  string  $stubPath
     * @param  string  $destinationPath
     * @param  array  $replace
     * @return void
     */
    protected function replaceAndCopyStub($stubPath, $destinationPath, $replace)
    {
        $content = file_get_contents($stubPath);

        foreach ($replace as $key => $value) {
            $content = str_replace("{{$key}}", $value, $content);
        }

        File::put($destinationPath, $content);
    }
}
