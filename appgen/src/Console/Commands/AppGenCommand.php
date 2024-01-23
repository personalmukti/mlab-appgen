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

        // Path to the views stub directory
        $viewsStubPath = __DIR__ . '/../../../stubs/views';

        // Copy all stub files to the project
        $this->publishStubs($viewsStubPath, $viewsPath);

        // Path to the destination routes directory
        $routesPath = base_path('routes');

        // Path to the routes stub file
        $routesStubPath = __DIR__ . '/../../../stubs/routes/generator.php';

        // Copy the routes stub to the destination routes directory
        File::copy($routesStubPath, "$routesPath/generator.php");

        // Modify the main web.php file to include the generator routes
        $this->modifyWebRoutes();

        // Path to the destination controllers directory
        $controllersPath = app_path('Http/Controllers');

        // Path to the controllers stub directory
        $controllersStubPath = __DIR__ . '/../../../stubs/controllers';

        // Copy the generator controller stub to the project
        $this->publishController($controllersStubPath, $controllersPath);

        $this->info("Application Generated!");
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

    /**
     * Copy all stub files to the project.
     *
     * @param  string  $stubsPath
     * @param  string  $destinationPath
     * @return void
     */
    protected function publishStubs($stubsPath, $destinationPath)
    {
        // Get all subdirectories in the stub directory
        $subdirectories = File::directories($stubsPath);

        // Loop through each subdirectory
        foreach ($subdirectories as $subdirectory) {
            // Get the subdirectory name without the path
            $subdirectoryName = basename($subdirectory);

            // Get all files in the subdirectory
            $files = File::allFiles($subdirectory);

            // Loop through each file and copy it to the destination
            foreach ($files as $file) {
                // Get the file name without the path
                $fileName = $file->getFilename();

                // Determine the destination directory
                $destinationDirectory = "$destinationPath/$subdirectoryName";

                // Make sure the destination directory exists
                File::makeDirectory($destinationDirectory, 0755, true, true);

                // Copy the file to the destination directory
                File::copy($file->getPathname(), "$destinationDirectory/$fileName");
            }
        }
    }

    /**
     * Modify the main web.php file to include the generator routes.
     *
     * @return void
     */
    protected function modifyWebRoutes()
    {
        // Path to the main web.php file
        $webRoutesPath = base_path('routes/web.php');

        // Add an include statement for the generator routes
        $includeStatement = "include __DIR__.'/generator.php';";

        // Append the include statement to the main web.php file
        File::append($webRoutesPath, "\n" . $includeStatement);
    }

    protected function publishController($stubsPath, $destinationPath)
    {
        // Path to the generator controller stub file
        $controllerStubPath = "$stubsPath/MLabGeneratorController.php.stub";

        // Determine the destination directory for controllers
        $destinationDirectory = app_path('Http/Controllers');

        // Make sure the destination directory exists
        File::makeDirectory($destinationDirectory, 0755, true, true);

        // Copy the controller stub to the destination directory
        File::copy($controllerStubPath, "$destinationDirectory/MLabGeneratorController.php");
    }
}
