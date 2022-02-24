<?php

namespace OmniaDigital\OmniaLibrary\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use OmniaDigital\OmniaLibrary\OmniaLibraryServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'OmniaDigital\\OmniaLibrary\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            OmniaLibraryServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_library_table.php.stub';
        $migration->up();
        */
    }
}
