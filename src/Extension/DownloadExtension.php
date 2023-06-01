<?php

declare(strict_types=1);

namespace BombenProdukt\Lighty\Extension;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Throwable;

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
        } catch (Throwable) {
            return false;
        }
    }
}
