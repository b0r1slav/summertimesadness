<?php namespace App\Module\Improvement\Providers;

use Illuminate\Support\ServiceProvider;
use Schema;
use Illuminate\Database\Schema\Blueprint;

class InstallModuleServiceProvider extends ServiceProvider
{
    protected $module = 'App\Module\Improvement';

    protected $moduleAlias = 'improvement';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        app()->booted(function () {
            $this->booted();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }

    private function booted()
    {
        //Resolve your module dependency

        $this->createSchema();
    }

    private function createSchema()
    {
        \Artisan::call('module:migrate', ['alias' => $this->moduleAlias]);
    }
}
