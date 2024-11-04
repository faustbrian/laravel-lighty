<?php

declare(strict_types=1);

namespace BaseCodeOy\Lighty\CommonMark;

interface RendererInterface
{
    public function render(string $body, string $language, string $theme, array $options = []): string;
}
