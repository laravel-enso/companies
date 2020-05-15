<?php

namespace LaravelEnso\Companies;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use LaravelEnso\Companies\App\Models\Company;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->load()
            ->mapMorphs()
            ->publish();
    }

    private function load()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');

        return $this;
    }

    private function mapMorphs()
    {
        Relation::morphMap([
            Company::morphMapKey() => Company::class,
        ]);

        return $this;
    }

    private function publish()
    {
        $this->publishes([
            __DIR__.'/database/factories' => database_path('factories'),
        ], ['companies-factory', 'enso-factories']);

        $this->publishes([
            __DIR__.'/database/seeds' => database_path('seeds'),
        ], ['companies-seeder', 'enso-seeders']);
    }
}
