<?php

declare(strict_types=1);

namespace BombenProdukt\Lighty\CommonMark;

use Stringable;

final readonly class CodeBlock implements Stringable
{
    public function __construct(private string $codeBlock) {}

    public function __toString(): string
    {
        return $this->codeBlock;
    }
}
