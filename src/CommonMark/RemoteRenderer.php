<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Lighty\CommonMark;

use Illuminate\Support\Facades\Http;

final readonly class RemoteRenderer implements RendererInterface
{
    public function __construct(
        private string $token,
    ) {}

    #[\Override()]
    public function render(string $body, string $language, string $theme, array $options = []): string
    {
        return Http::withToken($this->token)
            ->post('https://lighty.dev/api/documents', [
                'body' => \base64_encode($body),
                'language' => $language,
                'theme' => $theme,
                'options' => $options,
            ])
            ->throw()
            ->json('data.html');
    }
}
