<?php

declare(strict_types=1);

namespace BombenProdukt\Lighty\Extension;

use Illuminate\Support\Facades\File;
use ZipArchive;

final class ExtractExtension
{
    public static function execute(Extension $extension): bool
    {
        File::ensureDirectoryExists($extension->path());

        $zip = new ZipArchive();

        if ($zip->open($extension->filePath()) === true) {
            $zip->extractTo($extension->path());
            $zip->close();

            File::delete($extension->filePath());

            return true;
        }

        return false;
    }
}
