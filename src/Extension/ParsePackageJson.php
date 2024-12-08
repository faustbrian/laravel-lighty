<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Lighty\Extension;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

final class ParsePackageJson
{
    public static function execute(Extension $extension, string $type): array
    {
        return Arr::get(File::json($extension->packageJsonPath()), 'contributes.'.$type);
    }
}
