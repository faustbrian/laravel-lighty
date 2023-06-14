<?php

declare(strict_types=1);

namespace BombenProdukt\Lighty\CommonMark;

use BombenProdukt\Lighty\Lighty;
use BombenProdukt\Lighty\Parser\DocumentParser;

final readonly class LocalRenderer implements RendererInterface
{
    public function render(string $body, string $language, string $theme, array $options = []): string
    {
        $document = (new DocumentParser())->parse($body);
        $document->setLanguage($language);
        $document->setTheme($theme);

        return Lighty::highlight($document, $options);
    }
}
