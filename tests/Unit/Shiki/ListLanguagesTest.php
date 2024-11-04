<?php

declare(strict_types=1);

namespace Tests\Unit\Parser;

use BaseCodeOy\Lighty\Shiki\ListLanguages;
use function Spatie\Snapshots\assertMatchesSnapshot;

it('should call shiki and get a list of languages', function (): void {
    assertMatchesSnapshot(ListLanguages::execute());
});
