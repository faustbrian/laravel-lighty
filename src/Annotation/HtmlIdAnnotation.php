<?php

declare(strict_types=1);

namespace BaseCodeOy\Lighty\Annotation;

use BaseCodeOy\Lighty\Model\Line;

final class HtmlIdAnnotation extends AbstractAnnotation
{
    public function shouldAct(string $annotation): bool
    {
        return \str_starts_with($annotation, '#');
    }

    public function parse(Line $line, string $annotation, ?string $arguments): void
    {
        foreach ($this->parseRange($line->getOriginalNumber(), $arguments) as $lineNumber) {
            $this->findByNumber($lineNumber)->appendModifier('id', \str_replace('#', '', $annotation));
        }
    }
}
