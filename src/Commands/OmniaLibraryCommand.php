<?php

namespace OmniaDigital\OmniaLibrary\Commands;

use Illuminate\Console\Command;

class OmniaLibraryCommand extends Command
{
    public $signature = 'omnia-library:set-color';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
