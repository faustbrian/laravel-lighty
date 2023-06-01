<?php

declare(strict_types=1);

namespace BombenProdukt\Lighty;

use BombenProdukt\Lighty\Command\SynchronizeGrammars;
use BombenProdukt\Lighty\Command\SynchronizeThemes;
use BombenProdukt\PackagePowerPack\Package\AbstractServiceProvider;
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
