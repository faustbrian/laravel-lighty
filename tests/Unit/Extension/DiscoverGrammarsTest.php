<?php

declare(strict_types=1);

namespace Tests\Unit\Extension;

use BaseCodeOy\Lighty\Extension\DiscoverGrammars;
use BaseCodeOy\Lighty\Extension\Extension;
use Illuminate\Support\Facades\File;

it('should discover all grammars', function (): void {
    File::shouldReceive('json')->andReturn(fixtureArray('Extension/grammars.json'));

    $grammars = DiscoverGrammars::execute(Extension::fromString('bpruitt-goddard.mermaid-markdown-syntax-highlighting'), 'grammars');

    expect($grammars)->toBeArray();
    expect($grammars)->toHaveCount(1);
});
