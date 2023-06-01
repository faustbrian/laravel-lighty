<?php

declare(strict_types=1);

namespace BombenProdukt\Lighty\Contract;

use BombenProdukt\Lighty\Model\Line;

interface AnnotationInterface
{
    public function shouldAct(string $annotation): bool;

    public function parse(Line $line, string $annotation, ?string $arguments): void;
}
