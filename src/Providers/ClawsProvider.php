<?php

namespace Claws\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Claws\Support\PostRegister;
use Claws\Support\PermissionRegister;
use Claws\Support\SettingsRegister;

class ClawsProvider extends ServiceProvider
{
    public function boot() {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'claws');
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations/');
        $this->loadRoutesFrom(__DIR__.'../../routes.php');
        
        $this->publishes([
            __DIR__.'/../../config/claws.php' => config_path('claws.php'),
        ]);
    }

    public function register() {
        $this->app->booting(function() {
            $loader = AliasLoader::getInstance();
            $loader->alias('PostRegister', PostRegister::class);
            $loader->alias('PermissionRegister', PermissionRegister::class);
            $loader->alias('SettingsRegister', SettingsRegister::class);

            PermissionRegister::registerSection('Claws' ,'claws' ,'Permissions that come out the box to help you manage everything.');
            PermissionRegister::registerSection('Content Permissions' ,'content' ,'All content related permissions');
        });

    }

}