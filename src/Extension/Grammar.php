<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

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
