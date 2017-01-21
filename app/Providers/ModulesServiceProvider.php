<?php
/**
 * User: lasith_g
 * Date: 9/15/2015
 * Time: 12:49 PM
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ModulesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $modules = config("module.modules");

        while (list(,$module) = each($modules)) {

            // Load the routes for each of the modules
            if(file_exists(app_path().'/Modules/'.$module.'/routes.php')) {
                include app_path().'/Modules/'.$module.'/routes.php';
            }

            // Load the views
            if(is_dir(app_path().'/Modules/'.$module.'/Views')) {
                $this->loadViewsFrom(app_path().'/Modules/'.$module.'/Views', $module);
            }
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
