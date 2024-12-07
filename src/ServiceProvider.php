<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Lighty;

use BaseCodeOy\Crate\Package\AbstractServiceProvider;
use BaseCodeOy\Lighty\Command\SynchronizeGrammars;
use BaseCodeOy\Lighty\Command\SynchronizeThemes;
use Spatie\LaravelPackageTools\Package;

final class ServiceProvider extends AbstractServiceProvider
{
    #[\Override()]
    public function configurePackage(Package $package): void
    {
        $package
            ->name('lighty')
            ->hasCommand(SynchronizeGrammars::class)
            ->hasCommand(SynchronizeThemes::class)
            ->hasConfigFile('lighty');
    }
}
