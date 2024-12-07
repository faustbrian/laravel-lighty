<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Lighty\Extension;

use Illuminate\Support\Facades\File;

final class ExtractExtension
{
    public static function execute(Extension $extension): bool
    {
        File::ensureDirectoryExists($extension->path());

        $zipArchive = new \ZipArchive();

        if ($zipArchive->open($extension->filePath()) === true) {
            $zipArchive->extractTo($extension->path());
            $zipArchive->close();

            File::delete($extension->filePath());

            return true;
        }

        return false;
    }
}
