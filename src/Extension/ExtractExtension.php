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

        $zip = new \ZipArchive();

        if ($zip->open($extension->filePath()) === true) {
            $zip->extractTo($extension->path());
            $zip->close();

            File::delete($extension->filePath());

            return true;
        }

        return false;
    }
}
