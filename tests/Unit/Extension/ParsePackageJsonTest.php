<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Extension;

use BaseCodeOy\Lighty\Extension\Extension;
use BaseCodeOy\Lighty\Extension\ParsePackageJson;
use Illuminate\Support\Facades\File;

it('should parse the package.json for themes', function (): void {
    File::shouldReceive('json')->andReturn(fixtureArray('Extension/themes.json'));

    $themes = ParsePackageJson::execute(Extension::fromString('GitHub.github-vscode-theme'), 'themes');

    expect($themes)->toBeArray();
    expect($themes)->toHaveCount(9);
});

it('should parse the package.json for grammars', function (): void {
    File::shouldReceive('json')->andReturn(fixtureArray('Extension/grammars.json'));

    $grammars = ParsePackageJson::execute(Extension::fromString('bpruitt-goddard.mermaid-markdown-syntax-highlighting'), 'grammars');

    expect($grammars)->toBeArray();
    expect($grammars)->toHaveCount(3);
});
