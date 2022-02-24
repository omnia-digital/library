<?php

namespace OmniaDigital\OmniaLibrary;

use OmniaDigital\OmniaLibrary\Commands\OmniaLibraryCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class OmniaLibraryServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('library')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_library_table')
            ->hasCommand(OmniaLibraryCommand::class);
    }
}
