<?php

declare(strict_types=1);

namespace BombenProdukt\Lighty\Extension;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

final class ThemeFinder
{
    public function __construct(private array $items) {}

    public static function make(): self
    {
        $themes = [];

        if (File::missing(Path::themes())) {
            return new self($themes);
        }

        foreach (File::allFiles(Path::themes()) as $theme) {
            $contents = \json_decode($theme->getContents(), true, 512, \JSON_THROW_ON_ERROR);

            $themes[$contents['name']] = $theme->getContents();
        }

        return new self($themes);
    }

    public function all(): array
    {
        return $this->items;
    }

    public function find(string $identifier): string
    {
        return Arr::get(
            $this->items,
            $identifier,
            fn (): never => throw new \InvalidArgumentException("Theme [{$identifier}] not found."),
        );
    }
}
