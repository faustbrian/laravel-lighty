<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Extension;

use BaseCodeOy\Lighty\Extension\DiscoverGrammars;
use BaseCodeOy\Lighty\Extension\Extension;
use Illuminate\Support\Facades\File;

it('should discover all grammars', function (): void {
    File::shouldReceive('json')->andReturn(fixtureArray('Extension/grammars.json'));

    $grammars = DiscoverGrammars::execute(Extension::fromString('bpruitt-goddard.mermaid-markdown-syntax-highlighting'));

    expect($grammars)->toBeArray();
    expect($grammars)->toHaveCount(1);
});
