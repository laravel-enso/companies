<?php

namespace LaravelEnso\Companies;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\Addresses\Services\Addressable;
use LaravelEnso\Companies\Models\Company;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->load()
            ->publish()
            ->relations()
            ->mapMorphs();
    }

    private function load()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        return $this;
    }

    private function publish()
    {
        $this->publishes([
            __DIR__.'/../database/factories' => database_path('factories'),
        ], ['companies-factory', 'enso-factories']);

        $this->publishes([
            __DIR__.'/../database/seeds' => database_path('seeds'),
        ], ['companies-seeder', 'enso-seeders']);

        return $this;
    }

    private function relations()
    {
        Addressable::register(Company::class);

        return $this;
    }

    private function mapMorphs()
    {
        Company::morphMap();
    }
}
