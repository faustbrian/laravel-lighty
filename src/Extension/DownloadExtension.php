<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Lighty\Extension;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

final class DownloadExtension
{
    public static function execute(Extension $extension): bool
    {
        File::ensureDirectoryExists($extension->path());

        try {
            File::put(
                $extension->filePath(),
                Http::get(BuildMarketplaceLink::execute($extension))->throw()->body(),
            );

            return true;
        } catch (\Throwable) {
            return false;
        }
    }
}
