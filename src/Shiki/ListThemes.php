<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Lighty\Shiki;

final class ListThemes
{
    public static function execute(): array
    {
        return \json_decode(CallShiki::execute('themes.js'), true, 512, \JSON_THROW_ON_ERROR);
    }
}
