<?php

declare(strict_types=1);

namespace Tests\Unit\Extension;

use BombenProdukt\Lighty\Extension\DiscoverThemes;
use BombenProdukt\Lighty\Extension\Extension;
use Illuminate\Support\Facades\File;

it('should discover all themes', function (): void {
    File::shouldReceive('json')->andReturn(fixtureArray('Extension/themes.json'));

    $themes = DiscoverThemes::execute(Extension::fromString('GitHub.github-vscode-theme'), 'themes');

    expect($themes)->toBeArray();
    expect($themes)->toHaveCount(9);
});
