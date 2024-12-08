<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Lighty\Extension;

use Illuminate\Support\Facades\File;

final class CopyThemes
{
    /**
     * @param array<Theme> $themes
     */
    public static function execute(Extension $extension, array $themes): void
    {
        foreach ($themes as $theme) {
            File::ensureDirectoryExists(\pathinfo(Path::theme($extension, $theme), \PATHINFO_DIRNAME));

            File::put(Path::theme($extension, $theme), \file_get_contents($theme->getPath()));
        }
    }
}
