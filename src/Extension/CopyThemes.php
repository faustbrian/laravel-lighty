<?php

declare(strict_types=1);

namespace BombenProdukt\Lighty\Extension;

use Illuminate\Support\Facades\File;

final class CopyThemes
{
    /**
     * @param Theme[] $themes
     */
    public static function execute(Extension $extension, array $themes): void
    {
        foreach ($themes as $theme) {
            File::ensureDirectoryExists(\pathinfo(Path::theme($extension, $theme), \PATHINFO_DIRNAME));

            File::put(Path::theme($extension, $theme), \file_get_contents($theme->getPath()));
        }
    }
}
