<?php

declare(strict_types=1);

namespace BaseCodeOy\Lighty\API;

use Illuminate\Http\Client\Response;

final readonly class Languages
{
    public function __construct(private Client $client) {}

    public function index(array $query = []): Response
    {
        return $this->client->get('languages', $query);
    }

    public function store(array $body): Response
    {
        return $this->client->post('languages', $body);
    }

    public function show(string $language): Response
    {
        return $this->client->get("languages/{$language}");
    }

    public function update(string $language, array $body): Response
    {
        return $this->client->patch("languages/{$language}", $body);
    }

    public function destroy(string $language): Response
    {
        return $this->client->delete("languages/{$language}");
    }
}
