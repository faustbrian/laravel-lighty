<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Lighty\Config;

final readonly class Theme
{
    public function __construct(
        private string $type,
        private string $name,
    ) {}

    public static function light(string $name): self
    {
        return new self('light', $name);
    }

    public static function dark(string $name): self
    {
        return new self('dark', $name);
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isLight(): bool
    {
        return $this->type === 'light';
    }

    public function isDark(): bool
    {
        return $this->type === 'dark';
    }
}
