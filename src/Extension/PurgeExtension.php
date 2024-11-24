<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Lighty\Extension;

use Illuminate\Support\Facades\File;

final class PurgeExtension
{
    public static function execute(Extension $extension): void
    {
        File::deleteDirectory(Path::extension($extension));
    }
}
