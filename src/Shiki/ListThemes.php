<?php

declare(strict_types=1);

namespace BaseCodeOy\Lighty\Shiki;

final class ListThemes
{
    public static function execute(): array
    {
        return \json_decode(CallShiki::execute('themes.js'), true, 512, \JSON_THROW_ON_ERROR);
    }
}
