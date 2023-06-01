<?php

declare(strict_types=1);

namespace BombenProdukt\Lighty\API;

use Illuminate\Http\Client\Response;

final readonly class Themes
{
    public function __construct(private Client $client) {}

    public function index(array $query = []): Response
    {
        return $this->client->get('themes', $query);
    }

    public function store(array $body): Response
    {
        return $this->client->post('themes', $body);
    }

    public function show(string $theme): Response
    {
        return $this->client->get("themes/{$theme}");
    }

    public function update(string $theme, array $body): Response
    {
        return $this->client->patch("themes/{$theme}", $body);
    }

    public function destroy(string $theme): Response
    {
        return $this->client->delete("themes/{$theme}");
    }
}
