<?php

namespace feiron\fe_blueprints;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;

class FeBluePrintsServiceProvider extends ServiceProvider {

    public function boot(){

        if ($this->app->runningInConsole()) {
            $this->commands([
                commands\fe_BluePrints::class,
                commands\fe_BluePrintsMakeController::class,
                commands\fe_BluePrintsMakeMigration::class,
                commands\fe_BluePrintsMakeModel::class,
                commands\fe_BluePrintsMakePage::class
            ]);
        }

        $PackageName='feBluePrints';       

        //loading migration scripts
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->publishes([
            __DIR__ . '/config' => config_path($PackageName),
        ], ($PackageName . '_config'));
        //set the publishing target path for asset files. Run only during update and installation of the package. see composer.json of the package.
        $this->publishes([
            __DIR__ . '/assets' => public_path('feiron/' . $PackageName),
        ], ($PackageName . '_public'));
    }

    public function register(){
        
    }
}

?>