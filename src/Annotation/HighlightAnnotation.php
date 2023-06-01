<?php

declare(strict_types=1);

namespace BombenProdukt\Lighty\Annotation;

use BombenProdukt\Lighty\Model\Line;

final class HighlightAnnotation extends AbstractAnnotation
{
    public function shouldAct(string $annotation): bool
    {
        return $annotation === 'highlight';
    }

    public function parse(Line $line, string $annotation, ?string $arguments): void
    {
        foreach ($this->parseRange($line->getOriginalNumber(), $arguments) as $lineNumber) {
            $this->findByNumber($lineNumber)->addModifier('highlight');
        }
    }
}
