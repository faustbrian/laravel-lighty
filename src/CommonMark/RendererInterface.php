<?php

declare(strict_types=1);

namespace BombenProdukt\Lighty\CommonMark;

interface RendererInterface
{
    public function render(string $body, string $language): string;
}
