<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

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
