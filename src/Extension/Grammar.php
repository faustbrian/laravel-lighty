<?php

declare(strict_types=1);

namespace BaseCodeOy\Lighty\Extension;

final readonly class Grammar
{
    public function __construct(
        private string $language,
        private string $scope,
        private string $path,
    ) {}

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getScope(): string
    {
        return $this->scope;
    }

    public function getPath(): string
    {
        return $this->path;
    }
}
