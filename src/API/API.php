<?php

declare(strict_types=1);

namespace BaseCodeOy\Lighty\API;

final readonly class API
{
    public function documents(string $team): Documents
    {
        return new Documents(Client::for($team));
    }

    public function languages(string $team): Languages
    {
        return new Languages(Client::for($team));
    }

    public function themes(string $team): Themes
    {
        return new Themes(Client::for($team));
    }
}
