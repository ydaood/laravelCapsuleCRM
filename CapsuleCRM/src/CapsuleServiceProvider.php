<?php

namespace CapsuleCRM;

use Illuminate\Support\ServiceProvider;

class CapsuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/capsulecrm.php' => config_path('capsulecrm.php'),
        ], 'capsuleCRM');
    }
    
    public function register()
    {
        $this->app->singleton('CapsuleCRM', function () {
            return new CapsuleManager();
        });
    }
}
