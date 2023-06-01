<?php

declare(strict_types=1);

namespace BombenProdukt\Lighty\Extension;

use Illuminate\Support\Facades\File;

final class PurgeExtension
{
    public static function execute(Extension $extension): void
    {
        File::deleteDirectory(Path::extension($extension));
    }
}
