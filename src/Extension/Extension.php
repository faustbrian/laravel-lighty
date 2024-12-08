<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Lighty\Extension;

final readonly class Extension
{
    public function __construct(
        private string $publisher,
        private string $extension,
    ) {}

    public static function fromString(string $extension): self
    {
        [$publisher, $extension] = \explode('.', $extension);

        return new self($publisher, $extension);
    }

    public function getPublisher(): string
    {
        return $this->publisher;
    }

    public function getExtension(): string
    {
        return $this->extension;
    }

    public function path(): string
    {
        return Path::extension($this);
    }

    public function filePath(): string
    {
        return Path::extension($this).'.zip';
    }

    public function packageJsonPath(): string
    {
        return \sprintf('%s/extension/package.json', Path::extension($this));
    }
}
