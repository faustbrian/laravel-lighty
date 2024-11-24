<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Lighty\Command;

use BaseCodeOy\Lighty\Extension\CopyThemes;
use BaseCodeOy\Lighty\Extension\DiscoverThemes;
use BaseCodeOy\Lighty\Extension\DownloadExtension;
use BaseCodeOy\Lighty\Extension\Extension;
use BaseCodeOy\Lighty\Extension\ExtractExtension;
use BaseCodeOy\Lighty\Extension\PurgeExtension;
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
