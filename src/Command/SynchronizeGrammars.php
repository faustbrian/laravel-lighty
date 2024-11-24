<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Lighty\Command;

use BaseCodeOy\Lighty\Extension\CopyGrammars;
use BaseCodeOy\Lighty\Extension\DiscoverGrammars;
use BaseCodeOy\Lighty\Extension\DownloadExtension;
use BaseCodeOy\Lighty\Extension\Extension;
use BaseCodeOy\Lighty\Extension\ExtractExtension;
use BaseCodeOy\Lighty\Extension\PurgeExtension;
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
