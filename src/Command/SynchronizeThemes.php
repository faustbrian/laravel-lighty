<?php

declare(strict_types=1);

namespace BombenProdukt\Lighty\Command;

use BombenProdukt\Lighty\Extension\CopyThemes;
use BombenProdukt\Lighty\Extension\DiscoverThemes;
use BombenProdukt\Lighty\Extension\DownloadExtension;
use BombenProdukt\Lighty\Extension\Extension;
use BombenProdukt\Lighty\Extension\ExtractExtension;
use BombenProdukt\Lighty\Extension\PurgeExtension;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

final class SynchronizeThemes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lighty:sync-themes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize themes from configured extensions to themes directory';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        foreach (Config::get('lighty.themes') as $theme) {
            $extension = Extension::fromString($theme);

            DownloadExtension::execute($extension);

            ExtractExtension::execute($extension);

            $themes = DiscoverThemes::execute($extension);

            CopyThemes::execute($extension, $themes);

            PurgeExtension::execute($extension);
        }
    }
}
