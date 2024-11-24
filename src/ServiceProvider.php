<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Lighty;

use BaseCodeOy\Lighty\Command\SynchronizeGrammars;
use BaseCodeOy\Lighty\Command\SynchronizeThemes;
use BaseCodeOy\PackagePowerPack\Package\AbstractServiceProvider;
use Spatie\LaravelPackageTools\Package;

final class ServiceProvider extends AbstractServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-lighty')
            ->hasCommand(SynchronizeGrammars::class)
            ->hasCommand(SynchronizeThemes::class)
            ->hasConfigFile('lighty');
    }
}
