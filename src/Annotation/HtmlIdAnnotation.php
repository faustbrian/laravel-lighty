<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Lighty\Annotation;

use BaseCodeOy\Lighty\Model\Line;

final class HtmlIdAnnotation extends AbstractAnnotation
{
    #[\Override()]
    public function shouldAct(string $annotation): bool
    {
        return \str_starts_with($annotation, '#');
    }

    #[\Override()]
    public function parse(Line $line, string $annotation, ?string $arguments): void
    {
        foreach ($this->parseRange($line->getOriginalNumber(), $arguments) as $lineNumber) {
            $this->findByNumber($lineNumber)->appendModifier('id', \str_replace('#', '', $annotation));
        }
    }
}
