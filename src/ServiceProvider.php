<?php

declare(strict_types=1);

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
