<?php

declare(strict_types=1);

namespace BaseCodeOy\Lighty\Annotation;

use BaseCodeOy\Lighty\Model\Line;

final class AddAnnotation extends AbstractAnnotation
{
    public function shouldAct(string $annotation): bool
    {
        return \in_array($annotation, ['add', '+'], true);
    }

    public function parse(Line $line, string $annotation, ?string $arguments): void
    {
        foreach ($this->parseRange($line->getOriginalNumber(), $arguments) as $lineNumber) {
            $this->findByNumber($lineNumber)->addModifier('add');
        }
    }
}
