<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Tests\Unit\Parser;

use BaseCodeOy\Lighty\Shiki\ListThemes;

it('should call shiki and get a list of themes', function (): void {
    expect(ListThemes::execute())->toMatchSnapshot();
});
