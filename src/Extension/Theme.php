<?php

declare(strict_types=1);

namespace BombenProdukt\Lighty\Extension;

final readonly class Theme
{
    public function __construct(
        private string $name,
        private string $type,
        private string $path,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getPath(): string
    {
        return $this->path;
    }
}
