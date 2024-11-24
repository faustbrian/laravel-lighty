<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Lighty\Extension;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

final class GrammarFinder
{
    public function __construct(
        private array $items,
    ) {}

    public static function make(): self
    {
        $grammars = [];

        if (File::missing(Path::grammars())) {
            return new self($grammars);
        }

        foreach (File::allFiles(Path::grammars()) as $grammar) {
            $contents = \json_decode($grammar->getContents(), true, 512, \JSON_THROW_ON_ERROR);

            $grammars[$contents['id']] = $grammar->getContents();
        }

        return new self($grammars);
    }

    public function all(): array
    {
        return $this->items;
    }

    public function find(string $id): string
    {
        return Arr::get(
            $this->items,
            $id,
            fn (): never => throw new \InvalidArgumentException("Grammar [{$id}] not found."),
        );
    }
}
