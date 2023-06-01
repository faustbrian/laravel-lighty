<?php

declare(strict_types=1);

namespace BombenProdukt\Lighty\CommonMark;

use Illuminate\Support\Facades\Http;

final readonly class RemoteRenderer implements RendererInterface
{
    public function __construct(private string $token) {}

    public function render(string $body, string $language): string
    {
        return Http::withToken($this->token)
            ->post('https://lighty.dev/api/documents', [
                'body' => \base64_encode($body),
                'language' => $language,
            ])
            ->throw()
            ->json('data.html');
    }
}
