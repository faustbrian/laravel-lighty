<?php

declare(strict_types=1);

namespace BombenProdukt\Lighty\Annotation;

use BombenProdukt\Lighty\Model\Line;

final class AutolinkAnnotation extends AbstractAnnotation
{
    public function shouldAct(string $annotation): bool
    {
        return $annotation === 'autolink';
    }

    public function parse(Line $line, string $annotation, ?string $arguments): void
    {
        foreach ($this->parseRange($line->getOriginalNumber(), $arguments) as $lineNumber) {
            $this->findByNumber($lineNumber)->addModifier('autolink');
        }
    }
}
