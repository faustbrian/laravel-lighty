<?php

declare(strict_types=1);

namespace BombenProdukt\Lighty\API;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

final readonly class Client
{
    private PendingRequest $request;

    private function __construct(private string $team)
    {
        $this->request = Http::baseUrl(\sprintf('%s/teams/%s', Config::get('lighty.api.url'), $team))
            ->withToken(Config::get('lighty.api.token'));
    }

    public static function for(string $team): self
    {
        return new self($team);
    }

    public function get(string $path, array $query = []): Response
    {
        return $this->request->get($path, $query);
    }

    public function post(string $path, array $body): Response
    {
        return $this->request->post($path, $body);
    }

    public function patch(string $path, array $body): Response
    {
        return $this->request->patch($path, $body);
    }

    public function delete(string $path): Response
    {
        return $this->request->delete($path);
    }
}
