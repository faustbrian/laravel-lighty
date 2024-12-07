<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Lighty\API;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

final readonly class Client
{
    private PendingRequest $pendingRequest;

    private function __construct(
        string $team,
    ) {
        $this->pendingRequest = Http::baseUrl(\sprintf('%s/teams/%s', Config::get('lighty.api.url'), $team))
            ->withToken(Config::get('lighty.api.token'));
    }

    public static function for(string $team): self
    {
        return new self($team);
    }

    public function get(string $path, array $query = []): Response
    {
        return $this->pendingRequest->get($path, $query);
    }

    public function post(string $path, array $body): Response
    {
        return $this->pendingRequest->post($path, $body);
    }

    public function patch(string $path, array $body): Response
    {
        return $this->pendingRequest->patch($path, $body);
    }

    public function delete(string $path): Response
    {
        return $this->pendingRequest->delete($path);
    }
}
