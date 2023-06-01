<?php

declare(strict_types=1);

namespace BombenProdukt\Lighty\Annotation;

use BombenProdukt\Lighty\Model\Line;

final class DeleteAnnotation extends AbstractAnnotation
{
    public function shouldAct(string $annotation): bool
    {
        return \in_array($annotation, ['delete', '-'], true);
    }

    public function parse(Line $line, string $annotation, ?string $arguments): void
    {
        foreach ($this->parseRange($line->getOriginalNumber(), $arguments) as $lineNumber) {
            $this->findByNumber($lineNumber)->addModifier('delete');
        }
    }
}
