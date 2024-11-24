<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Lighty\Extension;

final class DiscoverThemes
{
    /**
     * @return array<Theme>
     */
    public static function execute(Extension $extension): array
    {
        $themes = [];

        foreach (ParsePackageJson::execute($extension, 'themes') as $theme) {
            $themes[] = new Theme(
                type: $theme['uiTheme'],
                name: $theme['label'],
                path: Path::normalize($extension, $theme['path']),
            );
        }

        return $themes;
    }
}
