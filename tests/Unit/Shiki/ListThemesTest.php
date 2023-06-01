<?php

declare(strict_types=1);

namespace Tests\Unit\Parser;

use BombenProdukt\Lighty\Shiki\ListThemes;
use function Spatie\Snapshots\assertMatchesSnapshot;

it('should call shiki and get a list of themes', function (): void {
    assertMatchesSnapshot(ListThemes::execute());
});
