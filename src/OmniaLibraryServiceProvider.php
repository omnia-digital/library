<?php

namespace OmniaDigital\OmniaLibrary;

use Illuminate\Support\Facades\Blade;
use OmniaDigital\OmniaLibrary\Commands\OmniaLibraryCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class OmniaLibraryServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('library')
            ->hasConfigFile()
            ->hasViews()
            ->hasCommand(OmniaLibraryCommand::class);
    }

    public function bootingPackage()
    {
        $this->registerViews();
        $this->registerLibraryScriptsDirective();
    }

    private function registerLibraryScriptsDirective(): void
    {
        Blade::directive('omniaLibraryJs', function ($expression) {
            $debug = config('app.debug');

            //$scripts = con;

            // HTML Label.
            $html = $debug ? ['<!-- Livewire Scripts -->'] : [];

            // JavaScript assets.
            $html[] = $debug ? $scripts : $this->minify($scripts);

            return implode("\n", $html);
        });
    }

    private function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'library');
    }

    private function minify($subject): array|string|null
    {
        return preg_replace('~(\v|\t|\s{2,})~m', '', $subject);
    }
}
