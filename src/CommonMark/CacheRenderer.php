<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Lighty\CommonMark;

use Illuminate\Support\Facades\Cache;

final readonly class CacheRenderer implements RendererInterface
{
    public function __construct(
        private RendererInterface $renderer,
    ) {}

    #[\Override()]
    public function render(string $body, string $language, string $theme, array $options = []): string
    {
        $hash = \hash('sha256', \sprintf('%s%s%s', $body, $language, $theme));

        return Cache::rememberForever($hash, fn (): string => $this->renderer->render($body, $language, $theme, $options));
    }
}
