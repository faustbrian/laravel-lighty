<?php

declare(strict_types=1);

namespace BombenProdukt\Lighty\CommonMark;

use Illuminate\Support\Facades\Cache;

final readonly class CacheRenderer implements RendererInterface
{
    public function __construct(private RendererInterface $renderer) {}

    public function render(string $body, string $language): string
    {
        $hash = \hash('sha256', \sprintf('%s%s', $body, $language));

        return Cache::rememberForever($hash, fn () => $this->renderer->render($body, $language));
    }
}
