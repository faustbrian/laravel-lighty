<?php

declare(strict_types=1);

namespace BaseCodeOy\Lighty\Extension;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

final class ParsePackageJson
{
    public static function execute(Extension $extension, string $type): array
    {
        return Arr::get(File::json($extension->packageJsonPath()), "contributes.{$type}");
    }
}
