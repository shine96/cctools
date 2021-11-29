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
        $this->publishes([
            __DIR__.'/../Command/ServicesCommand.php' => $this->app->basePath('Console/Commands/ServicesCommand.php'),
            __DIR__.'/../Command/InterfaceCommand.php' => $this->app->basePath('Console/Commands/InterfaceCommand.php')
        ]);
        $this->publishes([
            __DIR__.'/../../stubs/service.plain.stub' => $this->app->basePath('stubs/service.plain.stub'),
            __DIR__.'/../../stubs/interface.plain.stub' => $this->app->basePath('stubs/interface.plain.stub')
        ]);
    }



}