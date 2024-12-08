<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Lighty\API;

use Illuminate\Http\Client\Response;

final readonly class Documents
{
    public function __construct(
        private Client $client,
    ) {}

    public function index(array $query = []): Response
    {
        return $this->client->get('documents', $query);
    }

    public function store(array $body): Response
    {
        return $this->client->post('documents', $body);
    }

    public function show(string $document): Response
    {
        return $this->client->get('documents/'.$document);
    }

    public function destroy(string $document): Response
    {
        return $this->client->delete('documents/'.$document);
    }
}
