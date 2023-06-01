<?php

declare(strict_types=1);

namespace BombenProdukt\Lighty\Command;

use BombenProdukt\Lighty\Extension\CopyGrammars;
use BombenProdukt\Lighty\Extension\DiscoverGrammars;
use BombenProdukt\Lighty\Extension\DownloadExtension;
use BombenProdukt\Lighty\Extension\Extension;
use BombenProdukt\Lighty\Extension\ExtractExtension;
use BombenProdukt\Lighty\Extension\PurgeExtension;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

final class SynchronizeGrammars extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lighty:sync-grammars';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize grammars from configured extensions to grammars directory';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        foreach (Config::get('lighty.grammars') as $grammar) {
            $extension = Extension::fromString($grammar);

            DownloadExtension::execute($extension);

            ExtractExtension::execute($extension);

            $grammars = DiscoverGrammars::execute($extension);

            CopyGrammars::execute($extension, $grammars);

            PurgeExtension::execute($extension);
        }
    }
}
