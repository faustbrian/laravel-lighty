<?php

declare(strict_types=1);

namespace BaseCodeOy\Lighty\Extension;

use Illuminate\Support\Facades\Config;

final readonly class Path
{
    public static function root(?string $path = null): string
    {
        if (\is_string($path)) {
            return \sprintf('%s/%s', Config::get('lighty.storage_path'), $path);
        }

        return Config::get('lighty.storage_path');
    }

    public static function extension(Extension $extension): string
    {
        return self::root(
            \sprintf(
                'extensions/%s/%s',
                $extension->getPublisher(),
                $extension->getExtension(),
            ),
        );
    }

    public static function extensions(): string
    {
        return self::root('extensions');
    }

    public static function grammar(Extension $extension, Grammar $grammar): string
    {
        return self::root(
            \sprintf(
                'grammars/%s/%s/%s',
                $extension->getPublisher(),
                $extension->getExtension(),
                \basename($grammar->getPath()),
            ),
        );
    }

    public static function grammars(): string
    {
        return self::root('grammars');
    }

    public static function theme(Extension $extension, Theme $theme): string
    {
        return self::root(
            \sprintf(
                'themes/%s/%s/%s',
                $extension->getPublisher(),
                $extension->getExtension(),
                \basename($theme->getPath()),
            ),
        );
    }

    public static function themes(): string
    {
        return self::root('themes');
    }

    public static function normalize(Extension $extension, string $path): string
    {
        return \sprintf('%s/extension/%s', $extension->path(), \str_replace('./', '', $path));
    }
}
