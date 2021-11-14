<?php


namespace CCTools\Providers;


use Illuminate\Support\ServiceProvider;

class MakeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //自动注册

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $commandPath = __DIR__.'/../Command/ServicesCommand.php';
        $stubPath = __DIR__.'/../Command/stubs/service.plain.stub';
        $this->publishes([
            $commandPath => app_path('Console/Commands/ServicesCommand.php'),
            $stubPath => app_path('Console/Commands/stubs/service.plain.stub')
        ]);
    }



}