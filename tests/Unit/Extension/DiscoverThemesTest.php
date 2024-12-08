<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Extension;

use BaseCodeOy\Lighty\Extension\DiscoverThemes;
use BaseCodeOy\Lighty\Extension\Extension;
use Illuminate\Support\Facades\File;

it('should discover all themes', function (): void {
    File::shouldReceive('json')->andReturn(fixtureArray('Extension/themes.json'));

    $themes = DiscoverThemes::execute(Extension::fromString('GitHub.github-vscode-theme'));

    expect($themes)->toBeArray();
    expect($themes)->toHaveCount(9);
});
