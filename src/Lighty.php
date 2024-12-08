<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Lighty;

use BaseCodeOy\Lighty\Model\Document;
use BaseCodeOy\Lighty\Shiki\CallShiki;

final class Lighty
{
    public static function highlight(Document $document, array $options = []): string
    {
        return CallShiki::execute('html.js', [
            $document->getSanitizedCode(),
            $document->getLanguage(),
            $document->getTheme(),
            [
                ...$options,
                'lines' => $document->getLines()->toArray(),
                'showLineNumbers' => $document->getShowLineNumbers(),
                'showDiffIndicators' => $document->getShowDiffIndicators(),
                'showDiffIndicatorsInPlaceOfLineNumbers' => $document->getShowDiffIndicatorsInPlaceOfLineNumbers(),
            ],
        ]);
    }
}
