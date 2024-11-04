<?php

declare(strict_types=1);

namespace BaseCodeOy\Lighty\Extension;

final class DiscoverThemes
{
    /**
     * @return Theme[]
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
