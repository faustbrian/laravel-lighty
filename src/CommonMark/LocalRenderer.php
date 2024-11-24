<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Lighty\CommonMark;

use BaseCodeOy\Lighty\Lighty;
use BaseCodeOy\Lighty\Parser\DocumentParser;

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
