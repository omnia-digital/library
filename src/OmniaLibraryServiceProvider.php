<?php

namespace OmniaDigital\OmniaLibrary;

use GuzzleHttp\Psr7\Uri;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Js;
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
            ->hasAssets()
            ->hasCommand(OmniaLibraryCommand::class);
    }

    public function bootingPackage()
    {
        $this->registerViews();
        $this->registerLibraryDirectives();
    }

    private function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'library');
    }

    private function registerLibraryDirectives(): void
    {
        Blade::directive('libraryStyles', function () {
            $styleUrl = asset('/vendor/library/library.css');

            return <<<EOF
<link rel="stylesheet" href="$styleUrl">
EOF;
        });

        Blade::directive('libraryScripts', function () {
            $scriptsUrl = asset('/vendor/library/library.js');
            $provideToScript = Js::from($this->provideToScript());

            return <<<EOF
<script src="$scriptsUrl"></script>
<script>
    window.libraryConfig = $provideToScript;
</script>
EOF;
        });
    }

    public function provideToScript(): array
    {
        return [
            'domain'             => (new Uri(config('app.url')))->getHost(),
            'external_links_rel' => config('library.tiptap.external_links.rel')
        ];
    }
}
