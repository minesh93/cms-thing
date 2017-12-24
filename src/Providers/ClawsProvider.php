<?php

namespace Claws\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Claws\Support\PostRegister;

class ClawsProvider extends ServiceProvider
{
    public function boot() {
        $this->loadViewsFrom(__DIR__.'../../../resources/views/', 'claws');
        $this->loadMigrationsFrom(__DIR__.'../../../database/migrations/');
        $this->loadRoutesFrom(__DIR__.'../../routes.php');
    }

    public function register() {
        $this->app->booting(function() {
            $loader = AliasLoader::getInstance();
            $loader->alias('PostRegister', PostRegister::class);
        });

    }

}