<?php

declare(strict_types=1);

namespace BaseCodeOy\Lighty\CommonMark;

use Illuminate\Support\Facades\Cache;

final readonly class CacheRenderer implements RendererInterface
{
    public function __construct(private RendererInterface $renderer) {}

    public function render(string $body, string $language, string $theme, array $options = []): string
    {
        $hash = \hash('sha256', \sprintf('%s%s%s', $body, $language, $theme));

        return Cache::rememberForever($hash, fn () => $this->renderer->render($body, $language, $theme, $options));
    }
}
