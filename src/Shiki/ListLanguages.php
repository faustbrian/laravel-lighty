<?php

declare(strict_types=1);

namespace BaseCodeOy\Lighty\Shiki;

final class ListLanguages
{
    public static function execute(): array
    {
        $languageProperties = \json_decode(CallShiki::execute('languages.js'), true, 512, \JSON_THROW_ON_ERROR);

        $languages = \array_map(fn ($properties) => $properties['id'], $languageProperties);

        \sort($languages);

        return $languages;
    }
}
